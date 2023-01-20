<?php

use App\Http\Controllers\ProfileController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AdminController;
use App\Http\Controllers\VendorController;
use App\Http\Controllers\UserController;
use App\Http\Controllers\Backend\BrandController;
use App\Http\Controllers\Backend\CategoryController;
use App\Http\Controllers\SocialController;
use App\Http\Controllers\Auth\OtpController;
use Illuminate\Support\Facades\Auth;

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
    return view('frontend.index');
});

Route::middleware(['auth', 'verified'])->group(function () {
    Route::get('/dashboard', [UserController::class, 'UserDashboard'])->name('dashboard');

    Route::post('/user/profile/store', [UserController::class, 'UserProfileStore'])->name('user.profile.store');

    Route::get('/user/logout', [UserController::class, 'UserLogout'])->name('user.logout');

    Route::post('/user/update/password', [UserController::class, 'UserUpdatePassword'])->name('user.update.password');
}); // group middleware end



// Route::get('/dashboard', function () {
//     return view('dashboard');
// })->middleware(['auth', 'verified'])->name('dashboard');



// Email Verification Routes
Auth::routes([
    'verify' => true
]);



Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});

require __DIR__ . '/auth.php';


Route::middleware(['auth', 'role:admin'])->group(function () {


    // Admin Dashboard

    Route::middleware(['auth', 'role:admin'])->group(function () {

        Route::get('/admin/dashboard', [AdminController::class, 'AdminDashboard'])->name('admin.dashboard');

        Route::get('/admin/logout', [AdminController::class, 'AdminDestroy'])->name('admin.logout');

        Route::get('/admin/profile', [AdminController::class, 'AdminProfile'])->name('admin.profile');

        Route::post('/admin/profile/store', [AdminController::class, 'AdminProfileStore'])->name('admin.profile.store');

        Route::get('/admin/change/password', [AdminController::class, 'AdminChangePassword'])->name('admin.change.password');

        Route::post('/admin/update/password', [AdminController::class, 'AdminUpdatePassword'])->name('update.password');
    });
});




Route::middleware(['auth', 'role:vendor'])->group(function () {

    // Vendor Dashboard

    Route::middleware(['auth', 'role:vendor'])->group(function () {

        Route::get('/vendor/dashboard', [VendorController::class, 'VendorDashboard'])->name('vendor.dashboard');

        Route::get('/vendor/logout', [VendorController::class, 'VendorDestroy'])->name('vendor.logout');

        Route::get('/vendor/profile', [VendorController::class, 'VendorProfile'])->name('vendor.profile');

        Route::post('/vendor/profile/store', [VendorController::class, 'VendorProfileStore'])->name('vendor.profile.store');

        Route::get('/vendor/change/password', [VendorController::class, 'VendorChangePassword'])->name('vendor.change.password');

        Route::post('/vendor/update/password', [VendorController::class, 'VendorUpdatePassword'])->name('vendor.update.password');
    });
});


Route::get('/admin/login', [AdminController::class, 'AdminLogin']);

Route::get('/vendor/login', [VendorController::class, 'VendorLogin']);


Route::middleware(['auth', 'role:admin'])->group(function () {
    // Brand All Routes
    Route::controller(BrandController::class)->group(function () {



Route::middleware(['auth','role:admin'])->group(function(){
        // Brand All Routes
    Route::controller(BrandController::class)->group(function(){

        Route::get('all/brand', 'AllBrand')->name('all.brand');

        Route::get('add/brand', 'AddBrand')->name('add.brand');

        Route::post('store/brand', 'StoreBrand')->name('store.brand');


        Route::get('edit/brand/{id}', 'EditBrand')->name('edit.brand');

        Route::post('update/brand', 'UpdateBrand')->name('update.brand');

        Route::get('delete/brand/{id}', 'DeleteBrand')->name('delete.brand');


    });

    // Category All Route
    Route::controller(CategoryController::class)->group(function(){
        Route::get('all/category', 'AllCategory')->name('all.category');

        Route::get('add/category', 'AddCategory')->name('add.category');

        Route::post('store/category', 'StoreCategory')->name('store.category');

        Route::get('edit/brand/{id}', 'EditBrand')->name('edit.brand');

        Route::post('update/brand', 'UpdateBrand')->name('update.brand');

        Route::get('delete/brand/{id}', 'DeleteBrand')->name('delete.brand');

    });
}); // end middleware


//Login with Google
Route::get('login/google', [SocialController::class, 'redirectToGoogle'])->name('login.google');

Route::get('login/google/callback', [SocialController::class, 'handleGoogleCallback']);

//Login with facebook
Route::get('login/facebook', [SocialController::class, 'redirectToFacebook'])->name('login.facebook');
Route::get('login/facebook/callback', [SocialController::class, 'handleFacebookCallback']);

Route::middleware(['auth', 'role:user'])->group(function () {
    Route::controller(OtpController::class)->group(function () {
        Route::get('/otp/sendotp', 'sendotp')->name('otp.sendotp');
        Route::post('/otp/generate', 'generate')->name('otp.generate');
        Route::get('/otp/verification/{user_id}', 'verification')->name('otp.verification');
        Route::post('/otp/otpverify', 'otpverify')->name('otp.otpverify');
        Route::post('/otp/resend', 'resendotp')->name('otp.resend');
    });
});
