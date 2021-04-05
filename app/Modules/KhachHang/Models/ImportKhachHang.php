<?php

namespace App\Modules\KhachHang\Models;

use Illuminate\Database\Eloquent\Model;
use Maatwebsite\Excel\Concerns\ToModel;
use Maatwebsite\Excel\Concerns\WithHeadingRow;
use App\KhachHang;
use DateTime;

class ImportKhachHang implements ToModel, WithHeadingRow
{
    /**
    * @param array $row
    *
    * @return \Illuminate\Database\Eloquent\Model|null
    */
    public function model(array $row)
    {
        // Kiểm tra sản phẩm đã tồn tại hay chưa
        $khachHang=KhachHang::where('ma_khach_hang','=',$row['ma_khach_hang'])->get()->toArray();
        // Nếu chưa có thì tạo
        if(!$khachHang){
            // Thêm sản phẩm
            $gioiTinh=0;
            if($row['gioi_tinh']=='Nam'){
                $gioiTinh=1;
            }
            $data=array(
                'ma_khach_hang'=>$row['ma_khach_hang'],
                'ten_khach_hang'=>$row['ten_khach_hang'],
                'ten_cong_ty'=>$row['ten_cong_ty'],
                'gioi_tinh'=>$gioiTinh,
                'dia_chi'=>$row['dia_chi'],
                'di_dong'=>$row['di_dong'],
                'co_dinh'=>$row['so_dien_thoai_co_dinh'],
                'bien_so'=>$row['bien_so'],
                'email'=>$row['email'],
                'fax'=>$row['fax']
            );
            $khachHang=KhachHang::create($data);
        }
    }
}