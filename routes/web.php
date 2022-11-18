<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\front\AdminFrontController;
use App\Http\Controllers\front\RaFrontController;
use App\Http\Controllers\admin\auth\AdminLoginController;
use App\Http\Controllers\admin\auth\AdminLogoutController;
use App\Http\Controllers\admin\AdminRaController;
use App\Http\Controllers\admin\AdminUserController;
use App\Http\Controllers\admin\AdminServiceController;
use App\Http\Controllers\ra\RaUserController;
use App\Http\Controllers\ra\RaServiceController;
use App\Http\Controllers\auth\LoginController;
use App\Http\Controllers\auth\LogoutController;
use App\Http\Controllers\helper\RaPdfController;
use App\Http\Controllers\helper\UserPdfController;
use App\Http\Controllers\helper\AlertController;
use App\Http\Controllers\FrontController;
use App\Http\Controllers\admin\AdminSeenAlertController;
use App\Http\Controllers\ra\RaSeenAlertController;
use App\Http\Controllers\StatusRequestController;
use App\Http\Controllers\UserAlertController;

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
//Index Routes
Route::get('/', [FrontController::class, 'home'])->name('index');
//Admin Routes
Route::post('/admin/login', [AdminLoginController::class, 'index'])->name('admin.log');
Route::get('/admin', [AdminFrontController::class, 'login'])->name('admin.log.front')->middleware('adminAuth');
Route::prefix('/admin')->middleware('adminLogged')->group(function () {
    Route::get('/profile', [AdminFrontController::class, 'admin_profile'])->name('admin.profile');
    Route::post('/profile/update', [AdminFrontController::class, 'admin_profile_update'])->name('admin.profile.update');
    Route::get('/dashboard', [AdminFrontController::class, 'dashboard'])->name('admin.dash');
    Route::get('/ra', [AdminFrontController::class, 'regional_admin'])->name('admin.ra');
    Route::get('/add/ra', [AdminFrontController::class, 'add_regional_admin'])->name('admin.add.ra');
    Route::get('/user', [AdminFrontController::class, 'user_admin'])->name('admin.user');
    Route::get('/ra/profile/{id}', [AdminFrontController::class, 'ra_profile'])->name('admin.ra.profile');
    Route::get('/user/profile/{id}', [AdminFrontController::class, 'user_profile'])->name('admin.user.profile');
    Route::get('/service', [AdminFrontController::class, 'service'])->name('admin.service');
    Route::get('/service/profile/{id}', [AdminFrontController::class, 'admin_service_profile'])->name('admin.service.profile');
    Route::get('/logout', [AdminLogoutController::class, 'index'])->name('admin.logout');
});
//Admin Crud Routes
Route::resource('adminRa', AdminRaController::class)->middleware('adminLogged');
Route::resource('adminUser', AdminUserController::class)->middleware('adminLogged');
Route::resource('adminService', AdminServiceController::class)->middleware('adminLogged');
// Admin Alert routes
Route::get('/admin/toggle/alert', [AdminSeenAlertController::class, 'index'])->name('admin.toggle.alert');
// Regional admin and user login routes
Route::get('/login', [LoginController::class, 'index'])->name('login')->middleware('raAuth');
Route::post('/u/ra/login', [LoginController::class, 'login'])->name('u.ra.login');
//Regional admin routes
Route::prefix('/ra')->middleware('raLogged')->group(function () {
    Route::get('/dash', [RaFrontController::class, 'index'])->name('ra.dash');
    Route::get('/user/profile/{id}', [RaFrontController::class, 'user_profile'])->name('ra.user.profile');
    Route::get('/user', [RaFrontController::class, 'user'])->name('ra.user');
    Route::get('/service', [RaFrontController::class, 'service'])->name('ra.service');
    Route::get('/service/profile/{id}', [RaFrontController::class, 'ra_service_profile'])->name('ra.service.profile');
    Route::get('/profile/{id}', [RaFrontController::class, 'ra_profile'])->name('ra.profile');
    Route::get('/logout', [LogoutController::class, 'ra'])->name('ra.logout');
});
// Ra crud routes
Route::resource('raUser', RaUserController::class)->middleware('raLogged');
Route::resource('raService', RaServiceController::class)->middleware('raLogged');
//User routes
Route::prefix('/user')->group(function () {
    Route::get('/dash', function () {
        return redirect('/');
    });
    Route::get('/logout', function () {
        session()->forget('userlogged');
        return redirect('/');
    })->name('user.logout');
    Route::post('/search', [FrontController::class, 'search'])->name('user.search');
});
// Ra Alert routes
Route::get('/ra/toggle/alert', [RaSeenAlertController::class, 'index'])->name('ra.toggle.alert');
Route::get('/ra/delete/alert', [RaSeenAlertController::class, 'delete'])->name('ra.delete.alert');
// Ra Status Controller
Route::post('/ra/status/request', [StatusRequestController::class, 'ra_status_request'])->name('ra.status.request');
//pdf routes
Route::post('/ra/profile/pdf/helper/{id}', [RaPdfController::class, 'update'])->name('ra.profile.pdf.helper'); //ra update pdf route
Route::get('/ra/profile/pdf/delete/{name}/{id}', [RaPdfController::class, 'delete'])->name('ra.profile.pdf.delete'); // ra delete pdf route
Route::post('/user/profile/pdf/helper/{id}', [UserPdfController::class, 'update'])->name('user.profile.pdf.helper'); //user update pdf route
Route::get('/user/profile/pdf/delete/{name}/{id}', [UserPdfController::class, 'delete'])->name('user.profile.pdf.delete'); //user delete pdf route
// Alert routes
Route::get('/admin/delete/alert', [AlertController::class, 'admin_delete_alert'])->name('admin.delete.alert');
// User Routes
// user alert routes
Route::prefix('/user')->name('user.')->group(function () {
    Route::get('/alert/delete', [UserAlertController::class, 'delete'])->name('delete.alert');
    Route::post('/status/request', [StatusRequestController::class, 'user_status_request'])->name('status.request');
});;