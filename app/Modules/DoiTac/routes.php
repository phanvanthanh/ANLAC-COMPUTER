<?php
$namespace = 'App\Modules\DoiTac\Controllers';

Route::group(
    ['module'=>'DoiTac', 'namespace' => $namespace, 'middleware'=>['web', 'auth','check-role']],
    function() {
        Route::get('doi-tac', [
            'as' => 'doi-tac',
            'uses' => 'DoiTacController@doiTac'
        ]);

        Route::post('danh-sach-doi-tac', [
            'as' => 'danh-sach-doi-tac',
            'uses' => 'DoiTacController@danhSachDoiTac'
        ]);

        Route::post('them-doi-tac', [
            'as' => 'them-doi-tac',
            'uses' => 'DoiTacController@themDoiTac'
        ]);

        Route::post('doi-tac-single', [
            'as' => 'doi-tac-single',
            'uses' => 'DoiTacController@doiTacSingle'
        ]);

        Route::post('cap-nhat-doi-tac', [
            'as' => 'cap-nhat-doi-tac',
            'uses' => 'DoiTacController@capNhatDoiTac'
        ]);


        Route::post('xoa-doi-tac', [
            'as' => 'xoa-doi-tac',
            'uses' => 'DoiTacController@xoaDoiTac'
        ]);

        Route::post('import-doi-tac', [
            'as' => 'import-doi-tac',
            'uses' => 'DoiTacController@importDoiTac'
        ]);
    }
);