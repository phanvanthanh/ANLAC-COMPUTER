<?php

namespace App;

use Illuminate\Notifications\Notifiable;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Support\Collection;
use DB;
use App\SanPham;
use App\CongNo;

class ThongKe extends Authenticatable
{
    use Notifiable;


    public static function thongKeXuatNhapTon(){
    	$data=DB::select("SELECT sp.id, sp.id_don_vi_tinh, dvt.ten_don_vi_tinh, sp.ten_san_pham, sp.ma_san_pham, sp.mo_ta_san_pham FROM san_pham sp 
			LEFT JOIN don_vi_tinh dvt on sp.id_don_vi_tinh=dvt.id");
		$data = collect($data)->map(function($x){ return (array) $x; })->toArray(); 
		return $data;
    }

    public static function exportThongKeXuatNhapTon(){
    	$data=DB::select("SELECT sp.id, sp.id_don_vi_tinh, dvt.ten_don_vi_tinh, sp.ten_san_pham, sp.ma_san_pham, sp.mo_ta_san_pham FROM san_pham sp 
			LEFT JOIN don_vi_tinh dvt on sp.id_don_vi_tinh=dvt.id");
		$data = collect($data)->map(function($x){ return (array) $x; })->toArray(); 
		$stt=0;
		$result=array();
		foreach ($data as $key => $d) {
			$stt++;
			$thongKeChung=\Helper::thongKeChungTheoIdSanPham($d['id']);
			$d2['stt']=number_format($stt,0);
			$d2['ma_san_pham']=$d['ma_san_pham'];
			$d2['ten_san_pham']=$d['ten_san_pham'];
			$d2['ten_don_vi_tinh']=$d['ten_don_vi_tinh'];
			$d2['so_luong_nhap']=number_format($thongKeChung['so_luong_nhap'],0);
			$d2['so_luong_xuat']=number_format($thongKeChung['so_luong_xuat'],0);
			$d2['so_luong_ton']=number_format($thongKeChung['so_luong_ton'],0);
			$d2['von_xuat']=number_format($thongKeChung['von_xuat'],0);
			$doanhThu=$thongKeChung['thanh_tien_xuat']-$thongKeChung['giam_gia_xuat'];
			$d2['doanh_thu']=number_format($doanhThu,0);
			$laiLo=$thongKeChung['thanh_tien_xuat']-($thongKeChung['von_xuat']+$thongKeChung['giam_gia_xuat']);
			$d2['lai_lo']=number_format($laiLo,0);
			$result[]=$d2;
		}
    	$collection = collect($result);
		$collection = Collection::make($collection);
		return $collection;
    }


    public static function thongKeChung(){
    	$result=array();
    	$phieuXuat=DB::select('select count(id) as tong_so_phieu_xuat from phieu_xuat');
		$phieuXuat = collect($phieuXuat)->map(function($x){ return (array) $x; })->toArray(); 
		$result['tong_so_phieu_xuat']=0;
		if($phieuXuat){
			$result['tong_so_phieu_xuat']=$phieuXuat[0]['tong_so_phieu_xuat'];
		}

		$phieuNhap=DB::select('select count(id) as tong_so_phieu_nhap from phieu_nhap');
		$phieuNhap = collect($phieuNhap)->map(function($x){ return (array) $x; })->toArray(); 
		$result['tong_so_phieu_nhap']=0;
		if($phieuNhap){
			$result['tong_so_phieu_nhap']=$phieuNhap[0]['tong_so_phieu_nhap'];
		}

		$chiTietPhieuXuat=DB::select('select sum(thanh_tien) as thanh_tien_xuat, sum(giam_gia) as giam_gia_xuat from chi_tiet_phieu_xuat');
		$chiTietPhieuXuat = collect($chiTietPhieuXuat)->map(function($x){ return (array) $x; })->toArray(); 
		$result['thanh_tien_xuat']=0;
		$result['giam_gia_xuat']=0;
		$result['tong_tien_xuat']=0;
		if($chiTietPhieuXuat){
			$result['thanh_tien_xuat']=$chiTietPhieuXuat[0]['thanh_tien_xuat'];
			$result['giam_gia_xuat']=$chiTietPhieuXuat[0]['giam_gia_xuat'];
			$result['tong_tien_xuat']=$chiTietPhieuXuat[0]['thanh_tien_xuat']-$chiTietPhieuXuat[0]['giam_gia_xuat'];
		}


		$chiTietPhieuNhap=DB::select('select sum(thanh_tien) as thanh_tien_nhap, sum(giam_gia) as giam_gia_nhap from chi_tiet_phieu_nhap');
		$chiTietPhieuNhap = collect($chiTietPhieuNhap)->map(function($x){ return (array) $x; })->toArray(); 
		$result['thanh_tien_nhap']=0;
		$result['giam_gia_nhap']=0;
		$result['tong_tien_nhap']=0;
		if($chiTietPhieuNhap){
			$result['thanh_tien_nhap']=$chiTietPhieuNhap[0]['thanh_tien_nhap'];
			$result['giam_gia_nhap']=$chiTietPhieuNhap[0]['giam_gia_nhap'];
			$result['tong_tien_nhap']=$chiTietPhieuNhap[0]['thanh_tien_nhap']-$chiTietPhieuNhap[0]['giam_gia_nhap'];
		}
		$phieuXuat=array();
		$phieuXuat=DB::select('select sum(gia_von*so_luong) as gia_von_xuat from chi_tiet_phieu_xuat');
		$phieuXuat = collect($phieuXuat)->map(function($x){ return (array) $x; })->toArray(); 
		$result['gia_von_xuat']=0;
		if($phieuXuat){
			$result['gia_von_xuat']=$phieuXuat[0]['gia_von_xuat'];
		}


		// Sản phẩm
		$sanPham=DB::select("SELECT SUM(ctpn.so_luong) AS sp_so_luong_nhap, SUM(ctpn.so_luong_da_xuat) AS sp_so_luong_da_xuat, SUM(ctpn.so_luong-ctpn.so_luong_da_xuat) AS sp_so_long_ton, SUM((ctpn.gia_nhap)*(ctpn.so_luong-ctpn.so_luong_da_xuat)) as sp_tong_tien_ton FROM san_pham sp
			LEFT JOIN chi_tiet_phieu_nhap ctpn ON sp.id=ctpn.id_san_pham
		");
		$sanPham = collect($sanPham)->map(function($x){ return (array) $x; })->toArray(); 
		$result['sp_so_luong_nhap']=0;
		$result['sp_so_luong_da_xuat']=0;
		$result['sp_so_long_ton']=0;
		$result['sp_tong_tien_ton']=0;
		if($sanPham){
			$result['sp_so_luong_nhap']=$sanPham[0]['sp_so_luong_nhap'];
			$result['sp_so_luong_da_xuat']=$sanPham[0]['sp_so_luong_da_xuat'];
			$result['sp_so_long_ton']=$sanPham[0]['sp_so_long_ton'];
			$result['sp_tong_tien_ton']=$sanPham[0]['sp_tong_tien_ton'];
		}

		$sanPham=DB::select("SELECT COUNT(sp.id) as sp_so_san_pham FROM san_pham sp
		");
		$sanPham = collect($sanPham)->map(function($x){ return (array) $x; })->toArray(); 
		$result['sp_so_san_pham']=0;
		if($sanPham){
			$result['sp_so_san_pham']=$sanPham[0]['sp_so_san_pham'];
		}


		// Khách hàng
		$khachHang=DB::select("SELECT SUM(thanh_tien) AS kh_tong_thanh_tien, SUM(giam_gia) AS kh_tong_giam_gia FROM chi_tiet_phieu_xuat
		");
		$khachHang = collect($khachHang)->map(function($x){ return (array) $x; })->toArray(); 
		$result['kh_tong_thanh_tien']=0;
		$result['kh_tong_giam_gia']=0;
		if($khachHang){
			$result['kh_tong_thanh_tien']=$khachHang[0]['kh_tong_thanh_tien'];
			$result['kh_tong_giam_gia']=$khachHang[0]['kh_tong_giam_gia'];
		}

		$khachHang=DB::select("SELECT SUM(da_thanh_toan) AS kh_da_thanh_toan FROM phieu_xuat
		");
		$khachHang = collect($khachHang)->map(function($x){ return (array) $x; })->toArray(); 
		$result['kh_da_thanh_toan']=0;
		if($khachHang){
			$result['kh_da_thanh_toan']=$khachHang[0]['kh_da_thanh_toan'];
		}

		$khachHang=DB::select("SELECT COUNT(id) AS kh_so_luong_khach_hang FROM khach_hang
		");
		$khachHang = collect($khachHang)->map(function($x){ return (array) $x; })->toArray(); 
		$result['kh_so_luong_khach_hang']=0;
		if($khachHang){
			$result['kh_so_luong_khach_hang']=$khachHang[0]['kh_so_luong_khach_hang'];
		}

		// Đối tác (nhà cung cấp)
		$doiTac=DB::select("SELECT SUM(thanh_tien) AS dt_tong_thanh_tien, SUM(giam_gia) AS dt_tong_giam_gia FROM chi_tiet_phieu_nhap
		");
		$doiTac = collect($doiTac)->map(function($x){ return (array) $x; })->toArray(); 
		$result['dt_tong_thanh_tien']=0;
		$result['dt_tong_giam_gia']=0;
		if($doiTac){
			$result['dt_tong_thanh_tien']=$doiTac[0]['dt_tong_thanh_tien'];
			$result['dt_tong_giam_gia']=$doiTac[0]['dt_tong_giam_gia'];
		}

		$doiTac=DB::select("SELECT SUM(da_thanh_toan) AS dt_da_thanh_toan FROM phieu_nhap
		");
		$doiTac = collect($doiTac)->map(function($x){ return (array) $x; })->toArray(); 
		$result['dt_da_thanh_toan']=0;
		if($doiTac){
			$result['dt_da_thanh_toan']=$doiTac[0]['dt_da_thanh_toan'];
		}

		$doiTac=DB::select("SELECT COUNT(id) AS dt_so_luong_doi_tac FROM doi_tac
		");
		$doiTac = collect($doiTac)->map(function($x){ return (array) $x; })->toArray(); 
		$result['dt_so_luong_doi_tac']=0;
		if($doiTac){
			$result['dt_so_luong_doi_tac']=$doiTac[0]['dt_so_luong_doi_tac'];
		}

		// Tài khoản (User)
		$user=DB::select("SELECT COUNT(id) AS user_so_luong FROM users
		");
		$user = collect($user)->map(function($x){ return (array) $x; })->toArray(); 
		$result['user_so_luong']=0;
		if($user){
			$result['user_so_luong']=$user[0]['user_so_luong'];
		}


		// Công nợ
		$soKhachHangConNo=CongNo::laySoLuongCongNo();
        $result['cn_so_khach_hang_con_no']=$soKhachHangConNo;

        // Thống kê phiếu chi
        $phieuChi=DB::select("SELECT COUNT(id) AS pc_so_luong FROM phieu_chi
		");
		$phieuChi = collect($phieuChi)->map(function($x){ return (array) $x; })->toArray(); 
		$result['pc_so_luong']=0;
		if($phieuChi){
			$result['pc_so_luong']=$phieuChi[0]['pc_so_luong'];
		}

		$phieuChi=DB::select("SELECT SUM(tong_chi) AS tong_chi FROM phieu_chi
		");
		$phieuChi = collect($phieuChi)->map(function($x){ return (array) $x; })->toArray(); 
		$result['pc_tong_chi']=0;
		if($phieuChi){
			$result['pc_tong_chi']=$phieuChi[0]['tong_chi'];
		}

		// Đối tác (nhà cung cấp)
		$namHienTai=date('Y');
		$loiNhuanTheoThang=DB::select("select DATE_FORMAT(px.ngay_xuat,'%m') AS thang_xuat, DATE_FORMAT(px.ngay_xuat,'%Y') AS nam_xuat, sum(ctpx.gia_von*ctpx.so_luong) as gia_von_xuat, sum(ctpx.thanh_tien) as thanh_tien_xuat, sum(ctpx.giam_gia) as giam_gia_xuat 
			from chi_tiet_phieu_xuat ctpx
			left join phieu_xuat px on ctpx.id_phieu_xuat=px.id
			where DATE_FORMAT(px.ngay_xuat,'%Y')=".$namHienTai."
			group by DATE_FORMAT(px.ngay_xuat,'%m'), DATE_FORMAT(px.ngay_xuat,'%Y')
		");
		$loiNhuanTheoThang = collect($loiNhuanTheoThang)->map(function($x){ return (array) $x; })->toArray();
		$loiNhuanTheoThangs=array();
		foreach ($loiNhuanTheoThang as $loiNhuanThang) {
			$loiNhuan=$loiNhuanThang['thanh_tien_xuat']-($loiNhuanThang['gia_von_xuat']+$loiNhuanThang['giam_gia_xuat']);
			$loiNhuanThang['loi_nhuan']=$loiNhuan;
			$loiNhuanTheoThangs[$loiNhuanThang['thang_xuat']]=$loiNhuanThang;
		}
		$result['loi_nhuan_theo_thang']=$loiNhuanTheoThangs;


		return $result;
    }
}
