<?php

namespace App;

use Illuminate\Notifications\Notifiable;
use Illuminate\Foundation\Auth\User as Authenticatable;
use DB;

class KhachHang extends Authenticatable
{
    use Notifiable;

    protected $table='khach_hang';
    protected $fillable = [
        'id', 'ma_khach_hang', 'ten_khach_hang', 'ten_cong_ty', 'gioi_tinh', 'hinh_anh', 'dia_chi', 'di_dong', 'co_dinh', 'email', 'fax', 'bien_so', 'state'
    ];
    public $timestamps=false;

    public static function taoMa(){
        $soPhieu='';
        $data=DB::select("select max(id) as stt from khach_hang");
        $data = collect($data)->map(function($x){ return (array) $x; })->toArray(); 
        $stt=$data[0]['stt']+1;
        if($stt<10){
            $soPhieu='000'.$stt;
        }elseif($stt>=10 && $stt<100){
            $soPhieu='00'.$stt;
        }elseif ($stt>=100 && $stt<1000) {
            $soPhieu='0'.$stt;
        }else{
            $soPhieu=$stt;
        }
        $soPhieu='KH'.$soPhieu;
        return $soPhieu;
    }
}
