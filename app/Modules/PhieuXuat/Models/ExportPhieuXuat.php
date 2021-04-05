<?php
  
namespace App\Modules\PhieuXuat\Models;
  
use App\User;
use Maatwebsite\Excel\Concerns\FromCollection;
use App\PhieuXuat;
use Illuminate\Support\Collection;

class ExportPhieuXuat implements FromCollection
{
    /**
    * @return \Illuminate\Support\Collection
    */
    public function collection()
    {
        return PhieuXuat::exportPhieuXuat();;
    }
}