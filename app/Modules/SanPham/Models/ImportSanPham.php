<?php

namespace App\Modules\SanPham\Models;

use Illuminate\Database\Eloquent\Model;
use Maatwebsite\Excel\Concerns\ToModel;
use Maatwebsite\Excel\Concerns\WithHeadingRow;
use App\SanPham;
use App\DonViTinh;
use DateTime;

class ImportSanPham implements ToModel, WithHeadingRow
{
    /**
    * @param array $row
    *
    * @return \Illuminate\Database\Eloquent\Model|null
    */
    public function model(array $row)
    {
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
                'mo_ta'=>$row['mo_ta'],
                'gia_nhap_goi_y'=>$row['gia_nhap_uoc_tinh'],
                'gia_xuat_goi_y'=>$row['gia_xuat_uoc_tinh'],
                'id_don_vi_tinh'=>$idDonViTinh
            );
            $sanPham=SanPham::create($dataSanPham);
            $idSanPham=$sanPham->id;
        }
    }
}