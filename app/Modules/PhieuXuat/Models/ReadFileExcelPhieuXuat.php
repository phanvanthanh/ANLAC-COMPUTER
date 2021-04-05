<?php

namespace App\Modules\PhieuXuat\Models;

use Illuminate\Database\Eloquent\Model;
use Maatwebsite\Excel\Concerns\ToModel;
use Maatwebsite\Excel\Concerns\WithHeadingRow;
use App\PhieuNhap;
use App\SanPham;
use App\DonViTinh;
use App\ChiTietPhieuNhap;
use App\ChiTietPhieuXuat;

use App\PhieuXuat;
use App\KhachHang;
use DateTime;

class ReadFileExcelPhieuXuat implements ToModel, WithHeadingRow
{
    /**
    * @param array $row
    *
    * @return \Illuminate\Database\Eloquent\Model|null
    */
    public function model(array $row)
    {
        // kiểm tra dữ liệu hợp lệ
        if($row['ngay_xuat'] && $row['ma_hang'] && $row['ten_san_pham'] && $row['dvt'] && $row['so_luong'] && $row['gia_xuat'] && $row['thanh_tien']){
            // Kiểm tra phiếu nhập nếu chưa có thì tạo nếu có rồi thì lấy ra xài
            $idPhieuXuat=0;
            $date=DateTime::createFromFormat('d-m-Y', $row['ngay_xuat']);
            $ngayXuat=$date->format('Y-m-d H:i:s');
            $idKhachHang=null;
            if($row['ten_khach_hang']){
                $khachHang=KhachHang::where('ten_khach_hang','=',$row['ten_khach_hang'])->get()->toArray();
                if($khachHang){
                    $idKhachHang=$khachHang[0]['id'];
                }else{
                    $dataKhachHang=array();
                    $dataKhachHang['ten_khach_hang']=$row['ten_khach_hang'];
                    $dataKhachHang['di_dong']=$row['dien_thoai'];
                    $dataKhachHang['dia_chi']=$row['dia_chi'];
                    $dataKhachHang['bien_so']=$row['bien_so'];
                    $dataKhachHang['ma_khach_hang']=KhachHang::taoMa();

                    $khachHang=KhachHang::create($dataKhachHang);
                    $idKhachHang=$khachHang->id;
                }
            }
            if($row['chung_tu']){
                $phieuXuat=PhieuXuat::where('ma_phieu_xuat','=',$row['chung_tu'])->get()->toArray();
                if($phieuXuat){
                    $idPhieuXuat=$phieuXuat[0]['id'];
                }else{
                    $dataPhieuNhap=array(
                        'ngay_xuat'     => $ngayXuat,
                        'ma_phieu_xuat'     => $row['chung_tu'],
                        'id_khach_hang'     => $idKhachHang
                    );
                    $phieuXuat=PhieuXuat::create($dataPhieuNhap);
                    $idPhieuXuat=$phieuXuat->id;
                }
            }else{
                $dataPhieuNhap=array(
                    'ngay_xuat'     => $ngayXuat,
                    'ma_phieu_nhap'     => PhieuXuat::taoSoPhieu(),
                    'id_khach_hang'     => $idKhachHang
                );
                $phieuXuat=PhieuXuat::create($dataPhieuNhap);
                $idPhieuXuat=$phieuXuat->id;
            }
            // Kiểm tra sản phẩm đã tồn tại hay chưa
            $idSanPham=0;
            $sanPham=SanPham::where('ma_san_pham','=',$row['ma_hang'])->get()->toArray();
            // Nếu chưa có thì tạo
            if(!$sanPham){
                // Kiểm tra đơn vị tính
                $idDonViTinh=0;
                $donViTinh=DonViTinh::where('ten_don_vi_tinh','=',$row['dvt'])->get()->toArray();
                if($donViTinh){
                    $idDonViTinh=$donViTinh[0]['id'];
                }else{
                    $dataDonViTinh=array(
                        'ten_don_vi_tinh'=>$row['dvt'],
                        'state' =>1
                    );
                    $donViTinh=DonViTinh::create($dataDonViTinh);
                    $idDonViTinh=$donViTinh->id;
                }
                // Thêm sản phẩm
                $dataSanPham=array(
                    'ten_san_pham'=>$row['ten_san_pham'],
                    'ma_san_pham'=>$row['ma_hang'],
                    'id_don_vi_tinh'=>$idDonViTinh
                );
                $sanPham=SanPham::create($dataSanPham);
                $idSanPham=$sanPham->id;
            }else{
                $idSanPham=$sanPham[0]['id'];
            }

            $danhSachChiTietPhieuNhaps=ChiTietPhieuNhap::layDanhSachChiTietPhieuNhapConTon($idSanPham);
            $soLuong=$row['so_luong'];
            foreach ($danhSachChiTietPhieuNhaps as $key => $chiTietPhieuNhap) {
                $soLuongTru=0;
                if($soLuong>0){
                    $soLuongConLai=$chiTietPhieuNhap['so_luong']-$chiTietPhieuNhap['so_luong_da_xuat'];
                    if(($soLuongConLai-$soLuong)>=0){
                        $soLuongTru=$soLuong;
                        $soLuong=0;

                    }else{
                        $soLuongTru=$soLuongConLai;
                        $soLuong=$soLuong-$soLuongConLai;
                    }
                    


                    $updateChiTietPhieuNhap=ChiTietPhieuNhap::find($chiTietPhieuNhap['id']);
                    $soLuongDaXuat=$updateChiTietPhieuNhap->so_luong_da_xuat+$soLuongTru;
                    $updateChiTietPhieuNhap->so_luong_da_xuat=$soLuongDaXuat;
                    $updateChiTietPhieuNhap->update();

                    $dataChiTietPhieuXuat=array();
                    $dataChiTietPhieuXuat['id_phieu_xuat']=$idPhieuXuat;
                    $dataChiTietPhieuXuat['id_chi_tiet_phieu_nhap']=$chiTietPhieuNhap['id'];
                    $dataChiTietPhieuXuat['id_san_pham']=$idSanPham;
                    $dataChiTietPhieuXuat['gia_xuat']=$row['gia_xuat'];
                    $dataChiTietPhieuXuat['gia_von']=$updateChiTietPhieuNhap->gia_nhap;
                    $dataChiTietPhieuXuat['so_luong']=$soLuongTru;
                    $dataChiTietPhieuXuat['thanh_tien']=$row['gia_xuat']*$soLuongTru;
                    $dataChiTietPhieuXuat['giam_gia']=0;
                    $dataChiTietPhieuXuat['ghi_chu']='';
                    $dataChiTietPhieuXuat['state']=0;
                    $chiTietPhieuXuat=ChiTietPhieuXuat::create($dataChiTietPhieuXuat);
                }
            }
        }
    }
}