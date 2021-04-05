<?php

namespace App;

use Illuminate\Notifications\Notifiable;
use Illuminate\Foundation\Auth\User as Authenticatable;
use DB;

class ChiTietPhieuNhap extends Authenticatable
{
    use Notifiable;

    protected $table='chi_tiet_phieu_nhap';
    protected $fillable = [
        'id', 'id_phieu_nhap', 'id_san_pham', 'gia_nhap', 'so_luong', 'giam_gia', 'thanh_tien', 'ghi_chu', 'state'
    ];
    public $timestamps=false;


    public static function getChiTietPhieuNhapByIdPhieuNhap($idPhieuNhap){
    	$data=ChiTietPhieuNhap::select('chi_tiet_phieu_nhap.id','chi_tiet_phieu_nhap.id_san_pham','phieu_nhap.id_doi_tac','chi_tiet_phieu_nhap.gia_nhap','chi_tiet_phieu_nhap.so_luong','chi_tiet_phieu_nhap.giam_gia','chi_tiet_phieu_nhap.thanh_tien','chi_tiet_phieu_nhap.ghi_chu','chi_tiet_phieu_nhap.state', 'don_vi_tinh.ten_don_vi_tinh', 'san_pham.ma_san_pham', 'san_pham.ten_san_pham')
        ->leftJoin('phieu_nhap','chi_tiet_phieu_nhap.id_phieu_nhap','=','phieu_nhap.id')
        ->leftJoin('san_pham','chi_tiet_phieu_nhap.id_san_pham','=','san_pham.id')
        ->leftJoin('don_vi_tinh','san_pham.id_don_vi_tinh','=','don_vi_tinh.id')
        ->where('id_phieu_nhap','=',$idPhieuNhap)->get()->toArray();
        return $data;
    }

    public static function layDanhSachChiTietPhieuNhapConTon($idSanPham){
        $data=DB::select('select * from (
            select ctpn.id, sum(ctpn.so_luong) as so_luong, sum(ctpn.so_luong_da_xuat) as so_luong_da_xuat from chi_tiet_phieu_nhap ctpn 
            where ctpn.id_san_pham='.$idSanPham.'
            group by ctpn.id
        ) as t1 where (t1.so_luong-t1.so_luong_da_xuat)>0');
        $data = collect($data)->map(function($x){ return (array) $x; })->toArray(); 
        return $data;
    }
}
