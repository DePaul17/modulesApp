<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\ModuleController;
use App\Http\Controllers\DetailController;
use App\Http\Controllers\NotificationController;
use App\Http\Controllers\HistoriqueController;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\ForgotPasswordController;

Route::middleware('guest')->group(function () {
    Route::get('/', function () { 
        return view('auth.ui-login'); 
    })->name('login');

    Route::post('/login', [AuthController::class, 'login'])->name('login.validation');
});

Route::get('forget-password', [ForgotPasswordController::class, 'showForgetPasswordForm'])->name('forget.password.get');
Route::get('reset-password/{token}', [ForgotPasswordController::class, 'showResetPasswordForm'])->name('password.reset');

Route::post('/forget-password', [ForgotPasswordController::class, 'submitForgetPasswordForm'])->name('forget.password.post');
Route::post('/reset-password', [ForgotPasswordController::class, 'submitResetPasswordForm'])->name('password.update');

Route::middleware('auth')->group(function () {

    //************** Routes GET ***************//
    Route::get('/add-module', function () { return view('ui-add'); });
    Route::get('/dashboard', [ModuleController::class, 'all_module']);
    Route::get('/module/{id}/edit', [ModuleController::class, 'edit'])->name('module.edit');
    Route::get('/module/{id}/chart', [DetailController::class, 'afficherGraphique'])->name('module.chart');
    Route::get('/notifications', [NotificationController::class, 'showNotifications']);
    Route::get('/history', [HistoriqueController::class, 'showHistory']);

    //*************** Routes POST ***************//
    Route::post('/dashboard', [AuthController::class, 'logout'])->name('login.session');
    Route::post('/modules', [ModuleController::class, 'add_module'])->name('modules.add');
    Route::delete('/module/{id}', [ModuleController::class, 'destroy'])->name('module.destroy');
    Route::put('/module/{id}', [ModuleController::class, 'update'])->name('module.update');
    Route::post('/start-module/{id}', [ModuleController::class, 'start_module'])->name('module.start');
    Route::post('/stop-module/{id}', [ModuleController::class, 'stop_module'])->name('module.stop');
    Route::post('/update-details', [DetailController::class, 'updateDetails'])->name('update.details');
    Route::post('/module/repair/{id}', [ModuleController::class, 'repairModule'])->name('module.repair');
});