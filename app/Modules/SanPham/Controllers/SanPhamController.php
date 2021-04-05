<?php
namespace App\Modules\SanPham\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use App\Modules\SanPham\Models\ImportSanPham;
use Excel;
use DB;
use App\DonViTinh;
use App\SanPham;
use App\ThongKe;
use Request as RequestAjax;


class SanPhamController extends Controller{
    /**
     * Create a new authentication controller instance.
     *
     * @return void
     */
    public function __construct(){
    }

    public function sanPham(Request $request){
        $thongKeChung=ThongKe::thongKeChung();
        return view('SanPham::san-pham', compact('thongKeChung'));
    }


    public function danhSachSanPham(Request $request){
        if(RequestAjax::ajax()){ // Kiểm tra gửi đường ajax
            $error=''; // Khai báo biến
            $sanPhams=SanPham::layDanhSachSanPhamTonKho();
            $view=view('SanPham::danh-sach-san-pham', compact('sanPhams','error'))->render(); // Trả dữ liệu ra view 
            return response()->json(['html'=>$view,'error'=>$error]); // Return dữ liệu ra ajax
        }
        return array('error'=>"Lỗi phương thức truyền dữ liệu"); // Trả về lỗi phương thức truyền số liệu
    }

    public function themSanPham(Request $request){
        if(RequestAjax::ajax()){ // Kiểm tra gửi đường ajax
            $data=RequestAjax::all(); // Lấy tất cả dữ liệu
            if ($request->hasFile('hinh_anh')) {
                $data['hinh_anh']=\Helper::getAndStoreFile($request->file('hinh_anh'));
            }
            SanPham::create($data); // Lưu dữ liệu vào DB
            return array("error"=>''); // Trả về thông báo lưu dữ liệu thành công
        }
        return array('error'=>"Lỗi phương thức truyền dữ liệu"); // Báo lỗi phương thức truyền dữ liệu
    }

    public function sanPhamSingle(Request $request){
        if(RequestAjax::ajax()){ // Kiểm tra gửi đường ajax
            // Khai báo các dữ liệu bên form cần thiết
            $error='';
            $dataForm=RequestAjax::all(); $data=array();
            $donViTinhs=DonViTinh::where('state','=',1)->get()->toArray();
            // Kiểm tra dữ liệu không hợp lệ
            if(isset($dataForm['id'])){ // ngược lại dữ liệu hợp lệ
                $data = SanPham::where("id","=",$dataForm['id'])->get(); // kiểm tra dữ liệu trong DB
                if(count($data)<1){ // Nếu dữ liệu ko tồn tại trong DB
                    $error="Không tìm thấy dữ liệu cần sửa";
                }else{ // ngược lại dữ liệu tồn tại trong DB
                    $data=$data[0];
                    $error="";
                }
            }  
            $view=view('SanPham::san-pham-single', compact('data','donViTinhs','error'))->render(); // Trả dữ liệu ra view trước     
            return response()->json(['html'=>$view, 'error'=>$error]); // return dữ liệu về AJAX sau
        }
        return array('error'=>"Không tìm thấy phương thức truyền dữ liệu"); // return dữ liệu về AJAX
    }


    public function capNhatSanPham(Request $request){
        if(RequestAjax::ajax()){ // Kiểm tra phương thức gửi dữ liệu là AJAX
            $dataForm=RequestAjax::all(); // Lấy tất cả dữ liệu đã gửi
            if(!isset($dataForm['id'])){ // Kiểm tra nếu ko tồn tại id
                return array("error"=>'Không tìm thấy dữ liệu cần sửa'); // Trả lỗi về AJAX
            }
            $id=$dataForm['id']; //ngược lại có id
            $sanPham=SanPham::where("id","=",$id)->get()->toArray();
            if(count($sanPham)==1){
                unset($dataForm["_token"]);
                $sanPham=SanPham::where("id","=",$id);
                if($request->hasFile('hinh_anh')) {
                    $dataForm['hinh_anh']=\Helper::getAndStoreFile($request->file('hinh_anh'));
                }else{
                    unset($dataForm['hinh_anh']);
                }
                $sanPham->update($dataForm);
                return array("error"=>'');
            }else{
                return array("error"=>'Không tìm thấy dữ liệu cần sửa'); // Trả lỗi về AJAX
            }         
            
        }
        return array('error'=>"Lỗi phương thức truyền dữ liệu");
    }

    public function xoaSanPham(Request $request){
        if(RequestAjax::ajax()){ // Kiểm tra phương thức gửi dữ liệu là AJAX
            $dataForm=RequestAjax::all(); // Lấy tất cả dữ liệu đã gửi
            if(!isset($dataForm['id'])){ // Kiểm tra nếu ko tồn tại id
                return array("error"=>'Không tìm thấy dữ liệu cần xóa'); // Trả lỗi về AJAX
            }
            $id=$dataForm['id']; //ngược lại có id
            $sanPham=SanPham::where("id","=",$id)->get();
            if(count($sanPham)==1){
                SanPham::where("id","=",$id)->delete();
                return array("error"=>'');
            }else{
                return array("error"=>'Không tìm thấy dữ liệu cần xóa'); // Trả lỗi về AJAX
            }         
            
        }
        return array('error'=>"Lỗi phương thức truyền dữ liệu");
    }

    public function importSanPham(Request $request){
        $data=array();
        if($request->isMethod('post')){
            $file=\Helper::getAndStoreFile($request->file('file'));
            Excel::import(new ImportSanPham,request()->file('file'));
        }
        return redirect(route("san-pham"));
    }
    
}