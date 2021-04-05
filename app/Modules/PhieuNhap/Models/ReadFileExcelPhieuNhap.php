<?php

namespace App\Modules\PhieuNhap\Models;

use Illuminate\Database\Eloquent\Model;
use Maatwebsite\Excel\Concerns\ToModel;
use Maatwebsite\Excel\Concerns\WithHeadingRow;
use App\PhieuNhap;
use App\SanPham;
use App\DonViTinh;
use App\ChiTietPhieuNhap;
use App\DoiTac;
use DateTime;

class ReadFileExcelPhieuNhap implements ToModel, WithHeadingRow
{
    /**
    * @param array $row
    *
    * @return \Illuminate\Database\Eloquent\Model|null
    */
    public function model(array $row)
    {
        // kiểm tra dữ liệu hợp lệ
        if($row['ngay_nhap'] && $row['ma_hang'] && $row['ten'] && $row['dvt'] && $row['so_luong'] && $row['gia_nhap'] && $row['thanh_tien']){
            $idPhieuNhap=0;
            $date=DateTime::createFromFormat('d-m-Y', $row['ngay_nhap']);
            $ngayNhap=$date->format('Y-m-d H:i:s');
            $idDoiTac=null;
            if($row['nha_cung_cap']){
                $doiTac=DoiTac::where('ten_doi_tac','=',$row['nha_cung_cap'])->get()->toArray();
                if($doiTac){
                    $idDoiTac=$doiTac[0]['id'];
                }else{
                    $dataDoiTac=array();
                    $dataDoiTac['ten_doi_tac']=$row['nha_cung_cap'];
                    $dataDoiTac['ma_doi_tac']=DoiTac::taoMa();

                    $doiTac=DoiTac::create($dataDoiTac);
                    $idDoiTac=$doiTac->id;
                }
            }
            if($row['chung_tu']){
                $phieuNhap=PhieuNhap::where('ma_phieu_nhap','=',$row['chung_tu'])->get()->toArray();
                if($phieuNhap){
                    $idPhieuNhap=$phieuNhap[0]['id'];
                }else{
                    $dataPhieuNhap=array(
                        'ngay_nhap'     => $ngayNhap,
                        'ma_phieu_nhap'     => $row['chung_tu'],
                        'id_doi_tac'     => $idDoiTac
                    );
                    $phieuNhap=PhieuNhap::create($dataPhieuNhap);
                    $idPhieuNhap=$phieuNhap->id;
                }
            }else{
                $dataPhieuNhap=array(
                    'ngay_nhap'     => $ngayNhap,
                    'ma_phieu_nhap'     => PhieuNhap::taoSoPhieu(),
                    'id_doi_tac'     => $idDoiTac
                );
                $phieuNhap=PhieuNhap::create($dataPhieuNhap);
                $idPhieuNhap=$phieuNhap->id;
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
                    'ten_san_pham'=>$row['ten'],
                    'ma_san_pham'=>$row['ma_hang'],
                    'id_don_vi_tinh'=>$idDonViTinh
                );
                $sanPham=SanPham::create($dataSanPham);
                $idSanPham=$sanPham->id;
            }else{
                $idSanPham=$sanPham[0]['id'];
            }

            // Tạo chi tiết phiếu nhập
            $dataChiTietPhieuNhap=array(
                'id_phieu_nhap' => $idPhieuNhap,
                'id_san_pham' => $idSanPham,
                'gia_nhap' => $row['gia_nhap'],
                'so_luong' => $row['so_luong'],
                'so_luong_da_xuat' => 0,
                'giam_gia' => 0,
                'thanh_tien' => $row['thanh_tien'],
                'ghi_chu' => $row['ghi_chu'],
                'state' => 1
            );
            $chiTietPhieuNhap=ChiTietPhieuNhap::create($dataChiTietPhieuNhap);
        }
    }
}