<?php
namespace App\Modules\Email\Controllers;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use GuzzleHttp;
use Illuminate\Support\Facades\DB;
use Request as RequestAjax;
use App\ThongKe;
use App\Jobs\SendEmail;
use App\User;


class EmailController extends Controller{
    /**
     * Create a new authentication controller instance.
     *
     * @return void
     */
    public function __construct(){
        # parent::__construct();
    }

    public function email(Request $request){
        $thongKeChung=ThongKe::thongKeChung();     
        return view('Email::email',compact('thongKeChung'));
    }

    public function guiEmail(Request $request){
        $email=$request->email;
        $noiDung=$request->noi_dung;
        $subject=$request->subject;
        $message = [
           'title' => 'Kính gửi: Anh Phan Văn Thanh',
           'subject'  =>$subject,
           'footer' => 'Cảm ơn và trân trọng./.',
           'content' => $noiDung,
        ];
        SendEmail::dispatch($message, $email)->delay(now()->addMinute(1));
        return redirect()->route('email');
    }
    
}