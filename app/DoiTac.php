<?php

namespace App;

use Illuminate\Notifications\Notifiable;
use Illuminate\Foundation\Auth\User as Authenticatable;
use DB;

class DoiTac extends Authenticatable
{
    use Notifiable;

    protected $table='doi_tac';
    protected $fillable = [
        'id', 'ma_doi_tac', 'ten_doi_tac', 'ten_cong_ty', 'gioi_tinh', 'hinh_anh', 'dia_chi', 'di_dong', 'co_dinh', 'email', 'fax', 'state', 'bien_so'
    ];
    public $timestamps=false;

    public static function taoMa(){
        $soPhieu='';
        $data=DB::select("select max(id) as stt from doi_tac");
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
        $soPhieu='DT'.$soPhieu;
        return $soPhieu;
    }
}
