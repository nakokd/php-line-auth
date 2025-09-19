<?php

use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return view('welcome');
});

use App\Http\Controllers\LineLoginController;

Route::get('/auth/line', [LineLoginController::class, 'redirectToProvider'])->name('line.login');
Route::get('/auth/line/callback', [LineLoginController::class, 'handleProviderCallback'])->name('line.callback');
Route::get('/auth/line/result', [LineLoginController::class, 'viewLineUser'])->name('line.line-user');
