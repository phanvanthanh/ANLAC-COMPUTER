<?php
$namespace = 'App\Modules\PhieuXuat\Controllers';
use App\Modules\PhieuXuat\Controller\PhieuXuatController;

Route::group(
    ['module'=>'PhieuXuat', 'namespace' => $namespace, 'middleware'=>['web', 'auth','check-role']],
    function() {
        Route::get('phieu-xuat', [
            'as' => 'phieu-xuat',
            'uses' => 'PhieuXuatController@phieuXuat'
        ]);

        Route::get('export-phieu-xuat', [
            'as' => 'export-phieu-xuat',
            'uses' => 'PhieuXuatController@exportPhieuXuat'
        ]);

        Route::post('danh-sach-phieu-xuat', [
            'as' => 'danh-sach-phieu-xuat',
            'uses' => 'PhieuXuatController@danhSachPhieuXuat'
        ]);

        Route::post('phieu-xuat-single', [
            'as' => 'phieu-xuat-single',
            'uses' => 'PhieuXuatController@phieuXuatSingle'
        ]);

        Route::post('them-phieu-xuat', [
            'as' => 'them-phieu-xuat',
            'uses' => 'PhieuXuatController@themPhieuXuat'
        ]);

        


        Route::post('xoa-phieu-xuat', [
            'as' => 'xoa-phieu-xuat',
            'uses' => 'PhieuXuatController@xoaPhieuXuat'
        ]);

        Route::post('cap-nhat-phieu-xuat', [
            'as' => 'cap-nhat-phieu-xuat',
            'uses' => 'PhieuXuatController@capNhatPhieuXuat'
        ]);

        Route::post('lay-thong-tin-khach-hang-theo-ten-va-ma', [
            'as' => 'lay-thong-tin-khach-hang-theo-ten-va-ma',
            'uses' => 'PhieuXuatController@layThongTinKhachHangTheoTenVaMa'
        ]);
        Route::post('lay-thong-tin-san-pham-theo-ten-va-ma', [
            'as' => 'lay-thong-tin-san-pham-theo-ten-va-ma',
            'uses' => 'PhieuXuatController@layThongTinSanPhamTheoTenVaMa'
        ]);
        


        Route::post('them-chi-tiet-phieu-xuat', [
            'as' => 'them-chi-tiet-phieu-xuat',
            'uses' => 'PhieuXuatController@themChiTietPhieuXuat'
        ]);

        Route::post('load-chi-tiet-phieu-xuat', [
            'as' => 'load-chi-tiet-phieu-xuat',
            'uses' => 'PhieuXuatController@loadChiTietPhieuXuat'
        ]);

        Route::post('xoa-chi-tiet-phieu-xuat', [
            'as' => 'xoa-chi-tiet-phieu-xuat',
            'uses' => 'PhieuXuatController@xoaChiTietPhieuXuat'
        ]);

        Route::post('import-phieu-xuat', [
            'as' => 'import-phieu-xuat',
            'uses' => 'PhieuXuatController@importPhieuXuat'
        ]);

        /*Route::get('in-phieu-xuat', function ($id) {
            return view('PhieuXuat::in-phieu-xuat', compact('id'));
        },['uses' => 'PhieuXuatController@inPhieuXuat']);

        Route::get('in-phieu-giao-hang/{id}', function ($id) {
            return view('PhieuXuat::in-phieu-giao-hang', compact('id'));
        },['uses' => 'PhieuXuatController@inPhieuGiaoHang']);*/
        
        Route::get('in-phieu-xuat', [
            'as' => 'in-phieu-xuat',
            'uses' => 'PhieuXuatController@inPhieuXuat'
        ]);
        Route::get('in-phieu-giao-hang', [
            'as' => 'in-phieu-giao-hang',
            'uses' => 'PhieuXuatController@inPhieuGiaoHang'
        ]);
    }
);

