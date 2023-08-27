<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers;

Route::domain(sprintf('clientsettings.%s', config('app.hostname')))->group(function() {
    Route::get('/Setting/QuietGet/{type}', [Controllers\ClientController::class, 'fastflags']);
});

Route::domain(sprintf('clientsettings.api.%s', config('app.hostname')))->group(function() {
    Route::get('/Setting/QuietGet/{type}', [Controllers\ClientController::class, 'fastflags']);
});

Route::domain(sprintf('api.%s', config('app.hostname')))->middleware('roblox.agent')->group(function() {
    Route::get('/Setting/QuietGet/{type}', [Controllers\ClientController::class, 'fastflags']);
    Route::post('/persistence/getV2', [Controllers\DataStoreController::class, 'getAsync']);
    Route::post('/persistence/set', [Controllers\DataStoreController::class, 'setAsync']);
});

Route::domain(sprintf('versioncompatibility.%s', config('app.hostname')))->group(function() {
    Route::get('/GetAllowedMD5Hashes/', [Controllers\ClientController::class, 'md5']);
    Route::get('/GetAllowedSecurityVersions/', [Controllers\ClientController::class, 'security']);
    Route::get('/GetAllowedSecurityKeys/', [Controllers\ClientController::class, 'security2']);
});
