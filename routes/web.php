<?php

use Illuminate\Support\Facades\Route;

Route::get('/{any}', function () {
    return view('welcome'); // app.blade.php akan memuat Vue
})->where('any', '.*');

