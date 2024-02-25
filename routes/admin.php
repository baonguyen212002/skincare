<?php

use App\Http\Controllers\Admin\LoginController;
use Illuminate\Support\Facades\Route;

Route::get('/login', [LoginController::class, 'index'])->name('admin.login');

