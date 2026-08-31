<?php
use App\Http\Controllers\AdminController;
use App\Http\Controllers\LandingController;
use App\Http\Controllers\PublicController;
use Illuminate\Support\Facades\Route;

Route::get('/', [LandingController::class, 'index'])->name('landing');
Route::post('/messages', [PublicController::class, 'storeMessage'])->middleware('throttle:20,1');
Route::post('/appointments', [PublicController::class, 'storeAppointment'])->middleware('throttle:20,1');

Route::get('/admin', [AdminController::class, 'index'])->name('admin');
Route::post('/admin/login', [AdminController::class, 'login'])->middleware('throttle:6,1');
Route::post('/admin/logout', [AdminController::class, 'logout']);

Route::middleware('admin.session')->prefix('admin')->group(function () {
    Route::get('/data', [AdminController::class, 'data']);
    Route::post('/portfolios', [AdminController::class, 'storePortfolio']);
    Route::put('/portfolios/{portfolio}', [AdminController::class, 'updatePortfolio']);
    Route::delete('/portfolios/{portfolio}', [AdminController::class, 'destroyPortfolio']);
    Route::patch('/appointments/{appointment}/status', [AdminController::class, 'updateAppointmentStatus']);
    Route::patch('/messages/{message}/read', [AdminController::class, 'markMessageRead']);
    Route::put('/settings', [AdminController::class, 'updateSettings']);
});
