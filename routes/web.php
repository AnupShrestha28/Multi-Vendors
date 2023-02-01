<?php

use App\Http\Controllers\ProfileController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AdminController;
use App\Http\Controllers\VendorController;
use App\Http\Controllers\UserController;
use App\Http\Controllers\Backend\BrandController;
use App\Http\Controllers\Backend\CategoryController;
use App\Http\Controllers\Backend\SubCategoryController;
use App\Http\Controllers\Backend\ProductController;
use App\Http\Controllers\Backend\VendorProductController;
use App\Http\Controllers\Backend\SliderController;
use App\Http\Controllers\Backend\BannerController;
use App\Http\Controllers\Frontend\IndexController;
use App\Http\Middleware\RedirectIfAuthenticated;
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

         // Vendor add Product All Routes
    Route::controller(VendorProductController::class)->group(function(){

        Route::get('vendor/all/product', 'VendorAllProduct')->name('vendor.all.product');

        Route::get('vendor/add/product', 'VendorAddProduct')->name('vendor.add.product');

        Route::post('vendor/store/product', 'VendorStoreProduct')->name('vendor.store.product');

        Route::get('vendor/edit/product/{id}', 'VendorEditProduct')->name('vendor.edit.product');

        Route::post('vendor/update/product', 'VendorUpdateProduct')->name('vendor.update.product');

        Route::post('vendor/update/product/thambnail', 'VendorUpdateProductThabnail')->name('vendor.update.product.thambnail');

        Route::post('vendor/update/product/multiimage', 'VendorUpdateProductmultiImage')->name('vendor.update.product.multiimage');

        Route::get('vendor/product/multiimg/delete/{id}', 'VendorMultiimgDelete')->name('vendor.product.multiimg.delete');

        Route::get('vendor/product/inactive/{id}', 'vendorProductInactive')->name('vendor.product.inactive');

        Route::get('vendor/product/active/{id}', 'vendorProductActive')->name('vendor.product.active');

        Route::get('vendor/delete/product/{id}', 'vendorProductDelete')->name('vendor.delete.product');

        Route::get('/vendor/subcategory/ajax/{category_id}', 'VendorGetSubCategory');
        });
    }); // end group middleware
});


Route::get('/admin/login', [AdminController::class, 'AdminLogin'])->middleware(RedirectIfAuthenticated::class);

Route::get('/vendor/login', [VendorController::class, 'VendorLogin'])->name('vendor.login')->middleware(RedirectIfAuthenticated::class);

Route::get('/become/vendor', [VendorController::class, 'BecomeVendor'])->name('become.vendor');

Route::post('/vendor/register', [VendorController::class, 'VendorRegister'])->name('vendor.register');


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

        Route::get('edit/category/{id}', 'EditCategory')->name('edit.category');

        Route::post('update/category', 'UpdateCategory')->name('update.category');

        Route::get('delete/category/{id}', 'DeleteCategory')->name('delete.category');

    });

    // SubCategory All Route
    Route::controller(SubCategoryController::class)->group(function(){
        Route::get('all/subcategory', 'AllSubCategory')->name('all.subcategory');

        Route::get('add/subcategory', 'AddSubCategory')->name('add.subcategory');

        Route::post('store/subcategory', 'StoreSubCategory')->name('store.subcategory');

        Route::get('edit/subcategory/{id}', 'EditSubCategory')->name('edit.subcategory');

        Route::post('update/subcategory', 'UpdateSubCategory')->name('update.subcategory');

        Route::get('delete/subcategory/{id}', 'DeleteSubCategory')->name('delete.subcategory');

        Route::get('/subcategory/ajax/{category_id}', 'GetSubCategory');

    });


    // VendorActive and Inactive All Route
    Route::controller(AdminController::class)->group(function(){
        Route::get('inactive/vendor', 'InactiveVendor')->name('inactive.vendor');

        Route::get('active/vendor', 'ActiveVendor')->name('active.vendor');

        Route::get('inactive/vendor/details{id}', 'InactiveVendorDetails')->name('inactive.vendor.details');

        Route::post('active/vendor/approve', 'ActiveVendorApprove')->name('active.vendor.approve');

        Route::get('active/vendor/details{id}', 'ActiveVendorDetails')->name('active.vendor.details');

        Route::post('inactive/vendor/approve', 'InActiveVendorApprove')->name('inactive.vendor.approve');
    });

        // Product All Route
        Route::controller(ProductController::class)->group(function(){
            Route::get('all/product', 'AllProduct')->name('all.product');
    
            Route::get('add/product', 'AddProduct')->name('add.product');

            Route::post('store/product', 'StoreProduct')->name('store.product');

            Route::get('edit/product/{id}', 'EditProduct')->name('edit.product');

            Route::post('update/product', 'UpdateProduct')->name('update.product');

            Route::post('update/product/thambnail', 'UpdateProductThambnail')->name('update.product.thambnail');

            Route::post('update/product/multiimage', 'UpdateProductMultiimage')->name('update.product.multiimage');

            Route::get('product/multiimg/delete/{id}', 'MultiImageDelete')->name('product.multiimg.delete');

            Route::get('product/inactive/{id}', 'ProductInactive')->name('product.inactive');

            Route::get('product/active/{id}', 'ProductActive')->name('product.active');

            Route::get('delete/product/{id}', 'ProductDelete')->name('delete.product');
        });

          // Slider All Route
    Route::controller(SliderController::class)->group(function(){
        Route::get('all/slider', 'AllSlider')->name('all.slider');

        Route::get('add/slider', 'AddSlider')->name('add.slider');

        Route::post('store/slider', 'StoreSlider')->name('store.slider');

        Route::get('edit/slider/{id}', 'EditSlider')->name('edit.slider');

        Route::post('update/slider', 'UpdateSlider')->name('update.slider');

        Route::get('delete/slider/{id}', 'DeleteSlider')->name('delete.slider');

    });


    
          // Banner All Route
          Route::controller(BannerController::class)->group(function(){
            Route::get('all/banner', 'AllBanner')->name('all.banner');
    
            Route::get('add/banner', 'AddBanner')->name('add.banner');
    
            Route::post('store/banner', 'StoreBanner')->name('store.banner');
    
            Route::get('edit/banner/{id}', 'EditBanner')->name('edit.banner');
    
            Route::post('update/banner', 'UpdateBanner')->name('update.banner');
    
            Route::get('delete/banner/{id}', 'DeleteBanner')->name('delete.banner');
    
        });

}); // Admin end middleware

// Frontend Product details all route
Route::get('/product/details/{id}/{slug}', [IndexController::class,'ProductDetails']);



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
