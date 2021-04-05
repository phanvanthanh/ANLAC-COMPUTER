<?php
$namespace = 'App\Modules\DmQuanHuyen\Controllers';
Route::group(
    ['module'=>'DmQuanHuyen', 'namespace' => $namespace, 'middleware'=>['web','auth','check-role']],
    function() {
        Route::get('/dm-quan-huyen', [
            'as' => 'dm-quan-huyen',
            'uses' => 'DmQuanHuyenController@dmQuanHuyen'
        ]);
        Route::post('/dm-quan-huyen/import', [
            'as' => 'dm-quan-huyen/import',
            'uses' => 'DmQuanHuyenController@dmQuanHuyenAndImport'
        ]);
    }
);