<?php
namespace App\Modules\PhieuChi\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use App\Modules\DoiTac\Models\ImportDoiTac;
use Excel;
use DB;
use App\ThongKe;
use App\PhieuChi;
use Request as RequestAjax;


class PhieuChiController extends Controller{
    /**
     * Create a new authentication controller instance.
     *
     * @return void
     */
    public function __construct(){
    }

    public function phieuChi(Request $request){
        $thongKeChung=ThongKe::thongKeChung();        
        return view('PhieuChi::phieu-chi', compact('thongKeChung'));
    }


    public function danhSachPhieuChi(Request $request){
        if(RequestAjax::ajax()){ // Kiểm tra gửi đường ajax
            $error=''; // Khai báo biến
            $phieuChis=PhieuChi::layDanhSachPhieuChi();
            $view=view('PhieuChi::danh-sach-phieu-chi', compact('phieuChis','error'))->render(); // Trả dữ liệu ra view 
            return response()->json(['html'=>$view,'error'=>$error]); // Return dữ liệu ra ajax
        }
        return array('error'=>"Lỗi phương thức truyền dữ liệu"); // Trả về lỗi phương thức truyền số liệu
    }

    public function themPhieuChi(Request $request){
        if(RequestAjax::ajax()){ // Kiểm tra gửi đường ajax
            if(!Auth::id()){
                return array('error'=>"Vui lòng đăng nhập vào hệ thống");
            }
            $data=RequestAjax::all(); // Lấy tất cả dữ liệu
            $data['id_user']=Auth::id();
            if ($request->hasFile('file')) {
                $data['file']=\Helper::getAndStoreFile($request->file('file'));
            }
            PhieuChi::create($data); // Lưu dữ liệu vào DB
            return array("error"=>''); // Trả về thông báo lưu dữ liệu thành công
        }
        return array('error'=>"Lỗi phương thức truyền dữ liệu"); // Báo lỗi phương thức truyền dữ liệu
    }

    public function phieuChiSingle(Request $request){
        if(RequestAjax::ajax()){ // Kiểm tra gửi đường ajax
            // Khai báo các dữ liệu bên form cần thiết
            $error='';
            $dataForm=RequestAjax::all(); $data=array();
            $maPhieuChi=PhieuChi::taoSoPhieu();
            // Kiểm tra dữ liệu không hợp lệ
            if(isset($dataForm['id'])){ // ngược lại dữ liệu hợp lệ
                $data = PhieuChi::where("id","=",$dataForm['id'])->get(); // kiểm tra dữ liệu trong DB
                if(count($data)<1){ // Nếu dữ liệu ko tồn tại trong DB
                    $error="Không tìm thấy dữ liệu cần sửa";
                }else{ // ngược lại dữ liệu tồn tại trong DB
                    $data=$data[0];
                    $error="";
                }
            }  
            $view=view('PhieuChi::phieu-chi-single', compact('data','error', 'maPhieuChi'))->render(); // Trả dữ liệu ra view trước     
            return response()->json(['html'=>$view, 'error'=>$error]); // return dữ liệu về AJAX sau
        }
        return array('error'=>"Không tìm thấy phương thức truyền dữ liệu"); // return dữ liệu về AJAX
    }


    public function capNhatPhieuChi(Request $request){
        if(RequestAjax::ajax()){ // Kiểm tra phương thức gửi dữ liệu là AJAX
            $dataForm=RequestAjax::all(); // Lấy tất cả dữ liệu đã gửi
            if(!isset($dataForm['id'])){ // Kiểm tra nếu ko tồn tại id
                return array("error"=>'Không tìm thấy dữ liệu cần sửa'); // Trả lỗi về AJAX
            }
            $id=$dataForm['id']; //ngược lại có id
            $phieuChi=PhieuChi::where("id","=",$id)->get()->toArray();
            if(count($phieuChi)==1){
                unset($dataForm["_token"]);
                $phieuChi=PhieuChi::where("id","=",$id);
                if($request->hasFile('file')) {
                    $dataForm['file']=\Helper::getAndStoreFile($request->file('file'));
                }else{
                    unset($dataForm['file']);
                }
                $daDuyet=0;
                if(isset($dataForm['da_duyet']) && $dataForm['da_duyet']==1){
                    $daDuyet=1;
                }
                $dataForm['da_duyet']=$daDuyet;
                $phieuChi->update($dataForm);
                return array("error"=>'');
            }else{
                return array("error"=>'Không tìm thấy dữ liệu cần sửa'); // Trả lỗi về AJAX
            }         
            
        }
        return array('error'=>"Lỗi phương thức truyền dữ liệu");
    }

    public function xoaPhieuChi(Request $request){
        if(RequestAjax::ajax()){ // Kiểm tra phương thức gửi dữ liệu là AJAX
            $dataForm=RequestAjax::all(); // Lấy tất cả dữ liệu đã gửi
            if(!isset($dataForm['id'])){ // Kiểm tra nếu ko tồn tại id
                return array("error"=>'Không tìm thấy dữ liệu cần xóa'); // Trả lỗi về AJAX
            }
            $id=$dataForm['id']; //ngược lại có id
            $phieuChi=PhieuChi::where("id","=",$id)->get();
            if(count($phieuChi)==1){
                PhieuChi::where("id","=",$id)->delete();
                return array("error"=>'');
            }else{
                return array("error"=>'Không tìm thấy dữ liệu cần xóa'); // Trả lỗi về AJAX
            }         
            
        }
        return array('error'=>"Lỗi phương thức truyền dữ liệu");
    }
    
}