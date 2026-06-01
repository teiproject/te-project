<?php

use App\Http\Controllers\AuthController;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\PageController;
use App\Http\Controllers\PaymentController;
use App\Http\Controllers\ProjectRequestController;
use Illuminate\Support\Facades\Route;

Route::get('/', [PageController::class, 'home'])->name('home');
Route::get('/services', [PageController::class, 'services'])->name('services');
Route::get('/project-builder', [PageController::class, 'builder'])->name('project.builder');
Route::get('/contact', [PageController::class, 'contact'])->name('contact');
Route::post('/project-requests', [ProjectRequestController::class, 'store'])->name('project.requests.store');
Route::get('/project-requests/{projectRequest}', [ProjectRequestController::class, 'show'])->name('project.requests.show');

Route::middleware('guest')->group(function () {
    Route::get('/login', [AuthController::class, 'showLogin'])->name('login');
    Route::post('/login', [AuthController::class, 'login']);
    Route::get('/register', [AuthController::class, 'showRegister'])->name('register');
    Route::post('/register', [AuthController::class, 'register']);
    Route::get('/forgot-password', [AuthController::class, 'showForgotPassword'])->name('password.request');
    Route::post('/forgot-password', [AuthController::class, 'sendResetLink'])->name('password.email');
    Route::get('/reset-password/{token}', [AuthController::class, 'showResetPassword'])->name('password.reset');
    Route::post('/reset-password', [AuthController::class, 'resetPassword'])->name('password.update');
});

Route::middleware('auth')->group(function () {
    Route::post('/logout', [AuthController::class, 'logout'])->name('logout');
    Route::get('/dashboard', [DashboardController::class, 'client'])->name('client.dashboard');
    Route::post('/project-requests/{projectRequest}/approve-demo', [ProjectRequestController::class, 'approveDemo'])->name('project.requests.approve-demo');
    Route::get('/payments/{projectRequest}/checkout', [PaymentController::class, 'checkout'])->name('payments.checkout');
    Route::post('/payments/{projectRequest}/initiate', [PaymentController::class, 'initiate'])->name('payments.initiate');
    Route::post('/payments/{payment}/confirm', [PaymentController::class, 'confirm'])->name('payments.confirm');

    Route::get('/admin', [DashboardController::class, 'admin'])->name('admin.dashboard');
    Route::get('/admin/requests', [ProjectRequestController::class, 'index'])->name('admin.requests.index');
    Route::patch('/admin/requests/{projectRequest}', [ProjectRequestController::class, 'adminUpdate'])->name('admin.requests.update');
});
