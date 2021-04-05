<?php
$namespace = 'App\Modules\CongNo\Controllers';

Route::group(
    ['module'=>'CongNo', 'namespace' => $namespace, 'middleware'=>['web', 'auth','check-role']],
    function() {
        Route::get('cong-no', [
            'as' => 'cong-no',
            'uses' => 'CongNoController@congNo'
        ]);

        Route::post('danh-sach-cong-no', [
            'as' => 'danh-sach-cong-no',
            'uses' => 'CongNoController@danhSachCongNo'
        ]);

        Route::post('cong-no-single', [
            'as' => 'cong-no-single',
            'uses' => 'CongNoController@congNoSingle'
        ]);

    }
);