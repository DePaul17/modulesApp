<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\ModuleController;
use App\Http\Controllers\DetailController;
use App\Http\Controllers\NotificationController;
use App\Http\Controllers\HistoriqueUserController;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\AdminController;

Route::middleware('guest')->group(function () {
    Route::get('/', function () { 
        return view('auth.ui-login'); 
    })->name('login');

    Route::post('/login', [AuthController::class, 'login'])->name('login.validation');
});

Route::middleware('auth')->group(function () {

    //*** USER ***//
    Route::get('/add-module', function () { return view('user.ui-add'); });
    Route::get('/dashboard', function () { return view('user.ui-dashboard'); })->name('dashboard.user');
    Route::get('/modules/liste', [ModuleController::class, 'all_module'])->name('dashboard.user');
    Route::get('/module/{id}/edit', [ModuleController::class, 'edit'])->name('module.edit');
    Route::get('/module/{id}/chart', [DetailController::class, 'afficherGraphique'])->name('module.chart');
    Route::get('/notifications', [NotificationController::class, 'showNotifications']);
    Route::get('/history', [HistoriqueUserController::class, 'showUserHistorical']);
    Route::get('/agro-intelligence', function () { return view('user.ui-add-module-since-pdf-file'); });
    Route::get('/search-module', [ModuleController::class, 'searchModule'])->name('moduleSearch');
    Route::get('/search-historical-users', [HistoriqueUserController::class, 'searchHistoriqueUsers'])->name('searchHistoricalUser');

    //*************** Routes POST ***************//
    Route::post('/logout', [AuthController::class, 'logout'])->name('login.session');
    Route::post('/modules', [ModuleController::class, 'add_module'])->name('modules.add');
    Route::delete('/module/{id}', [ModuleController::class, 'destroy'])->name('module.destroy');
    Route::put('/module/{id}', [ModuleController::class, 'update'])->name('module.update');
    Route::post('/start-module/{id}', [ModuleController::class, 'start_module'])->name('module.start');
    Route::post('/stop-module/{id}', [ModuleController::class, 'stop_module'])->name('module.stop');
    Route::post('/update-details', [DetailController::class, 'updateDetails'])->name('update.details');
    Route::post('/module/repair/{id}', [ModuleController::class, 'repairModule'])->name('module.repair');
    Route::post('/modules/file/upload', [ModuleController::class, 'addModuleSinceFile'])->name('modules.file');

    //*** ADMIN (Accès réservé aux administrateurs) ***//
    Route::middleware('admin')->group(function () {
        Route::get('/dashboard-admin', function () { return view('admin.ui-dashboard'); })->name('dashboard.admin');
        Route::get('/liste-des-utilisateurs', [AdminController::class, 'list_user'])->name('UserList');
        Route::get('/liste-des-modules', [AdminController::class, 'all_module'])->name('ModuleList');
        Route::get('/historiques', function () { return view('admin.ui-history'); });

        Route::get('/search-users', [AdminController::class, 'searchHistoriqueUsers'])->name('searchUser');
    });
});