<?php
$namespace = 'App\Modules\KhachHang\Controllers';

Route::group(
    ['module'=>'KhachHang', 'namespace' => $namespace, 'middleware'=>['web', 'auth','check-role']],
    function() {
        Route::get('khach-hang', [
            'as' => 'khach-hang',
            'uses' => 'KhachHangController@KhachHang'
        ]);

        Route::post('danh-sach-khach-hang', [
            'as' => 'danh-sach-khach-hang',
            'uses' => 'KhachHangController@danhSachKhachHang'
        ]);

        Route::post('them-khach-hang', [
            'as' => 'them-khach-hang',
            'uses' => 'KhachHangController@themKhachHang'
        ]);

        Route::post('khach-hang-single', [
            'as' => 'khach-hang-single',
            'uses' => 'KhachHangController@khachHangSingle'
        ]);

        Route::post('cap-nhat-khach-hang', [
            'as' => 'cap-nhat-khach-hang',
            'uses' => 'KhachHangController@capNhatKhachHang'
        ]);


        Route::post('xoa-khach-hang', [
            'as' => 'xoa-khach-hang',
            'uses' => 'KhachHangController@xoaKhachHang'
        ]);

        Route::post('import-khach-hang', [
            'as' => 'import-khach-hang',
            'uses' => 'KhachHangController@importKhachHang'
        ]);
    }
);