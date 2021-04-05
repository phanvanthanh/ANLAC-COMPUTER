<?php

$namespace = 'App\Modules\TrangChu\Controllers';

Route::group(
    ['module'=>'TrangChu', 'namespace' => $namespace, 'middleware'=>['web','auth']],
    function() {
        Route::get('/', [
            'as' => 'home',
            'uses' => 'TrangChuController@home'
        ]);

    }
);