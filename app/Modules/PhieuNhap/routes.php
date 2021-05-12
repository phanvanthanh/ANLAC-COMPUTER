<?php
$namespace = 'App\Modules\PhieuNhap\Controllers';

Route::group(
    ['module'=>'PhieuNhap', 'namespace' => $namespace, 'middleware'=>['web', 'auth','check-role']],
    function() {
        Route::get('phieu-nhap', [
            'as' => 'phieu-nhap',
            'uses' => 'PhieuNhapController@phieuNhap'
        ]);

        Route::get('export-phieu-nhap', [
            'as' => 'export-phieu-nhap',
            'uses' => 'PhieuNhapController@exportPhieuNhap'
        ]);

        Route::post('danh-sach-phieu-nhap', [
            'as' => 'danh-sach-phieu-nhap',
            'uses' => 'PhieuNhapController@danhSachPhieuNhap'
        ]);

        Route::post('them-phieu-nhap', [
            'as' => 'them-phieu-nhap',
            'uses' => 'PhieuNhapController@themPhieuNhap'
        ]);

        Route::post('phieu-nhap-single', [
            'as' => 'phieu-nhap-single',
            'uses' => 'PhieuNhapController@phieuNhapSingle'
        ]);


        Route::post('xoa-phieu-nhap', [
            'as' => 'xoa-phieu-nhap',
            'uses' => 'PhieuNhapController@xoaPhieuNhap'
        ]);

        Route::post('cap-nhat-phieu-nhap', [
            'as' => 'cap-nhat-phieu-nhap',
            'uses' => 'PhieuNhapController@capNhatPhieuNhap'
        ]);

        Route::post('lay-thong-tin-doi-tac-theo-ten-va-ma', [
            'as' => 'lay-thong-tin-doi-tac-theo-ten-va-ma',
            'uses' => 'PhieuNhapController@layThongTinDoiTacTheoTenVaMa'
        ]);


        Route::post('them-chi-tiet-phieu-nhap', [
            'as' => 'them-chi-tiet-phieu-nhap',
            'uses' => 'PhieuNhapController@themChiTietPhieuNhap'
        ]);

        Route::post('load-chi-tiet-phieu-nhap', [
            'as' => 'load-chi-tiet-phieu-nhap',
            'uses' => 'PhieuNhapController@loadChiTietPhieuNhap'
        ]);

        Route::post('xoa-chi-tiet-phieu-nhap', [
            'as' => 'xoa-chi-tiet-phieu-nhap',
            'uses' => 'PhieuNhapController@xoaChiTietPhieuNhap'
        ]);

        Route::post('import-phieu-nhap', [
            'as' => 'import-phieu-nhap',
            'uses' => 'PhieuNhapController@importPhieuNhap'
        ]);

        Route::post('xem-phieu-nhap', [
            'as' => 'xem-phieu-nhap',
            'uses' => 'PhieuNhapController@xemPhieuNhap'
        ]);
    }
);