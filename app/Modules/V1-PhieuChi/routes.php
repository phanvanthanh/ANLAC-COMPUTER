<?php
$namespace = 'App\Modules\PhieuChi\Controllers';

Route::group(
    ['module'=>'PhieuChi', 'namespace' => $namespace, 'middleware'=>['web', 'auth','check-role']],
    function() {
        Route::get('phieu-chi', [
            'as' => 'phieu-chi',
            'uses' => 'PhieuChiController@phieuChi'
        ]);

        Route::post('danh-sach-phieu-chi', [
            'as' => 'danh-sach-phieu-chi',
            'uses' => 'PhieuChiController@danhSachPhieuChi'
        ]);

        Route::post('them-phieu-chi', [
            'as' => 'them-phieu-chi',
            'uses' => 'PhieuChiController@themPhieuChi'
        ]);

        Route::post('phieu-chi-single', [
            'as' => 'phieu-chi-single',
            'uses' => 'PhieuChiController@phieuChiSingle'
        ]);

        Route::post('cap-nhat-phieu-chi', [
            'as' => 'cap-nhat-phieu-chi',
            'uses' => 'PhieuChiController@capNhatPhieuChi'
        ]);


        Route::post('xoa-phieu-chi', [
            'as' => 'xoa-phieu-chi',
            'uses' => 'PhieuChiController@xoaPhieuChi'
        ]);
    }
);