<?php

use App\Http\Controllers\AuthController;
use Illuminate\Support\Facades\Route;

// Root route to login form
Route::get('/', [AuthController::class, 'loginForm']);
Route::get('/login', [AuthController::class, 'loginForm']);
Route::post('/login', [AuthController::class, 'login']);
Route::get('/register', [AuthController::class, 'registrationForm']);
Route::post('/register', [AuthController::class, 'register']);
Route::get('/logout', [AuthController::class, 'logout']);

Route::get('/home', [AuthController::class, 'index']);
Route::get('/create', [AuthController::class, 'createForm']);
Route::post('/create', [AuthController::class, 'store']);
Route::post('/comment/{post_id}', [AuthController::class, 'storeComment']);
Route::get('/profile', [AuthController::class, 'profile']);
Route::get('/edit/{id}', [AuthController::class, 'editPost']);
Route::post('/update/{id}', [AuthController::class, 'updatePost']);
Route::get('/delete/{id}', [AuthController::class, 'deletePost']);
Route::get('/post/{id}', [AuthController::class, 'show']);
Route::post('/report/post/{id}', [AuthController::class, 'userReportPost'])->name('report.post');
Route::post('/report/comment/{id}', [AuthController::class, 'userReportComment'])->name('report.comment');

//admin
Route::get('/admin/login', [AuthController::class, 'adminLoginForm']);
Route::post('/admin/login', [AuthController::class, 'adminLogin']);
Route::get('/admin/logout', [AuthController::class, 'adminLogout']);
Route::get('/admin', [AuthController::class, 'admin']);
Route::get('/admin/pending-posts', [AuthController::class, 'pendingPosts']);
Route::post('/admin/publish/{id}', [AuthController::class, 'publishPost'])->name('admin.publish');
Route::delete('/admin/delete/{id}', [AuthController::class, 'adminDeletePost'])->name('admin.delete');
Route::get('/admin/users', [AuthController::class, 'users'])->name('admin.users');
Route::post('/admin/users/ban/{id}', [AuthController::class, 'banUser'])->name('admin.ban');
Route::post('/admin/users/unban/{id}', [AuthController::class, 'unbanUser'])->name('admin.unban');
Route::delete('/admin/users/delete/{id}', [AuthController::class, 'deleteUser'])->name('admin.delete-user');
Route::get('/admin/manage-posts', [AuthController::class, 'managePosts']);
Route::post('/admin/report/post/{id}', [AuthController::class, 'reportPost'])->name('admin.report.post');
Route::post('/admin/report/comment/{id}', [AuthController::class, 'reportComment'])->name('admin.report.comment');
Route::get('/admin/reports', [AuthController::class, 'reports'])->name('admin.reports');
Route::delete('/admin/reports/delete/{id}', [AuthController::class, 'deleteReport'])->name('admin.delete-report');