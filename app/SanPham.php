<?php

namespace App;

use Illuminate\Notifications\Notifiable;
use Illuminate\Foundation\Auth\User as Authenticatable;
use DB;

class SanPham extends Authenticatable
{
    use Notifiable;

    protected $table='san_pham';
    protected $fillable = [
        'id', 'id_don_vi_tinh', 'ten_san_pham', 'ma_san_pham', 'mo_ta_san_pham', 'hinh_anh', 'gia_nhap_goi_y', 'gia_xuat_goi_y', 'state'
    ];
    public $timestamps=false;

    public static function layDanhSachSanPhamTonKho(){
    	$data=DB::select('select sp.id, sp.ten_san_pham, sp.ma_san_pham, sp.hinh_anh, sp.gia_nhap_goi_y, sp.gia_xuat_goi_y, sp.mo_ta_san_pham, dvt.ten_don_vi_tinh, ctpn.gia_nhap,
			sum(ctpn.so_luong) as so_luong, sum(ctpn.so_luong_da_xuat) as so_luong_da_xuat from san_pham sp
			left join chi_tiet_phieu_nhap ctpn on sp.id=ctpn.id_san_pham
			left join don_vi_tinh dvt on sp.id_don_vi_tinh=dvt.id
			group by sp.id, sp.ten_san_pham, sp.ma_san_pham, sp.hinh_anh, sp.gia_nhap_goi_y, sp.gia_xuat_goi_y, sp.mo_ta_san_pham, dvt.ten_don_vi_tinh, ctpn.gia_nhap');
		$data = collect($data)->map(function($x){ return (array) $x; })->toArray(); 
		return $data;
    }

    public static function layChiTietSanPhamTheoMa($maSanPham){
    	$data=DB::select('select t1.id, t1.ten_san_pham, t1.ma_san_pham, t1.gia_xuat_goi_y, t1.gia_nhap, t1.so_luong, t2.so_luong_xuat from(
			select sp.id, sp.ten_san_pham, sp.ma_san_pham, sp.gia_xuat_goi_y, 
				max(ctpn.gia_nhap) as gia_nhap, sum(ctpn.so_luong) as so_luong
			from san_pham sp
			left join chi_tiet_phieu_nhap ctpn on sp.id=ctpn.id_san_pham
			where sp.ma_san_pham="'.$maSanPham.'"
			group by sp.id, sp.ten_san_pham, sp.ma_san_pham, sp.gia_xuat_goi_y
		) as t1
		left join(
			select ctpx.id_san_pham, sum(ctpx.so_luong) as so_luong_xuat from chi_tiet_phieu_xuat ctpx
			left join san_pham sp2 on ctpx.id_san_pham=sp2.id
			where sp2.ma_san_pham="'.$maSanPham.'"
			group by ctpx.id_san_pham
		) as t2 on t1.id=t2.id_san_pham');
		$data = collect($data)->map(function($x){ return (array) $x; })->toArray(); 
		$result=array();
		if($data){
			$result=$data[0];
		}
		return $result;
    }
}
