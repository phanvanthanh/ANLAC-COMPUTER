<?php
namespace App\Modules\PhieuNhap\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use DB;
use Excel;
use App\DoiTac;
use App\SanPham;
use App\PhieuNhap;
use App\ChiTietPhieuNhap;
use App\Modules\PhieuNhap\Models\ReadFileExcelPhieuNhap;
use App\Modules\PhieuNhap\Models\ExportPhieuNhap;
use App\ThongKe;
use Request as RequestAjax;


class PhieuNhapController extends Controller{
    /**
     * Create a new authentication controller instance.
     *
     * @return void
     */
    public function __construct(){
    }

    public function phieuNhap(Request $request){
        $thongKeChung=ThongKe::thongKeChung();
        return view('PhieuNhap::phieu-nhap', compact('thongKeChung'));
    }


    public function danhSachPhieuNhap(Request $request){
        if(RequestAjax::ajax()){ // Kiểm tra gửi đường ajax
            $error=''; // Khai báo biến
            $phieuNhaps=PhieuNhap::layDanhSachPhieuNhap();
            $view=view('PhieuNhap::danh-sach-phieu-nhap', compact('phieuNhaps','error'))->render(); // Trả dữ liệu ra view 
            return response()->json(['html'=>$view,'error'=>$error]); // Return dữ liệu ra ajax
        }
        return array('error'=>"Lỗi phương thức truyền dữ liệu"); // Trả về lỗi phương thức truyền số liệu
    }

    public function themChiTietPhieuNhap(Request $request){
        if(RequestAjax::ajax()){ // Kiểm tra gửi đường ajax
            $data=RequestAjax::all(); // Lấy tất cả dữ liệu
            $idPhieuNhap=0; $idSanPham=0;

            // Kiểm tra sản phẩm
            $arrSanPham=explode("-", $data['ten_san_pham']);
            $index=count($arrSanPham)-1;
            $maSanPham=trim($arrSanPham[$index]);
            $sanPham=SanPham::where('ma_san_pham','=',$maSanPham)->get()->toArray();
            if(!$sanPham){
                return array('error'=>"Lỗi không tìm thấy sản phẩm đã chọn");
            }
            $idSanPham=$sanPham[0]['id'];
            // Kiểm tra phiếu nhập
            if($data['id']){
                $phieuNhap=PhieuNhap::where('id','=',$data['id'])->get()->toArray();
                if(!$phieuNhap){
                    return array('error'=>"Lỗi không tìm thấy phiếu nhập");
                }
                $idPhieuNhap=$phieuNhap[0]['id'];
            }else{ // ngược lại nếu chưa có phiếu nhập thì tạo phiếu nhập
                $dataPhieuNhap=array();
                $dataPhieuNhap['ma_phieu_nhap']=$data['ma_phieu_nhap'];
                $arrDoiTac=explode("-", $data['ten_doi_tac']);
                $indexDoiTac=count($arrDoiTac)-1;
                $maDoiTac=trim($arrDoiTac[$indexDoiTac]);
                $doiTac=DoiTac::where('ma_doi_tac','=',$maDoiTac)->get()->toArray();
                if(!$doiTac){
                    $doiTacs=DoiTac::where('ten_doi_tac','=',$data['ten_doi_tac'])->get()->toArray();
                    if(count($doiTacs)<=0){
                        $dataDoiTac['ma_doi_tac']=DoiTac::taoMa();
                        $dataDoiTac['ten_doi_tac']=$data['ten_doi_tac'];
                        $doiTacs=DoiTac::create($dataDoiTac);
                        $doiTac=DoiTac::where('id','=',$doiTacs->id)->get()->toArray();
                    }
                    //return array('error'=>"Lỗi không tìm thấy đối tác đã chọn");
                }
                $dataPhieuNhap['id_doi_tac']=$doiTac[0]['id'];
                // if(isset($data['da_thanh_toan'])){
                //     $dataPhieuNhap['da_thanh_toan']=1;
                // }
                $dataPhieuNhap['da_thanh_toan']=$data['da_thanh_toan'];
                $dataPhieuNhap['ngay_nhap']=$data['ngay_nhap'];
                $dataPhieuNhap['ghi_chu']=$data['ghi_chu'];
                $phieuNhap=PhieuNhap::create($dataPhieuNhap);
                $idPhieuNhap=$phieuNhap->id;             
            }

            $dataChiTietPhieuNhap=array();
            $dataChiTietPhieuNhap['id_phieu_nhap']=$idPhieuNhap;
            $dataChiTietPhieuNhap['id_san_pham']=$idSanPham;
            $dataChiTietPhieuNhap['gia_nhap']=$data['gia_nhap'];
            $dataChiTietPhieuNhap['so_luong']=$data['so_luong'];
            $dataChiTietPhieuNhap['thanh_tien']=$data['thanh_tien'];
            $dataChiTietPhieuNhap['ghi_chu']='';
            $dataChiTietPhieuNhap['state']=0;
            $chiTietPhieuNhap=ChiTietPhieuNhap::create($dataChiTietPhieuNhap);

            return array("error"=>'','id_phieu_nhap'=>$idPhieuNhap); // Trả về thông báo lưu dữ liệu thành công
        }
        return array('error'=>"Lỗi phương thức truyền dữ liệu"); // Báo lỗi phương thức truyền dữ liệu
    }

    public function loadChiTietPhieuNhap(Request $request){
        if(RequestAjax::ajax()){ // Kiểm tra gửi đường ajax
            // Khai báo các dữ liệu bên form cần thiết
            $dataForm=RequestAjax::all();
            $error=''; // Khai báo biến
            if($dataForm['id']){
                $chiTietPhieuNhaps=ChiTietPhieuNhap::getChiTietPhieuNhapByIdPhieuNhap($dataForm['id']);
                $view=view('PhieuNhap::load-chi-tiet-phieu-nhap', compact('chiTietPhieuNhaps','error'))->render(); // Trả dữ liệu ra view 
            }else{
                $error='Không tìm thấy phiếu nhập';
            }
            return response()->json(['html'=>$view,'error'=>$error]); // Return dữ liệu ra ajax
        }
        return array('error'=>"Không tìm thấy phương thức truyền dữ liệu"); // return dữ liệu về AJAX
    }

    public function xoaChiTietPhieuNhap(Request $request){
        if(RequestAjax::ajax()){ // Kiểm tra phương thức gửi dữ liệu là AJAX
            $dataForm=RequestAjax::all(); // Lấy tất cả dữ liệu đã gửi
            if(!isset($dataForm['id'])){ // Kiểm tra nếu ko tồn tại id
                return array("error"=>'Không tìm thấy dữ liệu cần xóa 1'); // Trả lỗi về AJAX
            }
            $id=$dataForm['id']; //ngược lại có id
            $chiTietPhieuNhap=ChiTietPhieuNhap::where("id","=",$id)->get()->toArray();
            if(count($chiTietPhieuNhap)>0){
                $idPhieuNhap=$chiTietPhieuNhap[0]['id_phieu_nhap'];
                ChiTietPhieuNhap::where("id","=",$id)->delete();
                return array("error"=>'','id_phieu_nhap'=>$idPhieuNhap);
            }else{
                return array("error"=>'Không tìm thấy dữ liệu cần xóa'); // Trả lỗi về AJAX
            }         
            
        }
        return array('error'=>"Lỗi phương thức truyền dữ liệu");
    }


    public function phieuNhapSingle(Request $request){
        if(RequestAjax::ajax()){ // Kiểm tra gửi đường ajax
            // Khai báo các dữ liệu bên form cần thiết
            $error='';
            $dataForm=RequestAjax::all(); $data=array();
            $doiTacs=DoiTac::where('state','=',1)->get()->toArray();
            $sanPhams=SanPham::where('state','=',1)->get()->toArray();
            $maPhieuNhap=PhieuNhap::taoSoPhieu();
            // Kiểm tra dữ liệu không hợp lệ
            if(isset($dataForm['id'])){ // ngược lại dữ liệu hợp lệ
                $data = PhieuNhap::layPhieuNhapTheoId($dataForm['id']); // kiểm tra dữ liệu trong DB
                if(count($data)<1){ // Nếu dữ liệu ko tồn tại trong DB
                    $error="Không tìm thấy dữ liệu cần sửa";
                }else{ // ngược lại dữ liệu tồn tại trong DB
                    $data=$data[0];
                    $error="";
                }
            }  
            $view=view('PhieuNhap::phieu-nhap-single', compact('data','error', 'doiTacs', 'sanPhams', 'maPhieuNhap'))->render(); // Trả dữ liệu ra view trước     
            return response()->json(['html'=>$view, 'error'=>$error]); // return dữ liệu về AJAX sau
        }
        return array('error'=>"Không tìm thấy phương thức truyền dữ liệu"); // return dữ liệu về AJAX
    }

    public function layThongTinDoiTacTheoTenVaMa(Request $request){
        if(RequestAjax::ajax()){ // Kiểm tra phương thức gửi dữ liệu là AJAX
            $dataForm=RequestAjax::all(); // Lấy tất cả dữ liệu đã gửi
            if(!isset($dataForm['ten_doi_tac'])){ // Kiểm tra nếu ko tồn tại id
                return array("error"=>'Không tìm thấy dữ liệu đối tác'); // Trả lỗi về AJAX
            }
            $arrDoiTac=explode("-", $dataForm['ten_doi_tac']);
            $indexDoiTac=count($arrDoiTac)-1;
            $maDoiTac=trim($arrDoiTac[$indexDoiTac]);
            $doiTac=DoiTac::where('ma_doi_tac','=',$maDoiTac)->get()->toArray();
            if(!$doiTac){
                return array('error'=>"Lỗi không tìm thấy đối tác đã chọn");
            }
            return array('error'=>"", 'dia_chi'=>$doiTac[0]['dia_chi'], 'so_dien_thoai'=>$doiTac[0]['di_dong']);
            
        }
        return array('error'=>"Lỗi phương thức truyền dữ liệu");
    }


    public function capNhatPhieuNhap(Request $request){
        if(RequestAjax::ajax()){ // Kiểm tra phương thức gửi dữ liệu là AJAX
            $dataForm=RequestAjax::all(); // Lấy tất cả dữ liệu đã gửi
            if(!isset($dataForm['id'])){ // Kiểm tra nếu ko tồn tại id
                return array("error"=>'Không tìm thấy dữ liệu cần sửa'); // Trả lỗi về AJAX
            }
            $id=$dataForm['id']; //ngược lại có id
            // Kiểm tra phiếu nhập
            if($dataForm['id']){
                $phieuNhap=PhieuNhap::where('id','=',$dataForm['id'])->get()->toArray();
                if(!$phieuNhap){
                    return array('error'=>"Lỗi không tìm thấy phiếu nhập");
                }
                $phieuNhap=PhieuNhap::where('id','=',$dataForm['id']);
                // Lấy dữ liệu từ form
                $arrDoiTac=explode("-", $dataForm['ten_doi_tac']);
                $indexDoiTac=count($arrDoiTac)-1;
                $maDoiTac=trim($arrDoiTac[$indexDoiTac]);
                $doiTac=DoiTac::where('ma_doi_tac','=',$maDoiTac)->get()->toArray();
                if(!$doiTac){
                    $doiTacs=DoiTac::where('ten_doi_tac','=',$dataForm['ten_doi_tac'])->get()->toArray();
                    if(count($doiTacs)<=0){
                        $dataDoiTac['ma_doi_tac']=DoiTac::taoMa();
                        $dataDoiTac['ten_doi_tac']=$dataForm['ten_doi_tac'];
                        $doiTacs=DoiTac::create($dataDoiTac);
                        $doiTac=DoiTac::where('id','=',$doiTacs->id)->get()->toArray();
                    }
                    //return array('error'=>"Lỗi không tìm thấy đối tác đã chọn");
                }
                $dataPhieuNhap['id_doi_tac']=$doiTac[0]['id'];
                $dataPhieuNhap['ma_phieu_nhap']=$dataForm['ma_phieu_nhap'];
                $dataPhieuNhap['ngay_nhap']=$dataForm['ngay_nhap'];
                $dataPhieuNhap['ghi_chu']=$dataForm['ghi_chu'];
                // if(isset($dataForm['da_thanh_toan'])){
                //     $dataPhieuNhap['da_thanh_toan']=1;
                // }
                $dataPhieuNhap['da_thanh_toan']=$dataForm['da_thanh_toan'];
                $phieuNhap->update($dataPhieuNhap);
                return array("error"=>'');
            }else{
                return array("error"=>'Không tìm thấy dữ liệu cần sửa'); // Trả lỗi về AJAX
            }
            
        }
        return array('error'=>"Lỗi phương thức truyền dữ liệu");
    }


    

    public function xoaPhieuNhap(Request $request){
        if(RequestAjax::ajax()){ // Kiểm tra phương thức gửi dữ liệu là AJAX
            $dataForm=RequestAjax::all(); // Lấy tất cả dữ liệu đã gửi
            if(!isset($dataForm['id'])){ // Kiểm tra nếu ko tồn tại id
                return array("error"=>'Không tìm thấy dữ liệu cần xóa'); // Trả lỗi về AJAX
            }
            $id=$dataForm['id']; //ngược lại có id
            $phieuNhap=PhieuNhap::where("id","=",$id)->get();
            if(count($phieuNhap)==1){
                PhieuNhap::where("id","=",$id)->delete();
                return array("error"=>'');
            }else{
                return array("error"=>'Không tìm thấy dữ liệu cần xóa'); // Trả lỗi về AJAX
            }         
            
        }
        return array('error'=>"Lỗi phương thức truyền dữ liệu");
    }

    public function importPhieuNhap(Request $request){
        $data=array();
        if($request->isMethod('post')){
            $file=\Helper::getAndStoreFile($request->file('file'));
            Excel::import(new ReadFileExcelPhieuNhap,request()->file('file'));
        }
        return redirect(route("phieu-nhap"));
    }

    public function exportPhieuNhap() 
    {
        return Excel::download(new ExportPhieuNhap, 'phieu-nhap.xlsx');
    }
    
}