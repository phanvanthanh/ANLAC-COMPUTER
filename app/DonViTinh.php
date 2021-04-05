<?php

namespace App;
use DB;

use Illuminate\Database\Eloquent\Model;

class DonViTinh extends Model
{
    protected $table='don_vi_tinh';
    protected $fillable=['id','ten_don_vi_tinh', 'state'];
    public $timestamps=false;

}
