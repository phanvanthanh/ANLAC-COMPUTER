<?php

$namespace = 'App\Modules\Email\Controllers';

Route::group(
    ['module'=>'Email', 'namespace' => $namespace, 'middleware'=>['web','auth']],
    function() {
        Route::get('/email', [
            'as' => 'email',
            'uses' => 'EmailController@email'
        ]);

        Route::post('/gui-email', [
            'as' => 'gui-email',
            'uses' => 'EmailController@guiEmail'
        ]);

    }
);