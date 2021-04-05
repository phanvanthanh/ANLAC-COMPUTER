<?php

namespace App;

use Illuminate\Notifications\Notifiable;
use Illuminate\Foundation\Auth\User as Authenticatable;
use DB;

class ChiTietPhieuXuat extends Authenticatable
{
    use Notifiable;

    protected $table='chi_tiet_phieu_xuat';
    protected $fillable = [
        'id', 'id_phieu_xuat', 'id_chi_tiet_phieu_nhap', 'id_san_pham', 'gia_xuat', 'gia_von', 'so_luong', 'so_luong_da_xuat', 'giam_gia', 'thanh_tien', 'ghi_chu', 'state'
    ];
    public $timestamps=false;

    public static function getChiTietPhieuXuatByIdPhieuXuat($idPhieuXuat){
    	$data=ChiTietPhieuXuat::select('chi_tiet_phieu_xuat.id','chi_tiet_phieu_xuat.id_san_pham','phieu_xuat.id_khach_hang','chi_tiet_phieu_xuat.gia_xuat','chi_tiet_phieu_xuat.so_luong','chi_tiet_phieu_xuat.giam_gia','chi_tiet_phieu_xuat.thanh_tien','chi_tiet_phieu_xuat.ghi_chu','chi_tiet_phieu_xuat.state', 'don_vi_tinh.ten_don_vi_tinh', 'san_pham.ma_san_pham', 'san_pham.ten_san_pham')
        ->leftJoin('phieu_xuat','chi_tiet_phieu_xuat.id_phieu_xuat','=','phieu_xuat.id')
        ->leftJoin('san_pham','chi_tiet_phieu_xuat.id_san_pham','=','san_pham.id')
        ->leftJoin('don_vi_tinh','san_pham.id_don_vi_tinh','=','don_vi_tinh.id')
        ->where('id_phieu_xuat','=',$idPhieuXuat)->get()->toArray();
        return $data;
    }

    public static function checkSoLuongTonSanPhamTheoIdSanPham($idSanPham){
        $phieuNhap=DB::select("SELECT SUM(so_luong) as so_luong_nhap FROM chi_tiet_phieu_nhap ctpn where ctpn.id_san_pham=".$idSanPham);
        $phieuNhap = collect($phieuNhap)->map(function($x){ return (array) $x; })->toArray(); 
        $result=array();
        $result['so_luong_nhap']=0;
        $result['so_luong_xuat']=0;
        $result['id_san_pham']=$idSanPham;
        if($phieuNhap && isset($phieuNhap[0]['so_luong_nhap']) && $phieuNhap[0]['so_luong_nhap']){
            $result['so_luong_nhap']=$phieuNhap[0]['so_luong_nhap'];
        }

        $phieuXuat=DB::select("SELECT SUM(so_luong) as so_luong_xuat FROM chi_tiet_phieu_xuat ctpx where ctpx.id_san_pham=".$idSanPham);
        $phieuXuat = collect($phieuXuat)->map(function($x){ return (array) $x; })->toArray(); 
        if($phieuXuat && isset($phieuXuat[0]['so_luong_xuat']) && $phieuXuat[0]['so_luong_xuat']){
            $result['so_luong_xuat']=$phieuXuat[0]['so_luong_xuat'];
        }
        $result['so_luong_con_lai']=$result['so_luong_nhap']-$result['so_luong_xuat'];
        return $result;
    }

    
}
