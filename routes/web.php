<?php

use App\Http\Controllers\AuditController;
use App\Http\Controllers\PermissionController;
use App\Http\Controllers\RoleController;
use App\Http\Controllers\CaptchaServiceController;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\UploadController;
use App\Http\Controllers\UserController;
// URL_CRUD_GENERATOR
use App\Http\Controllers\SettingController;

use App\Http\Controllers\OrderPaymentController;
use App\Http\Controllers\OrderDetailController;
use App\Http\Controllers\OrderController;
use App\Http\Controllers\CrudController;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

Route::get('/', function () {
    return redirect(route('dashboard'));
});
Route::get('/reload-captcha', [CaptchaServiceController::class, 'reloadCaptcha']);
Route::post('upload/store', [UploadController::class, 'store'])->name('upload.store');
Route::delete('revert/image', [UploadController::class, 'revert'])->name('upload.revert');
Route::get('order/cek/{order}', [OrderController::class, 'cekOrder'])->name('order.cekOrder');
Route::group(['prefix' => 'admin', 'middleware' => ['auth']], function () {
    Route::get('/', [DashboardController::class, 'dashboard'])->name('dashboard');
    Route::get('/order/pdf/{order}', [OrderController::class, 'generatePdf'])->name('order.generatePdf');
    Route::resource('permission', PermissionController::class);
    Route::resource('role', RoleController::class);
    Route::resource('user', UserController::class);
    Route::resource('audit', AuditController::class);
    // CRUD_GENERATOR
    Route::resource('setting', SettingController::class);

    Route::resource('order_payment', OrderPaymentController::class);
    Route::resource('order_detail', OrderDetailController::class);
    Route::resource('order', OrderController::class);
    Route::resource('crud', CrudController::class);
    Route::get('user/resetPassword/{user}', [UserController::class, 'reset_password'])->name('user.resetPassword');
});
require __DIR__ . '/auth.php';
