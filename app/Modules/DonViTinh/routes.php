<?php
$namespace = 'App\Modules\DonViTinh\Controllers';

Route::group(
    ['module'=>'DonViTinh', 'namespace' => $namespace, 'middleware'=>['web', 'auth','check-role']],
    function() {
        Route::get('don-vi-tinh', [
            'as' => 'don-vi-tinh',
            'uses' => 'DonViTinhController@donViTinh'
        ]);

        Route::post('danh-sach-don-vi-tinh', [
            'as' => 'danh-sach-don-vi-tinh',
            'uses' => 'DonViTinhController@danhSachDonViTinh'
        ]);

        Route::post('them-don-vi-tinh', [
            'as' => 'them-don-vi-tinh',
            'uses' => 'DonViTinhController@themDonViTinh'
        ]);

        Route::post('don-vi-tinh-single', [
            'as' => 'don-vi-tinh-single',
            'uses' => 'DonViTinhController@donViTinhSingle'
        ]);

        Route::post('cap-nhat-don-vi-tinh', [
            'as' => 'cap-nhat-don-vi-tinh',
            'uses' => 'DonViTinhController@capNhatDonViTinh'
        ]);


        Route::post('xoa-don-vi-tinh', [
            'as' => 'xoa-don-vi-tinh',
            'uses' => 'DonViTinhController@xoaDonViTinh'
        ]);
    }
);