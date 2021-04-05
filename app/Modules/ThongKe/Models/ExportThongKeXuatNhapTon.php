<?php
  
namespace App\Modules\ThongKe\Models;
  
use App\User;
use Maatwebsite\Excel\Concerns\FromCollection;
use App\ThongKe;
  
class ExportThongKeXuatNhapTon implements FromCollection
{
    /**
    * @return \Illuminate\Support\Collection
    */
    public function collection()
    {
        return ThongKe::exportThongKeXuatNhapTon();
    }
}