<?php
  
namespace App\Modules\PhieuNhap\Models;
  
use App\User;
use Maatwebsite\Excel\Concerns\FromCollection;
use App\PhieuNhap;
use Illuminate\Support\Collection;

class ExportPhieuNhap implements FromCollection
{
    /**
    * @return \Illuminate\Support\Collection
    */
    public function collection()
    {
        return PhieuNhap::exportPhieuNhap();;
    }
}