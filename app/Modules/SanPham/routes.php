<?php
$namespace = 'App\Modules\SanPham\Controllers';

Route::group(
    ['module'=>'SanPham', 'namespace' => $namespace, 'middleware'=>['web', 'auth','check-role']],
    function() {
        Route::get('san-pham', [
            'as' => 'san-pham',
            'uses' => 'SanPhamController@sanPham'
        ]);

        Route::post('danh-sach-san-pham', [
            'as' => 'danh-sach-san-pham',
            'uses' => 'SanPhamController@danhSachSanPham'
        ]);

        Route::post('them-san-pham', [
            'as' => 'them-san-pham',
            'uses' => 'SanPhamController@themSanPham'
        ]);

        Route::post('san-pham-single', [
            'as' => 'san-pham-single',
            'uses' => 'SanPhamController@sanPhamSingle'
        ]);

        Route::post('cap-nhat-san-pham', [
            'as' => 'cap-nhat-san-pham',
            'uses' => 'SanPhamController@capNhatSanPham'
        ]);


        Route::post('xoa-san-pham', [
            'as' => 'xoa-san-pham',
            'uses' => 'SanPhamController@xoaSanPham'
        ]);

        Route::post('import-san-pham', [
            'as' => 'import-san-pham',
            'uses' => 'SanPhamController@importSanPham'
        ]);
    }
);