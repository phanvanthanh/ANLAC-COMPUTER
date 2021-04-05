<?php
namespace App\Modules\KhachHang\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use DB;

use App\Modules\KhachHang\Models\ImportKhachHang;
use Excel;
use App\ThongKe;
use App\KhachHang;
use Request as RequestAjax;


class KhachHangController extends Controller{
    /**
     * Create a new authentication controller instance.
     *
     * @return void
     */
    public function __construct(){
    }

    public function khachHang(Request $request){     
        $thongKeChung=ThongKe::thongKeChung();   
        return view('KhachHang::khach-hang', compact('thongKeChung'));
    }


    public function danhSachKhachHang(Request $request){
        if(RequestAjax::ajax()){ // Kiểm tra gửi đường ajax
            $error=''; // Khai báo biến
            $khachHangs=KhachHang::where('state','=',1)->get()->toArray();
            $view=view('KhachHang::danh-sach-khach-hang', compact('khachHangs','error'))->render(); // Trả dữ liệu ra view 
            return response()->json(['html'=>$view,'error'=>$error]); // Return dữ liệu ra ajax
        }
        return array('error'=>"Lỗi phương thức truyền dữ liệu"); // Trả về lỗi phương thức truyền số liệu
    }

    public function themKhachHang(Request $request){
        if(RequestAjax::ajax()){ // Kiểm tra gửi đường ajax
            $data=RequestAjax::all(); // Lấy tất cả dữ liệu
            if(isset($data['ma_khach_hang']) && $data['ma_khach_hang']){
                $checkMaKhachHang=KhachHang::where('ma_khach_hang','=',$data['ma_khach_hang'])->get()->toArray();
                // Lỗi tồn tại đối tác
                if($checkMaKhachHang){
                    return array('error'=>"Lỗi mã đối tác đã tồn tại");
                }
            }
            if(!isset($data['ma_khach_hang'])){
                $data['ma_khach_hang']=KhachHang::taoMa();
            }
            if ($request->hasFile('hinh_anh')) {
                $data['hinh_anh']=\Helper::getAndStoreFile($request->file('hinh_anh'));
            }
            KhachHang::create($data); // Lưu dữ liệu vào DB
            return array("error"=>''); // Trả về thông báo lưu dữ liệu thành công
        }
        return array('error'=>"Lỗi phương thức truyền dữ liệu"); // Báo lỗi phương thức truyền dữ liệu
    }

    public function khachHangSingle(Request $request){
        if(RequestAjax::ajax()){ // Kiểm tra gửi đường ajax
            // Khai báo các dữ liệu bên form cần thiết
            $error='';
            $dataForm=RequestAjax::all(); $data=array();            
            // Kiểm tra dữ liệu không hợp lệ
            if(isset($dataForm['id'])){ // ngược lại dữ liệu hợp lệ
                $data = KhachHang::where("id","=",$dataForm['id'])->get(); // kiểm tra dữ liệu trong DB
                if(count($data)<1){ // Nếu dữ liệu ko tồn tại trong DB
                    $error="Không tìm thấy dữ liệu cần sửa";
                }else{ // ngược lại dữ liệu tồn tại trong DB
                    $data=$data[0];
                    $error="";
                }
            }  
            $view=view('KhachHang::khach-hang-single', compact('data','error'))->render(); // Trả dữ liệu ra view trước     
            return response()->json(['html'=>$view, 'error'=>$error]); // return dữ liệu về AJAX sau
        }
        return array('error'=>"Không tìm thấy phương thức truyền dữ liệu"); // return dữ liệu về AJAX
    }


    public function capNhatKhachHang(Request $request){
        if(RequestAjax::ajax()){ // Kiểm tra phương thức gửi dữ liệu là AJAX
            $dataForm=RequestAjax::all(); // Lấy tất cả dữ liệu đã gửi
            if(!isset($dataForm['id'])){ // Kiểm tra nếu ko tồn tại id
                return array("error"=>'Không tìm thấy dữ liệu cần sửa'); // Trả lỗi về AJAX
            }
            $id=$dataForm['id']; //ngược lại có id
            $khachHang=KhachHang::where("id","=",$id)->get()->toArray();
            if(count($khachHang)==1){
                unset($dataForm["_token"]);
                $khachHang=KhachHang::where("id","=",$id);
                if($request->hasFile('hinh_anh')) {
                    $dataForm['hinh_anh']=\Helper::getAndStoreFile($request->file('hinh_anh'));
                }else{
                    unset($dataForm['hinh_anh']);
                }
                $khachHang->update($dataForm);
                return array("error"=>'');
            }else{
                return array("error"=>'Không tìm thấy dữ liệu cần sửa'); // Trả lỗi về AJAX
            }         
            
        }
        return array('error'=>"Lỗi phương thức truyền dữ liệu");
    }

    public function xoaKhachHang(Request $request){
        if(RequestAjax::ajax()){ // Kiểm tra phương thức gửi dữ liệu là AJAX
            $dataForm=RequestAjax::all(); // Lấy tất cả dữ liệu đã gửi
            if(!isset($dataForm['id'])){ // Kiểm tra nếu ko tồn tại id
                return array("error"=>'Không tìm thấy dữ liệu cần xóa'); // Trả lỗi về AJAX
            }
            $id=$dataForm['id']; //ngược lại có id
            $khachHang=KhachHang::where("id","=",$id)->get();
            if(count($khachHang)==1){
                KhachHang::where("id","=",$id)->delete();
                return array("error"=>'');
            }else{
                return array("error"=>'Không tìm thấy dữ liệu cần xóa'); // Trả lỗi về AJAX
            }         
            
        }
        return array('error'=>"Lỗi phương thức truyền dữ liệu");
    }


    public function importKhachHang(Request $request){
        $data=array();
        if($request->isMethod('post')){
            $file=\Helper::getAndStoreFile($request->file('file'));
            Excel::import(new ImportKhachHang,request()->file('file'));
        }
        return redirect(route("khach-hang"));
    }
    
}