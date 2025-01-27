<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AppointmentController;

Route::prefix('api')->group(function () {
    Route::get('/', function () {
        return response()->json(['status' => 'OK']);
    });
    Route::post('/appointments', [AppointmentController::class, 'book']);
    Route::get('/appointments', [AppointmentController::class, 'show']);
    Route::get('/appointments/{id}', [AppointmentController::class, 'showById']);
});


