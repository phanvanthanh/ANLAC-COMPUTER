<?php
$namespace = 'App\Modules\ThongKe\Controllers';

Route::group(
    ['module'=>'ThongKe', 'namespace' => $namespace, 'middleware'=>['web', 'auth','check-role']],
    function() {
        Route::get('thong-ke-xuat-nhap-ton', [
            'as' => 'thong-ke-xuat-nhap-ton',
            'uses' => 'ThongKeXuatNhapTonController@thongKeXuatNhapTon'
        ]);

        Route::post('danh-sach-thong-ke-xuat-nhap-ton', [
            'as' => 'danh-sach-thong-ke-xuat-nhap-ton',
            'uses' => 'ThongKeXuatNhapTonController@danhSachThongKeXuatNhapTon'
        ]);

        Route::get('dashboard', [
            'as' => 'dashboard',
            'uses' => 'ThongKeXuatNhapTonController@dashboard'
        ]);

        Route::get('export-thong-ke', [
            'as' => 'export-thong-ke',
            'uses' => 'ThongKeXuatNhapTonController@exportThongKe'
        ]);
    }
);