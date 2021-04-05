<?php
namespace App\Modules\ThongKe\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use App\Modules\ThongKe\Models\ExportThongKeXuatNhapTon;
use Maatwebsite\Excel\Facades\Excel;
use DB;
use App\DonViTinh;
use App\SanPham;
use App\ThongKe;
use Request as RequestAjax;


class ThongKeXuatNhapTonController extends Controller{
    /**
     * Create a new authentication controller instance.
     *
     * @return void
     */
    public function __construct(){
    }

    public function dashboard(Request $request){   
        $thongKeChung=ThongKe::thongKeChung();     
        return view('ThongKe::dashboard.dashboard',compact('thongKeChung'));
    }

    public function thongKeXuatNhapTon(Request $request){   
        $thongKeChung=ThongKe::thongKeChung();     
        return view('ThongKe::thong-ke-xuat-nhap-ton.thong-ke-xuat-nhap-ton',compact('thongKeChung'));
    }


    public function danhSachThongKeXuatNhapTon(Request $request){
        if(RequestAjax::ajax()){ // Kiểm tra gửi đường ajax
            $error=''; // Khai báo biến
            $sanPhams=ThongKe::thongKeXuatNhapTon();
            
            $view=view('ThongKe::thong-ke-xuat-nhap-ton.danh-sach-thong-ke-xuat-nhap-ton', compact('sanPhams','error'))->render(); // Trả dữ liệu ra view 
            return response()->json(['html'=>$view,'error'=>$error]); // Return dữ liệu ra ajax
        }
        return array('error'=>"Lỗi phương thức truyền dữ liệu"); // Trả về lỗi phương thức truyền số liệu
    }

    public function exportThongKe() 
    {
        return Excel::download(new ExportThongKeXuatNhapTon, 'xuat-nhap-ton.xlsx');
    }

    
}