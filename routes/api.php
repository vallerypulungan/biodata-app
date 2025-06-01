<?php
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Api\BiodataController;

Route::apiResource('biodata', BiodataController::class);
Route::post('/biodata', [BiodataController::class, 'store']);