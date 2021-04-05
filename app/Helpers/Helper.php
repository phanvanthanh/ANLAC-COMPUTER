<?php
namespace App\Helpers;
use App\Payc;
use DB;
use App\CongNo;

class Helper
{
    public static function layThongTinSanPhamTheoIdPhieuNhap($id){
        $data=DB::select("SELECT sp.id, sp.ten_san_pham FROM chi_tiet_phieu_nhap ctpn
            LEFT JOIN san_pham sp ON ctpn.id_san_pham=sp.id
            where ctpn.id_phieu_nhap=".$id);
        $data = collect($data)->map(function($x){ return (array) $x; })->toArray(); 
        return $data;

    }
    public static function layThongTinSanPhamTheoIdPhieuXuat($id){
        $data=DB::select("SELECT sp.id, sp.ten_san_pham FROM chi_tiet_phieu_xuat ctpx
            LEFT JOIN san_pham sp ON ctpx.id_san_pham=sp.id
            where ctpx.id_phieu_xuat=".$id);
        $data = collect($data)->map(function($x){ return (array) $x; })->toArray(); 
        return $data;

    }

    
    
    public static function layMauBackgroundTheoUserId($id){
        $data=DB::select('SELECT * FROM user_background_color WHERE id_user='.$id);
        $data = collect($data)->map(function($x){ return (array) $x; })->toArray(); 
        if(count($data)>0){
            $data=$data[0];
        }
        return $data;
    }
    public static function laySoPhieuNoTheoIdKhachHang($id){
        $data=CongNo::laySoPhieuNoTheoIdKhachHang($id);
        return $data;
    }

    public static function chuyenSoThanhChu($number){
        $hyphen      = ' ';
        $conjunction = ' ';
        $separator   = ' ';
        $negative    = 'âm ';
        $decimal     = ' phẩy ';
        $one         = 'mốt';
        $ten         = 'lẻ';
        $dictionary  = array(
        0                   => 'Không',
        1                   => 'Một',
        2                   => 'Hai',
        3                   => 'Ba',
        4                   => 'Bốn',
        5                   => 'Năm',
        6                   => 'Sáu',
        7                   => 'Bảy',
        8                   => 'Tám',
        9                   => 'Chín',
        10                  => 'Mười',
        11                  => 'Mười một',
        12                  => 'Mười hai',
        13                  => 'Mười ba',
        14                  => 'Mười bốn',
        15                  => 'Mười lăm',
        16                  => 'Mười sáu',
        17                  => 'Mười bảy',
        18                  => 'Mười tám',
        19                  => 'Mười chín',
        20                  => 'Hai mươi',
        30                  => 'Ba mươi',
        40                  => 'Bốn mươi',
        50                  => 'Năm mươi',
        60                  => 'Sáu mươi',
        70                  => 'Bảy mươi',
        80                  => 'Tám mươi',
        90                  => 'Chín mươi',
        100                 => 'trăm',
        1000                => 'ngàn',
        1000000             => 'triệu',
        1000000000          => 'tỷ',
        1000000000000       => 'nghìn tỷ',
        1000000000000000    => 'ngàn triệu triệu',
        1000000000000000000 => 'tỷ tỷ'
        );
         
        if (!is_numeric($number)) {
            return false;
        }
         
        // if (($number >= 0 && (int) $number < 0) || (int) $number < 0 - PHP_INT_MAX) {
        //  // overflow
        //  trigger_error(
        //  'convert_number_to_words only accepts numbers between -' . PHP_INT_MAX . ' and ' . PHP_INT_MAX,
        //  E_USER_WARNING
        //  );
        //  return false;
        // }
         
        if ($number < 0) {
            return $negative . Helper::chuyenSoThanhChu(abs($number));
        }
         
        $string = $fraction = null;
         
        if (strpos($number, '.') !== false) {
            list($number, $fraction) = explode('.', $number);
        }
         
        switch (true) {
            case $number < 21:
                $string = $dictionary[$number];
            break;
            case $number < 100:
                $tens   = ((int) ($number / 10)) * 10;
                $units  = $number % 10;
                $string = $dictionary[$tens];
                if ($units) {
                    $string .= strtolower( $hyphen . ($units==1?$one:$dictionary[$units]) );
                }
            break;
            case $number < 1000:
                $hundreds  = $number / 100;
                $remainder = $number % 100;
                $string = $dictionary[$hundreds] . ' ' . $dictionary[100];
                if ($remainder) {
                    $string .= strtolower( $conjunction . ($remainder<10?$ten.$hyphen:null) . Helper::chuyenSoThanhChu($remainder) );
                }
            break;
            default:
                $baseUnit = pow(1000, floor(log($number, 1000)));
                $numBaseUnits = (int) ($number / $baseUnit);
                $remainder = $number - ($numBaseUnits*$baseUnit);
                $string = Helper::chuyenSoThanhChu($numBaseUnits) . ' ' . $dictionary[$baseUnit];
                if ($remainder) {
                    $string .= strtolower( $remainder < 100 ? $conjunction : $separator );
                    $string .= strtolower( Helper::chuyenSoThanhChu($remainder) );
                }
            break;
        }
         
        if (null !== $fraction && is_numeric($fraction)) {
            $string .= $decimal;
            $words = array();
            foreach (str_split((string) $fraction) as $number) {
                $words[] = $dictionary[$number];
            }
            $string .= implode(' ', $words);
        }
         
        return $string;
    }
    public static function thongKeChungTheoIdSanPham($idSanPham){
        $result=array();
        $chiTietPhieuNhaps=DB::select("SELECT sum(so_luong) as so_luong_nhap, sum(thanh_tien) as thanh_tien_nhap, sum(giam_gia) as giam_gia_nhap FROM chi_tiet_phieu_nhap ctpn
            where ctpn.id_san_pham=".$idSanPham);
        $chiTietPhieuNhaps = collect($chiTietPhieuNhaps)->map(function($x){ return (array) $x; })->toArray(); 
        $result['so_luong_nhap']=0;
        $result['thanh_tien_nhap']=0;
        $result['giam_gia_nhap']=0;
        if($chiTietPhieuNhaps && isset($chiTietPhieuNhaps[0])){
            $result['so_luong_nhap']=$chiTietPhieuNhaps[0]['so_luong_nhap'];
            $result['thanh_tien_nhap']=$chiTietPhieuNhaps[0]['thanh_tien_nhap'];
            $result['giam_gia_nhap']=$chiTietPhieuNhaps[0]['giam_gia_nhap'];
        }



        $chiTietPhieuXuats=DB::select("SELECT sum(so_luong) as so_luong_xuat, sum(giam_gia) as giam_gia_xuat, sum(thanh_tien) as thanh_tien_xuat, sum(gia_von*so_luong) as von_xuat FROM chi_tiet_phieu_xuat ctpx
            where ctpx.id_san_pham=".$idSanPham);
        $chiTietPhieuXuats = collect($chiTietPhieuXuats)->map(function($x){ return (array) $x; })->toArray(); 
        $result['so_luong_xuat']=0;
        $result['giam_gia_xuat']=0;
        $result['thanh_tien_xuat']=0;
        $result['von_xuat']=0;
        if($chiTietPhieuXuats && isset($chiTietPhieuXuats[0])){
            $result['so_luong_xuat']=$chiTietPhieuXuats[0]['so_luong_xuat'];
            $result['giam_gia_xuat']=$chiTietPhieuXuats[0]['giam_gia_xuat'];
            $result['thanh_tien_xuat']=$chiTietPhieuXuats[0]['thanh_tien_xuat'];
            $result['von_xuat']=$chiTietPhieuXuats[0]['von_xuat'];
        }
        $result['so_luong_ton']=$result['so_luong_nhap']-$result['so_luong_xuat'];
        return $result;
    }

	private static $paycHasChildLevel=-1;
    private static $paycHasChildArrItem=array();
    public static function paycTreeResourceHasChild($data, $id){
        foreach ($data as $key => $item) {
            if($item['parent_id']==$id){
                Helper::$paycHasChildLevel++;
                $item['level']=Helper::$paycHasChildLevel;
                if(!isset(Helper::$paycHasChildArrItem[$item['id']])){
                	$item['has_child']=0;
					Helper::$paycHasChildArrItem[$item['id']]=$item;
					if(isset(Helper::$paycHasChildArrItem[$item['parent_id']])){
						Helper::$paycHasChildArrItem[$item['parent_id']]['has_child']=Helper::$paycHasChildArrItem[$item['parent_id']]['has_child']+1; // Nếu có con thì tăng lên một đơn vị
					}
                }                	     
                unset($data[$key]);          
                Helper::paycTreeResourceHasChild($data, $item['id']);
                Helper::$paycHasChildLevel--;
            }           
        }
        return Helper::$paycHasChildArrItem;
    }

    private static $paycLevel=-1;
    private static $paycArrItem=array();
    public static function paycTreeResource($data, $id){
        foreach ($data as $key => $item) {
            if($item['parent_id']==$id){
                Helper::$paycLevel++;
                $item['level']=Helper::$paycLevel;
                if(!isset(Helper::$paycArrItem[$item['id']])){
                    $item['has_child']=0;
					Helper::$paycArrItem[$item['id']]=$item;
                    if(isset(Helper::$paycArrItem[$item['parent_id']])){
                        Helper::$paycArrItem[$item['parent_id']]['has_child']=Helper::$paycArrItem[$item['parent_id']]['has_child']+1; // Nếu có con thì tăng lên một đơn vị
                    }
                }                	     
                unset($data[$key]);          
                Helper::paycTreeResource($data, $item['id']);
                Helper::$paycLevel--;
            }           
        }
        return Helper::$paycArrItem;
    }


    public static function toDatePayc($datetime)
    {
        $result = '';
        try {
            $date = date_create($datetime);
            $result = $date->format('Y-m-d H:i:s');
        } catch (Exception $ex) {
            $result = date('Y-m-d H:i:s');
        }
        return $result;
    }

    private static $pathFile='public/file/payc';

    public static function getAndStoreFile($files){
        $fileNameSave='';
        foreach ($files as $key => $file) {
            $fileName=pathinfo($file->getClientOriginalName(), PATHINFO_FILENAME).'_'.time().$key.'.'.$file->getClientOriginalExtension();
            $fileNameSave.=str_replace(' ','',$fileName.';');
            $fileName=str_replace(' ','',$fileName);
            $path = $file->storeAs(Helper::$pathFile, $fileName);
        }
        return $fileNameSave;

    }

    private static $level_TreeDonViByParentId=0;
    private static $arrItem_TreeDonViByParentId=array();
    public static function treeDonViByParentId($data, $id){
        foreach ($data as $key => $item) {
            if($item['id']==$id){
                $item['level']=Helper::$level_TreeDonViByParentId;
                Helper::$arrItem_TreeDonViByParentId[$item['id']]=$item; 
            }
            if($item['parent_id']==$id && $item['ma_dinh_danh']==null){
                Helper::$level_TreeDonViByParentId++;
                $item['level']=Helper::$level_TreeDonViByParentId;
                if(!isset(Helper::$arrItem_TreeDonViByParentId[$item['id']])){
                    Helper::$arrItem_TreeDonViByParentId[$item['id']]=$item; 
                }                        
                unset($data[$key]);          
                Helper::treeDonViByParentId($data, $item['id']);
                Helper::$level_TreeDonViByParentId--;
            }           
        }
        return Helper::$arrItem_TreeDonViByParentId;
    }


	
}
	
?>