<?php

use Illuminate\Support\Facades\App;
use Illuminate\Support\Facades\Auth;
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

// Route::get('/', function () {
//     return view('welcome');
// });

Auth::routes(['verify' => true]);

//search function
Route::get('/search', 'FrontendController@Search')->name('Search');

//Frontend Controller
Route::get('/', 'FrontendController@front')->name('frontend');
Route::get('/single/{slug}', 'FrontendController@SingleProduct')->name('SingleProduct');
Route::get('/product/get/size/{color}/{product}', 'FrontendController@GetSize')->name('GetSize');

//Home Controller
Route::get('/home', 'HomeController@index')->name('home');
Route::get('/users', 'HomeController@users')->name('users');
Route::get('/user-delete/{id}', 'HomeController@UserDelete')->name('UserDelete');
Route::get('orders', 'HomeController@Orders')->name('Orders');

//Excel Download
Route::get('orders/excel/download', 'HomeController@ExcelDownload')->name('ExcelDownload');
Route::post('orders/excel/import', 'HomeController@import')->name('ExcelImport');
Route::post('orders/excel/selected/date', 'HomeController@SelectedDateExcelDownload')->name('SelectedDateExcelDownload');

// PDF Download
Route::get('orders/pdf/download', 'HomeController@PDFDonwload')->name('PDFDonwload');

//Category Controller
Route::get('/category-list', 'CategoryController@CategoryList')->name('CategoyList');
Route::post('/category-post', 'CategoryController@CategoryPost')->name('CategoyPost');
Route::get('/category-delete/{id}', 'CategoryController@CategoryDelete')->name('CategoryDelete');
Route::post('/select-category-delete', 'CategoryController@SelectCategoryDelete')->name('SelectCategoryDelete');
Route::get('/category-restore/{id}', 'CategoryController@CategoryRestore')->name('CategoryRestore');
Route::get('/category-permanent-delete/{id}', 'CategoryController@CategoryPermanentDelete')->name('CategoryPermanentDelete');
Route::get('/category-edit/{id}', 'CategoryController@CategoryEdit')->name('CategoryEdit');
Route::post('/category-update', 'CategoryController@CategoryUpdate')->name('CategoryUpdate');
Route::get('/category-add', 'CategoryController@CategoryAdd')->name('CategoryAdd');

// Sub Category Controller
Route::get('/subcategory-view', 'SubCategoryController@SubCategoryView')->name('SubCategoryView');
Route::get('/subcategory-add', 'SubCategoryController@SubCategoryAdd')->name('SubCategoryAdd');
Route::post('/subcategory-post', 'SubCategoryController@SubCategoryPost')->name('SubCategoryPost');
Route::get('/subcategory-edit/{scat_id}', 'SubCategoryController@SubCategoryEdit')->name('SubCategoryEdit');
Route::get('subcategory-delete/{scat_id}', 'SubCategoryController@SubCategoryDelete')->name('SubCategoryDelete');
Route::post('/subcategory-update', 'SubCategoryController@SubCategoryUpdate')->name('SubCategoryUpdate');

// Product Controller
Route::get('/products', 'ProductController@products')->name('products');
Route::get('/product-add', 'ProductController@ProductAdd')->name('ProductAdd');
Route::post('/product-store', 'ProductController@ProductStore')->name('ProductStore');
Route::get('/product-edit/{slug}', 'ProductController@ProductEdit')->name('ProductEdit');
Route::get('/product/image/edit/{slug}', 'ProductController@ProductImageEdit')->name('ProductImageEdit');
Route::get('/galley-image-delete/{id}', 'ProductController@GalleryImageDelete')->name('GalleryImageDelete');
Route::post('/product-update', 'ProductController@ProductUpdate')->name('ProductUpdate');
Route::get('/product-delete/{id}', 'ProductController@ProductDelete')->name('ProductDelete');
Route::get('/category/ajax/{id}', 'ProductController@CategoryAjax')->name('CategoryAjax');
Route::post('/multiple/image/update', 'ProductController@MultiImgUpadate')->name('MultiImgUpadate');

// Cart Controller
Route::post('/add-to-cart', 'CartController@AddToCart')->name('AddToCart');
Route::get('cart', 'CartController@Cart')->name('Cart');
Route::post('cart-update', 'CartController@CartUpdate')->name('CartUpdate');
Route::get('/cart-delete/{id}', 'CartController@SingleCartDelete')->name('SingleCartDelete');
// Route::get('cart', 'CartController@Cart')->name('Cart');
Route::get('/cart{code}', 'CartController@Cart')->name('CouponValue');

//CheckOut Controller
Route::get('/checkout', 'CheckoutController@Checkout')->name('Checkout');
Route::get('/api/get-state-list/{id}', 'CheckoutController@GetState')->name('GetState');
Route::get('api/get-city-list/{id}', 'CheckoutController@GetCity')->name('GetCity');

//Payment Controller
Route::post('payment', 'PaymentController@payment')->name('payment');
Route::get('getPaymentStatus', 'PaymentController@getPaymentStatus')->name('getPaymentStatus');
Route::get('order-list', 'PaymentController@OrderList')->name('OrderList');

//Social Login Github
Route::get('login-with-github', 'SocialController@LoginWithGithub')->name('LoginWithGithub');
Route::get('login-call-back', 'SocialController@GithubCallBack')->name('GithubCallBack');

//Social Login Google
Route::get('login-with-google', 'SocialController@LoginWithGoogle')->name('LoginWithGoogle');
Route::get('google-login-call-back', 'SocialController@GoogleCallBack')->name('GoogleCallBack');

Route::middleware(['auth'])->prefix('admin')->group(function () {
    //Blog
    Route::resource('Blog', 'BlogController');
    //Role Management
    Route::get('role-manager', 'RoleController@RoleManager')->name('RoleManager');
    Route::post('role-add-to-permission', 'RoleController@RoleAddToPermission')->name('RoleAddToPermission');
    Route::post('role-add-to-user', 'RoleController@RoleAddToUser')->name('RoleAddToUser');
    Route::get('permission-change/{user_id}', 'RoleController@PermissionChange')->name('PermissionChange');
    Route::post('permission-change-to-user', 'RoleController@PermissionChangeToUser')->name('PermissionChangeToUser');
});
Route::group(['prefix' => 'laravel-filemanager', 'middleware' => ['web', 'auth']], function () {
    \UniSharp\LaravelFilemanager\Lfm::routes();
});
// // Language
// Route::get('/{locale}', function ($locale) {
//     if (! in_array($locale, ['en', 'es'])) {
//         abort(400);
//     }

//     App::setLocale($locale);

//     //
// })->name('lang');

//Blog Part
Route::get('/blogs', 'FrontendController@blogs')->name('blogs');
Route::get('/{slug}', 'FrontendController@SingleBlog')->name('SingleBlog');
Route::post('/comments', 'HomeController@Comments')->name('Comments');

//Product Review
Route::post('/product-reviews', 'HomeController@UserReview')->name('UserReview');



