<?php

namespace App\Modules\DoiTac\Models;

use Illuminate\Database\Eloquent\Model;
use Maatwebsite\Excel\Concerns\ToModel;
use Maatwebsite\Excel\Concerns\WithHeadingRow;
use App\DoiTac;
use DateTime;

class ImportDoiTac implements ToModel, WithHeadingRow
{
    /**
    * @param array $row
    *
    * @return \Illuminate\Database\Eloquent\Model|null
    */
    public function model(array $row)
    {
        // Kiểm tra sản phẩm đã tồn tại hay chưa
        $doiTac=DoiTac::where('ma_doi_tac','=',$row['ma_nha_cung_cap'])->get()->toArray();
        // Nếu chưa có thì tạo
        if(!$doiTac){
            // Thêm sản phẩm
            $gioiTinh=0;
            if($row['gioi_tinh']=='Nam'){
                $gioiTinh=1;
            }
            $data=array(
                'ma_doi_tac'=>$row['ma_nha_cung_cap'],
                'ten_doi_tac'=>$row['ten_nha_cung_cap'],
                'ten_cong_ty'=>$row['ten_cong_ty'],
                'gioi_tinh'=>$gioiTinh,
                'dia_chi'=>$row['dia_chi'],
                'di_dong'=>$row['di_dong'],
                'co_dinh'=>$row['so_dien_thoai_co_dinh'],
                'bien_so'=>$row['bien_so'],
                'email'=>$row['email'],
                'fax'=>$row['fax']
            );
            $doiTac=DoiTac::create($data);
        }
    }
}