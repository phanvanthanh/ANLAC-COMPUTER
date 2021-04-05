<?php

namespace App;
use DB;

use Illuminate\Database\Eloquent\Model;

class DonVi extends Model
{
    protected $table='don_vi';
    protected $fillable=['id','ten_don_vi', 'ma_don_vi', 'ma_phuong_xa', 'ma_cap', 'ma_dinh_danh', 'email', 'co_dinh', 'di_dong', 'fax', 'parent_id', 'level', 'state'];
    //protected $hidden=[''] // danh sách các trường muốn ẩn
    public $timestamps=false;

    
}
