<?php
namespace App\Modules\PhieuXuat\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use App\Modules\PhieuXuat\Models\ReadFileExcelPhieuXuat;
use App\Modules\PhieuXuat\Models\ExportPhieuXuat;
use DB;
use Excel;
use App\DoiTac;

use App\PhieuNhap;
use App\ChiTietPhieuNhap;


use App\SanPham;
use App\KhachHang;
use App\PhieuXuat;
use App\ChiTietPhieuXuat;
use App\ThongKe;
use Request as RequestAjax;


class PhieuXuatController extends Controller{
    /**
     * Create a new authentication controller instance.
     *
     * @return void
     */
    public function __construct(){
    }

    public function phieuXuat(Request $request){
        $thongKeChung=ThongKe::thongKeChung();
        return view('PhieuXuat::phieu-xuat', compact('thongKeChung'));
    }


    public function danhSachPhieuXuat(Request $request){
        if(RequestAjax::ajax()){ // Kiểm tra gửi đường ajax
            $error=''; // Khai báo biến
            $phieuXuats=PhieuXuat::layDanhSachPhieuXuat();
            $view=view('PhieuXuat::danh-sach-phieu-xuat', compact('phieuXuats','error'))->render(); // Trả dữ liệu ra view 
            return response()->json(['html'=>$view,'error'=>$error]); // Return dữ liệu ra ajax
        }
        return array('error'=>"Lỗi phương thức truyền dữ liệu"); // Trả về lỗi phương thức truyền số liệu
    }

    public function themChiTietPhieuXuat(Request $request){
        if(RequestAjax::ajax()){ // Kiểm tra gửi đường ajax
            $data=RequestAjax::all(); // Lấy tất cả dữ liệu
            $idPhieuXuat=0; $idSanPham=0;


            // Kiểm tra sản phẩm
            $arrSanPham=explode("-", $data['ten_san_pham']);
            $index=count($arrSanPham)-1;
            $maSanPham=trim($arrSanPham[$index]);
            $sanPham=SanPham::where('ma_san_pham','=',$maSanPham)->get()->toArray();
            if(!$sanPham){
                return array('error'=>"Lỗi không tìm thấy sản phẩm đã chọn");
            }
            $idSanPham=$sanPham[0]['id'];
            $checkSoLuong=ChiTietPhieuXuat::checkSoLuongTonSanPhamTheoIdSanPham($idSanPham);
            if(!$checkSoLuong || !isset($checkSoLuong['so_luong_con_lai']) || $checkSoLuong['so_luong_con_lai']<$data['so_luong']){
                return array('error'=>"Số lượng không đủ hoặc không đúng");
            }
            // Kiểm tra phiếu xuất
            if($data['id']){
                $phieuXuat=PhieuXuat::where('id','=',$data['id'])->get()->toArray();
                if(!$phieuXuat){
                    return array('error'=>"Lỗi không tìm thấy phiếu xuất");
                }
                $idPhieuXuat=$phieuXuat[0]['id'];
            }else{ // ngược lại nếu chưa có phiếu xuất thì tạo phiếu xuất
                $dataPhieuXuat=array();
                $dataPhieuXuat['ma_phieu_xuat']=$data['ma_phieu_xuat'];
                $arrKhachHang=explode("-", $data['ten_khach_hang']);
                $indexKhachHang=count($arrKhachHang)-1;
                $maKhachHang=trim($arrKhachHang[$indexKhachHang]);
                $khachHangs=KhachHang::where('ma_khach_hang','=',$maKhachHang)->get()->toArray();
                if(!$khachHangs){
                    $khachHang=KhachHang::where('ten_khach_hang','=',$data['ten_khach_hang'])->get()->toArray();
                    if(count($khachHang)<=0){
                        $dataKhachHang['ma_khach_hang']=KhachHang::taoMa();
                        $dataKhachHang['ten_khach_hang']=$data['ten_khach_hang'];
                        $khachHang=KhachHang::create($dataKhachHang);
                        $khachHangs=KhachHang::where('id','=',$khachHang->id)->get()->toArray();
                    }
                    //return array('error'=>"Lỗi không tìm thấy đối tác đã chọn");
                }
                $dataPhieuXuat['id_khach_hang']=$khachHangs[0]['id'];
                /*if(isset($data['da_thanh_toan'])){
                    $dataPhieuXuat['da_thanh_toan']=1;
                }*/
                $dataPhieuXuat['da_thanh_toan']=$data['da_thanh_toan'];
                $dataPhieuXuat['ngay_xuat']=$data['ngay_xuat'];
                $dataPhieuXuat['ghi_chu']=$data['ghi_chu'];
                $phieuXuat=PhieuXuat::create($dataPhieuXuat);
                $idPhieuXuat=$phieuXuat->id;             
            }

            $danhSachChiTietPhieuNhaps=ChiTietPhieuNhap::layDanhSachChiTietPhieuNhapConTon($idSanPham);
            if(count($danhSachChiTietPhieuNhaps)<=0){
                return array("error"=>'Số lượng tồn trong kho không đủ xuất','id_phieu_xuat'=>$idPhieuXuat);
            }
            $soLuong=$data['so_luong'];
            foreach ($danhSachChiTietPhieuNhaps as $key => $chiTietPhieuNhap) {
                $soLuongTru=0;
                if($soLuong>0){
                    $soLuongConLai=$chiTietPhieuNhap['so_luong']-$chiTietPhieuNhap['so_luong_da_xuat'];
                    if(($soLuongConLai-$soLuong)>=0){
                        $soLuongTru=$soLuong;
                        $soLuong=0;

                    }else{
                        $soLuongTru=$soLuongConLai;
                        $soLuong=$soLuong-$soLuongConLai;
                    }
                    


                    $updateChiTietPhieuNhap=ChiTietPhieuNhap::find($chiTietPhieuNhap['id']);
                    $soLuongDaXuat=$updateChiTietPhieuNhap->so_luong_da_xuat+$soLuongTru;
                    $updateChiTietPhieuNhap->so_luong_da_xuat=$soLuongDaXuat;
                    $updateChiTietPhieuNhap->update();

                    $dataChiTietPhieuXuat=array();
                    $dataChiTietPhieuXuat['id_phieu_xuat']=$idPhieuXuat;
                    $dataChiTietPhieuXuat['id_chi_tiet_phieu_nhap']=$chiTietPhieuNhap['id'];
                    $dataChiTietPhieuXuat['id_san_pham']=$idSanPham;
                    $dataChiTietPhieuXuat['gia_xuat']=$data['gia_xuat'];
                    $dataChiTietPhieuXuat['gia_von']=$updateChiTietPhieuNhap->gia_nhap;
                    $dataChiTietPhieuXuat['so_luong']=$soLuongTru;
                    $dataChiTietPhieuXuat['thanh_tien']=$data['gia_xuat']*$soLuongTru;
                    $dataChiTietPhieuXuat['giam_gia']=($soLuongTru*$data['giam_gia'])/$data['so_luong'];;
                    $dataChiTietPhieuXuat['ghi_chu']='';
                    $dataChiTietPhieuXuat['state']=0;
                    $chiTietPhieuXuat=ChiTietPhieuXuat::create($dataChiTietPhieuXuat);
                }
            }

            return array("error"=>'','id_phieu_xuat'=>$idPhieuXuat); // Trả về thông báo lưu dữ liệu thành công
        }
        return array('error'=>"Lỗi phương thức truyền dữ liệu"); // Báo lỗi phương thức truyền dữ liệu
    }

    public function loadChiTietPhieuXuat(Request $request){
        if(RequestAjax::ajax()){ // Kiểm tra gửi đường ajax
            // Khai báo các dữ liệu bên form cần thiết
            $dataForm=RequestAjax::all();
            $chiTietPhieuXuats=array();
            $error=''; // Khai báo biến
            if($dataForm['id']){
                $chiTietPhieuXuats=ChiTietPhieuXuat::getChiTietPhieuXuatByIdPhieuXuat($dataForm['id']);
            }else{
                $error='Không tìm thấy phiếu xuất';
            }
            $view=view('PhieuXuat::load-chi-tiet-phieu-xuat', compact('chiTietPhieuXuats','error'))->render(); // Trả dữ liệu ra view 
            return response()->json(['html'=>$view,'error'=>$error]); // Return dữ liệu ra ajax
        }
        return array('error'=>"Không tìm thấy phương thức truyền dữ liệu"); // return dữ liệu về AJAX
    }

    public function xoaChiTietPhieuXuat(Request $request){
        if(RequestAjax::ajax()){ // Kiểm tra phương thức gửi dữ liệu là AJAX
            $dataForm=RequestAjax::all(); // Lấy tất cả dữ liệu đã gửi
            if(!isset($dataForm['id'])){ // Kiểm tra nếu ko tồn tại id
                return array("error"=>'Không tìm thấy dữ liệu cần xóa 1'); // Trả lỗi về AJAX
            }
            $id=$dataForm['id']; //ngược lại có id
            $chiTietPhieuXuat=ChiTietPhieuXuat::where("id","=",$id)->get()->toArray();
            if(count($chiTietPhieuXuat)>0){
                $idPhieuXuat=$chiTietPhieuXuat[0]['id_phieu_xuat'];
                // Lấy phiếu nhập và số lượng xuất cần xóa để cập nhật lại số lượng cho chi tiết phiếu nhập
                $idChiTietPhieuNhap=$chiTietPhieuXuat[0]['id_chi_tiet_phieu_nhap'];
                $soLuong=$chiTietPhieuXuat[0]['so_luong'];
                $chiTietPhieuNhap=ChiTietPhieuNhap::find($idChiTietPhieuNhap);
                $chiTietPhieuNhap->so_luong_da_xuat=$chiTietPhieuNhap->so_luong_da_xuat-$soLuong;
                $chiTietPhieuNhap->update();
                ChiTietPhieuXuat::where("id","=",$id)->delete();
                return array("error"=>'','id_phieu_xuat'=>$idPhieuXuat);
            }else{
                return array("error"=>'Không tìm thấy dữ liệu cần xóa'); // Trả lỗi về AJAX
            }         
            
        }
        return array('error'=>"Lỗi phương thức truyền dữ liệu");
    }


    public function PhieuXuatSingle(Request $request){
        if(RequestAjax::ajax()){ // Kiểm tra gửi đường ajax
            // Khai báo các dữ liệu bên form cần thiết
            $error='';
            $dataForm=RequestAjax::all(); $data=array();
            $khachHangs=KhachHang::where('state','=',1)->get()->toArray();
            $sanPhams=SanPham::where('state','=',1)->get()->toArray();
            $maPhieuXuatMoi=PhieuXuat::taoSoPhieu();
            // Kiểm tra dữ liệu không hợp lệ
            if(isset($dataForm['id'])){ // ngược lại dữ liệu hợp lệ
                $data = PhieuXuat::layPhieuXuatTheoId($dataForm['id']); // kiểm tra dữ liệu trong DB
                if(count($data)<1){ // Nếu dữ liệu ko tồn tại trong DB
                    $error="Không tìm thấy dữ liệu cần sửa";
                }else{ // ngược lại dữ liệu tồn tại trong DB
                    $data=$data[0];
                    $error="";
                }
            }  
            $view=view('PhieuXuat::phieu-xuat-single', compact('data','error', 'khachHangs', 'sanPhams', 'maPhieuXuatMoi'))->render(); // Trả dữ liệu ra view trước     
            return response()->json(['html'=>$view, 'error'=>$error]); // return dữ liệu về AJAX sau
        }
        return array('error'=>"Không tìm thấy phương thức truyền dữ liệu"); // return dữ liệu về AJAX
    }

    public function layThongTinKhachHangTheoTenVaMa(Request $request){
        if(RequestAjax::ajax()){ // Kiểm tra phương thức gửi dữ liệu là AJAX
            $dataForm=RequestAjax::all(); // Lấy tất cả dữ liệu đã gửi
            if(!isset($dataForm['ten_khach_hang'])){ // Kiểm tra nếu ko tồn tại id
                return array("error"=>'Không tìm thấy dữ liệu đối tác'); // Trả lỗi về AJAX
            }
            $arrKhachHang=explode("-", $dataForm['ten_khach_hang']);
            $indexKhachHang=count($arrKhachHang)-1;
            $maKhachHang=trim($arrKhachHang[$indexKhachHang]);
            $khachHang=KhachHang::where('ma_khach_hang','=',$maKhachHang)->get()->toArray();
            if(!$khachHang){
                return array('error'=>"Lỗi không tìm thấy đối tác đã chọn");
            }
            return array('error'=>"", 'dia_chi'=>$khachHang[0]['dia_chi'], 'so_dien_thoai'=>$khachHang[0]['di_dong']);
            
        }
        return array('error'=>"Lỗi phương thức truyền dữ liệu");
    }

    public function layThongTinSanPhamTheoTenVaMa(Request $request){
        if(RequestAjax::ajax()){ // Kiểm tra phương thức gửi dữ liệu là AJAX
            $dataForm=RequestAjax::all(); // Lấy tất cả dữ liệu đã gửi
            if(!isset($dataForm['ten_san_pham'])){ // Kiểm tra nếu ko tồn tại id
                return array("error"=>'Không tìm thấy dữ liệu đối tác'); // Trả lỗi về AJAX
            }
            $arrSanPham=explode("-", $dataForm['ten_san_pham']);
            $index=count($arrSanPham)-1;
            $maSanPham=trim($arrSanPham[$index]);
            $sanPhams=SanPham::layChiTietSanPhamTheoMa($maSanPham);
            if(!$sanPhams){
                return array('error'=>"Lỗi không tìm thấy đối tác đã chọn");
            }
            $soLuong=0; $soLuongXuat=0;
            if(is_numeric($sanPhams['so_luong'])){
                $soLuong=$sanPhams['so_luong'];
            }
            if(is_numeric($sanPhams['so_luong_xuat'])){
                $soLuongXuat=$sanPhams['so_luong_xuat'];
            }

            $sanPhams['so_luong_ton']=$soLuong-$soLuongXuat;
            return array('error'=>"", "san_pham"=>$sanPhams);
            
        }
        return array('error'=>"Lỗi phương thức truyền dữ liệu");
    }

    


    public function capNhatPhieuXuat(Request $request){
        if(RequestAjax::ajax()){ // Kiểm tra phương thức gửi dữ liệu là AJAX
            $dataForm=RequestAjax::all(); // Lấy tất cả dữ liệu đã gửi
            if(!isset($dataForm['id'])){ // Kiểm tra nếu ko tồn tại id
                return array("error"=>'Không tìm thấy dữ liệu cần sửa'); // Trả lỗi về AJAX
            }
            $id=$dataForm['id']; //ngược lại có id
            // Kiểm tra phiếu xuất
            if($dataForm['id']){
                $phieuXuat=PhieuXuat::where('id','=',$dataForm['id'])->get()->toArray();
                if(!$phieuXuat){
                    return array('error'=>"Lỗi không tìm thấy phiếu xuất");
                }
                $phieuXuat=PhieuXuat::where('id','=',$dataForm['id']);
                // Lấy dữ liệu từ form
                $arrKhachHang=explode("-", $dataForm['ten_khach_hang']);
                $indexKhachHang=count($arrKhachHang)-1;
                $maKhachHang=trim($arrKhachHang[$indexKhachHang]);
                $khachHang=KhachHang::where('ma_khach_hang','=',$maKhachHang)->get()->toArray();
                if(!$khachHang){
                    $khachHang=KhachHang::where('ten_khach_hang','=',$dataForm['ten_khach_hang'])->get()->toArray();
                    if(count($khachHang)<=0){
                        $dataKhachHang['ma_khach_hang']=KhachHang::taoMa();
                        $dataKhachHang['ten_khach_hang']=$dataForm['ten_khach_hang'];
                        $khachHang=KhachHang::create($dataKhachHang);
                        $khachHang=KhachHang::where('id','=',$khachHang->id)->get()->toArray();
                    }
                        
                    //return array('error'=>"Lỗi không tìm thấy đối tác đã chọn");
                }
                $dataPhieuXuat['id_khach_hang']=$khachHang[0]['id'];
                $dataPhieuXuat['ma_phieu_xuat']=$dataForm['ma_phieu_xuat'];
                $dataPhieuXuat['ghi_chu']=$dataForm['ghi_chu'];
                /*if(isset($dataForm['da_thanh_toan'])){
                    $dataPhieuXuat['da_thanh_toan']=1;
                }*/
                $dataPhieuXuat['da_thanh_toan']=$dataForm['da_thanh_toan'];
                $dataPhieuXuat['ngay_xuat']=$dataForm['ngay_xuat'];
                $phieuXuat->update($dataPhieuXuat);
                //return array("error"=>'');
            }else{
                return array("error"=>'Không tìm thấy dữ liệu cần sửa'); // Trả lỗi về AJAX
            }
            
        }
        return array('error'=>"Lỗi phương thức truyền dữ liệu");
    }


    

    public function xoaPhieuXuat(Request $request){
        if(RequestAjax::ajax()){ // Kiểm tra phương thức gửi dữ liệu là AJAX
            $dataForm=RequestAjax::all(); // Lấy tất cả dữ liệu đã gửi
            if(!isset($dataForm['id'])){ // Kiểm tra nếu ko tồn tại id
                return array("error"=>'Không tìm thấy dữ liệu cần xóa'); // Trả lỗi về AJAX
            }
            $id=$dataForm['id']; //ngược lại có id
            $phieuXuat=PhieuXuat::where("id","=",$id)->get();
            if(count($phieuXuat)==1){
                
                // Lấy chi tiết phiếu xuất và cập nhật lại số lượng đã xuất trong chi tiết phiếu nhập
                $chiTietPhieuXuats=ChiTietPhieuXuat::where('id_phieu_xuat','=',$id)->get()->toArray();
                foreach ($chiTietPhieuXuats as $key => $chiTietPhieuXuat) {
                    $idChiTietPhieuNhap=$chiTietPhieuXuat['id_chi_tiet_phieu_nhap'];
                    $soLuong=$chiTietPhieuXuat['so_luong'];
                    $chiTietPhieuNhap=ChiTietPhieuNhap::find($idChiTietPhieuNhap);
                    $chiTietPhieuNhap->so_luong_da_xuat=$chiTietPhieuNhap->so_luong_da_xuat-$soLuong;
                    $chiTietPhieuNhap->update();
                }
                // thực hiện xóa phiếu xuất và tự động xóa các chi tiết phiếu xuất
                PhieuXuat::where("id","=",$id)->delete();
                return array("error"=>'');
            }else{
                return array("error"=>'Không tìm thấy dữ liệu cần xóa'); // Trả lỗi về AJAX
            }         
            
        }
        return array('error'=>"Lỗi phương thức truyền dữ liệu");
    }

    public function inPhieuXuat(Request $request){
        $id=0; $error=''; $chiTietPhieuXuats=array(); $khachHang=array(); $phieuXuat=array(); $tongNoCu=0; $tongDaThanhToanNoCu=0; $tongConLaiNoCu=0;

        if(!Auth::id()){
            $error='Chưa đăng nhập vào hệ thống';
            return view('PhieuXuat::in-phieu-xuat', compact('id', 'error', 'chiTietPhieuXuats', 'khachHang', 'phieuXuat', 'tongNoCu', 'tongDaThanhToanNoCu', 'tongConLaiNoCu'));
        }
        if(!isset($request->id) || !is_numeric($request->id)){
            $error='Không tìm thấy phiếu cần in';
            return view('PhieuXuat::in-phieu-xuat', compact('id', 'error', 'chiTietPhieuXuats', 'khachHang', 'phieuXuat', 'tongNoCu', 'tongDaThanhToanNoCu', 'tongConLaiNoCu'));
        }
        $id=$request->id;
        

        $phieuXuat=PhieuXuat::where('id','=',$id)->get()->toArray();
        if(!$phieuXuat){            
            return view('PhieuXuat::in-phieu-xuat', compact('id', 'error', 'chiTietPhieuXuats', 'khachHang', 'phieuXuat', 'tongNoCu', 'tongDaThanhToanNoCu', 'tongConLaiNoCu'));
        }else{
            $phieuXuat=$phieuXuat[0];
        }


        $chiTietPhieuXuats=ChiTietPhieuXuat::select('chi_tiet_phieu_xuat.id', 'chi_tiet_phieu_xuat.id_phieu_xuat', 'chi_tiet_phieu_xuat.id_san_pham', 'chi_tiet_phieu_xuat.gia_xuat', 'chi_tiet_phieu_xuat.so_luong', 'chi_tiet_phieu_xuat.giam_gia', 'chi_tiet_phieu_xuat.thanh_tien', 'chi_tiet_phieu_xuat.ghi_chu', 'don_vi_tinh.ten_don_vi_tinh', 'san_pham.ma_san_pham', 'san_pham.ten_san_pham')
        ->leftJoin('san_pham','chi_tiet_phieu_xuat.id_san_pham','=','san_pham.id')
        ->leftJoin('don_vi_tinh','san_pham.id_don_vi_tinh','=','don_vi_tinh.id')
        ->where('chi_tiet_phieu_xuat.id_phieu_xuat','=',$id)
        ->get()->toArray();

        $khachHang=PhieuXuat::select('khach_hang.ten_khach_hang', 'khach_hang.di_dong', 'khach_hang.dia_chi')
        ->leftJoin('khach_hang','phieu_xuat.id_khach_hang','=','khach_hang.id')
        ->where('phieu_xuat.id','=',$id)
        ->get()->toArray();
        if($khachHang){
            $khachHang=$khachHang[0];
        }


        $thanhToan=DB::select("SELECT SUM(da_thanh_toan) AS no_cu_da_thanh_toan FROM phieu_xuat WHERE id_khach_hang=".$phieuXuat['id_khach_hang']." and id!=".$id);
        $thanhToan = collect($thanhToan)->map(function($x){ return (array) $x; })->toArray(); 
        if($thanhToan){
            $tongDaThanhToanNoCu=$thanhToan[0]['no_cu_da_thanh_toan'];
        }

        $thanhToan=DB::select("SELECT SUM(ctpx.thanh_tien-ctpx.giam_gia) AS no_cu_thanh_tien  FROM phieu_xuat px
            LEFT JOIN chi_tiet_phieu_xuat ctpx on px.id=ctpx.id_phieu_xuat
            WHERE px.id_khach_hang=".$phieuXuat['id_khach_hang']." and px.id!=".$id);
        $thanhToan = collect($thanhToan)->map(function($x){ return (array) $x; })->toArray(); 
        if($thanhToan){
            $tongNoCu=$thanhToan[0]['no_cu_thanh_tien'];
        }
        $tongConLaiNoCu=$tongNoCu-$tongDaThanhToanNoCu;

        
        return view('PhieuXuat::in-phieu-xuat', compact('id', 'error', 'chiTietPhieuXuats', 'khachHang', 'phieuXuat', 'tongNoCu', 'tongDaThanhToanNoCu', 'tongConLaiNoCu'));
    }

    public function inPhieuGiaoHang(Request $request){
        $id=0; $error=''; $chiTietPhieuXuats=array(); $khachHang=array(); $phieuXuat=array(); $tongNoCu=0; $tongDaThanhToanNoCu=0; $tongConLaiNoCu=0;

        if(!Auth::id()){
            $error='Chưa đăng nhập vào hệ thống';
            return view('PhieuXuat::in-phieu-giao-hang', compact('id', 'error', 'chiTietPhieuXuats', 'khachHang', 'phieuXuat', 'tongNoCu', 'tongDaThanhToanNoCu', 'tongConLaiNoCu'));
        }
        if(!isset($request->id) || !is_numeric($request->id)){
            $error='Không tìm thấy phiếu cần in';
            return view('PhieuXuat::in-phieu-giao-hang', compact('id', 'error', 'chiTietPhieuXuats', 'khachHang', 'phieuXuat', 'tongNoCu', 'tongDaThanhToanNoCu', 'tongConLaiNoCu'));
        }
        $id=$request->id;
        

        $phieuXuat=PhieuXuat::where('id','=',$id)->get()->toArray();
        if(!$phieuXuat){            
            return view('PhieuXuat::in-phieu-giao-hang', compact('id', 'error', 'chiTietPhieuXuats', 'khachHang', 'phieuXuat', 'tongNoCu', 'tongDaThanhToanNoCu', 'tongConLaiNoCu'));
        }else{
            $phieuXuat=$phieuXuat[0];
        }


        $chiTietPhieuXuats=ChiTietPhieuXuat::select('chi_tiet_phieu_xuat.id', 'chi_tiet_phieu_xuat.id_phieu_xuat', 'chi_tiet_phieu_xuat.id_san_pham', 'chi_tiet_phieu_xuat.gia_xuat', 'chi_tiet_phieu_xuat.so_luong', 'chi_tiet_phieu_xuat.giam_gia', 'chi_tiet_phieu_xuat.thanh_tien', 'chi_tiet_phieu_xuat.ghi_chu', 'don_vi_tinh.ten_don_vi_tinh', 'san_pham.ma_san_pham', 'san_pham.ten_san_pham')
        ->leftJoin('san_pham','chi_tiet_phieu_xuat.id_san_pham','=','san_pham.id')
        ->leftJoin('don_vi_tinh','san_pham.id_don_vi_tinh','=','don_vi_tinh.id')
        ->where('chi_tiet_phieu_xuat.id_phieu_xuat','=',$id)
        ->get()->toArray();

        $khachHang=PhieuXuat::select('khach_hang.ten_khach_hang', 'khach_hang.di_dong', 'khach_hang.dia_chi')
        ->leftJoin('khach_hang','phieu_xuat.id_khach_hang','=','khach_hang.id')
        ->where('phieu_xuat.id','=',$id)
        ->get()->toArray();
        if($khachHang){
            $khachHang=$khachHang[0];
        }


        $thanhToan=DB::select("SELECT SUM(da_thanh_toan) AS no_cu_da_thanh_toan FROM phieu_xuat WHERE id_khach_hang=".$phieuXuat['id_khach_hang']." and id!=".$id);
        $thanhToan = collect($thanhToan)->map(function($x){ return (array) $x; })->toArray(); 
        if($thanhToan){
            $tongDaThanhToanNoCu=$thanhToan[0]['no_cu_da_thanh_toan'];
        }

        $thanhToan=DB::select("SELECT SUM(ctpx.thanh_tien-ctpx.giam_gia) AS no_cu_thanh_tien  FROM phieu_xuat px
            LEFT JOIN chi_tiet_phieu_xuat ctpx on px.id=ctpx.id_phieu_xuat
            WHERE px.id_khach_hang=".$phieuXuat['id_khach_hang']." and px.id!=".$id);
        $thanhToan = collect($thanhToan)->map(function($x){ return (array) $x; })->toArray(); 
        if($thanhToan){
            $tongNoCu=$thanhToan[0]['no_cu_thanh_tien'];
        }
        $tongConLaiNoCu=$tongNoCu-$tongDaThanhToanNoCu;

        
        return view('PhieuXuat::in-phieu-giao-hang', compact('id', 'error', 'chiTietPhieuXuats', 'khachHang', 'phieuXuat', 'tongNoCu', 'tongDaThanhToanNoCu', 'tongConLaiNoCu'));
    }

    public function importPhieuXuat(Request $request){
        $data=array();
        if($request->isMethod('post')){
            $file=\Helper::getAndStoreFile($request->file('file'));
            Excel::import(new ReadFileExcelPhieuXuat,request()->file('file'));
        }
        return redirect(route("phieu-xuat"));
    }

    public function exportPhieuXuat() 
    {
        return Excel::download(new ExportPhieuXuat, 'phieu-xuat.xlsx');
    }
    
}