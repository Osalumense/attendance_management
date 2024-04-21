<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

use App\Http\Controllers\AdminController;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "api" middleware group. Make something great!
|
*/

Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
    return $request->user();
});

// // Admin Group Middleware
// Route::middleware(['auth','roles:admin'])->group(function(){
//     Route::get('/admin/dashboard', [AdminController::class, 'adminDashboard'])->name('admin.dashboard');
//     Route::get('/admin/logout', [AdminController::class, 'adminLogout'])->name('admin.logout');
//     Route::post('/admin/generate', [AdminController::class, 'generateUserQrCode'])->name('admin.generate');
// });
