<?php

namespace App;

use Illuminate\Notifications\Notifiable;
use Illuminate\Foundation\Auth\User as Authenticatable;
use DB;

class PhieuChi extends Authenticatable
{
    use Notifiable;

    protected $table='phieu_chi';
    protected $fillable = [
        'id', 'id_user', 'ma_phieu_chi', 'tong_chi', 'noi_dung', 'ghi_chu', 'da_duyet', 'ngay_chi', 'file'
    ];
    public $timestamps=false;

    public static function taoSoPhieu(){
        $soPhieu='';
        $data=DB::select("select count(id) as stt from phieu_chi where date_format(date(ngay_chi),'%Y-%m-%d')=date_format(date(sysdate()),'%Y-%m-%d')");
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
        $soPhieu='PC'.date('dmy').'-'.$soPhieu;
        return $soPhieu;
    }

    public static function layDanhSachPhieuChi(){
    	$data=DB::table('phieu_chi as pc')
    	->leftJoin('users as us','pc.id_user','=','us.id')
    	->select('pc.id', 'pc.id_user', 'pc.ma_phieu_chi', 'pc.tong_chi', 'pc.noi_dung', 'pc.ghi_chu', 'pc.da_duyet', 'pc.ngay_chi', 'pc.file', 'us.name')
    	->get();
    	$data = collect($data)->map(function($x){ return (array) $x; })->toArray(); 
    	return $data;
    }
}
