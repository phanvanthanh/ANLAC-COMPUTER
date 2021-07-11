<?php

namespace App;

use Illuminate\Notifications\Notifiable;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Support\Collection;
use DB;

class CongNo extends Authenticatable
{
    use Notifiable;


    public static function layDanhSachCongNo(){
    	$data=DB::select("SELECT t1.id, t1.ten_khach_hang, t1.hinh_anh, t1.ten_cong_ty, t1.di_dong, t1.dia_chi, SUM(t1.tong_no) AS tong_no FROM(
				SELECT px.id_khach_hang AS id, px.id AS id_phieu_xuat, kh.hinh_anh, kh.ten_khach_hang, kh.ten_cong_ty, kh.di_dong, kh.dia_chi, px.da_thanh_toan, (SUM(ctpx.thanh_tien)-(px.da_thanh_toan+SUM(ctpx.giam_gia))) AS tong_no 
				FROM phieu_xuat px
				LEFT JOIN chi_tiet_phieu_xuat ctpx ON px.id=ctpx.id_phieu_xuat
				LEFT JOIN khach_hang kh ON px.id_khach_hang=kh.id
				GROUP BY px.id_khach_hang, px.id, kh.hinh_anh, kh.ten_khach_hang, kh.ten_cong_ty, kh.di_dong, kh.dia_chi, px.da_thanh_toan
			) AS t1
			WHERE t1.tong_no>0 
			GROUP BY t1.id, t1.ten_khach_hang, t1.hinh_anh, t1.ten_cong_ty, t1.di_dong, t1.dia_chi"
		);
		$data = collect($data)->map(function($x){ return (array) $x; })->toArray(); 
		return $data;
    }

    public static function laySoLuongCongNo(){
    	$data=DB::select("SELECT count(t2.id) so_luong_cong_no FROM(
			SELECT t1.id, t1.ten_khach_hang, t1.hinh_anh, t1.ten_cong_ty, t1.di_dong, t1.dia_chi, SUM(t1.tong_no) AS tong_no FROM(
					SELECT px.id_khach_hang AS id, px.id AS id_phieu_xuat, kh.hinh_anh, kh.ten_khach_hang, kh.ten_cong_ty, kh.di_dong, kh.dia_chi, px.da_thanh_toan, (SUM(ctpx.thanh_tien)-(px.da_thanh_toan+SUM(ctpx.giam_gia))) AS tong_no 
					FROM phieu_xuat px
					LEFT JOIN chi_tiet_phieu_xuat ctpx ON px.id=ctpx.id_phieu_xuat
					LEFT JOIN khach_hang kh ON px.id_khach_hang=kh.id
					GROUP BY px.id_khach_hang, px.id, kh.hinh_anh, kh.ten_khach_hang, kh.ten_cong_ty, kh.di_dong, kh.dia_chi, px.da_thanh_toan
				) AS t1
				WHERE t1.tong_no>0 
				GROUP BY t1.id, t1.ten_khach_hang, t1.hinh_anh, t1.ten_cong_ty, t1.di_dong, t1.dia_chi
			) AS t2"
		);
		$data = collect($data)->map(function($x){ return (array) $x; })->toArray(); 
		$soLuongCongNo=0;
		if($data){
			$soLuongCongNo=$data[0]['so_luong_cong_no'];
		}
		return $soLuongCongNo;
    }

    public static function laySoPhieuNoTheoIdKhachHang($id){
    	$data=DB::select("SELECT * FROM(
				SELECT px.id, px.ngay_xuat, px.ma_phieu_xuat, px.id_khach_hang, px.da_thanh_toan, px.ghi_chu, (SUM(ctpx.thanh_tien)-(px.da_thanh_toan+SUM(ctpx.giam_gia))) AS tong_no 
				FROM phieu_xuat px
				LEFT JOIN chi_tiet_phieu_xuat ctpx ON px.id=ctpx.id_phieu_xuat
				LEFT JOIN khach_hang kh ON px.id_khach_hang=kh.id
				GROUP BY  px.id, px.ngay_xuat, px.ma_phieu_xuat, px.id_khach_hang, px.da_thanh_toan, px.ghi_chu
			) AS t1
			WHERE t1.tong_no>0 and t1.id_khach_hang=".$id
		);
		$data = collect($data)->map(function($x){ return (array) $x; })->toArray(); 
		return $data;
    }

    
}
