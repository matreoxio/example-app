<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\UploadCSV;
use App\Http\Controllers\RetrieveData;

Route::post('/upload', [UploadCSV::class, 'upload']);

Route::get('/get', [RetrieveData::class, 'get']);