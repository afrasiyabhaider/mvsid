<?php

use App\Models\Category;
use App\Models\Store;
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
Route::get('/','HomeController@index');

Auth::routes(['register'=>false]);

Route::get('/home', 'HomeController@index')->name('home');

Route::get('/barcodes','BarcodeScannerController@barcodes');
Route::get('/scanned-product/{id}','BarcodeScannerController@scanProduct');
Route::get('/add-product-view' , 'BarcodeScannerController@addProductView');
Route::get('/scan-view' , 'BarcodeScannerController@scanView');
//Zxing scanner routes

Route::get('/scan-barcode' , 'BarcodeScannerController@scanBarcode');
Route::post('/download-barcode-image' , 'BarcodeScannerController@storeBarcodeImage');





Route::get('/scan-file' , 'BarcodeScannerController@scanFile');
Route::get('/scan-and-create-product/{barcode}' , 'ProductController@scanAndCreateProduct');
Route::get('/scan-and-update-product/{barcode}' , 'ProductController@scanAndUpdateProduct');
Route::post('/product-store' , 'ProductController@store');
Route::post('/product-update/{id}' , 'ProductController@update');
Route::get('/product-destroy/{id}' , 'ProductController@destroy');
Route::get('/product-restore/{id}' , 'ProductController@restore');
Route::get('/product-list' , 'ProductController@productList')->name('/product_lists');
Route::post('/view-products' , 'ProductController@productList');
Route::get('/edit-product/{id}' , 'ProductController@edit');
Route::get('/get-sub-categories/{id}','CategoryController@subCategories');
Route::post('/store-image','ProductController@storeImage');
Route::post('/post-barcode','BarcodeScannerController@postBarcode');

/**
 * Import Exort Excel routes
 *
 **/
Route::get('/stesting', function () {
    $menuf= Store::WhereNotNull('deleted_at')->first();
    if(empty($menuf)){
        echo 'jfdkl';
    }else{
        echo '3';
    }
    // return count($menuf);
    // $menuf = Manufacturer::where('manufacturer_name', $row['manufacturer_name'])->first();
});
Route::get('export', 'ImportExportController@export')->name('export');
Route::get('importExportView', 'ImportExportController@importExportView');
Route::post('import/data', 'ImportExportController@import')->name('import');

/* test serach routes */

Route::get('test-search','ProductController@testSearch');
Route::get('get-image/{search}','ProductController@getImage');
Route::get('/download-image','ProductController@downloadImage');
Route::get('optimize-clear', function () {
    \Artisan::call('optimize-clear');
    dd("Optimized Cleared");
});

//  Category Routes
Route::get('view-category','CategoryController@index')->name('category');

Route::get('add-category','CategoryController@create');
Route::post('store-category','CategoryController@store');

Route::get('edit-category/{id}','CategoryController@edit');
Route::post('update-category/{id}','CategoryController@categoryUpdate');
Route::get('delete-category/{id}','CategoryController@destroy');

// store routes

Route::get('/store-index','StoreController@index');
Route::post('/add-store','StoreController@store');
Route::get('/view-stores','StoreController@show')->name('/view-store');
Route::get('/store-edit/{id}','StoreController@edit');
Route::post('/update-store/{id}','StoreController@update');
Route::get('/delete-store/{id}','StoreController@delete');
Route::get('/restore-store/{id}','StoreController@restore');


// Vendors

Route::get('view-vendor','VendorController@index')->name('vendor');

Route::get('add-vendor','VendorController@create');
Route::post('store-vendor','VendorController@store');

Route::get('edit-vendor/{id}','VendorController@edit');
Route::post('update-vendor/{id}','VendorController@update');
Route::get('delete-vendor/{id}','VendorController@destroy');

// Manufacturer

Route::get('view-manufacturer','ManufacturerController@index')->name('manufacturer');

Route::get('add-manufacturer','ManufacturerController@create');
Route::post('store-manufacturer','ManufacturerController@store');
Route::get('edit-manufacturer/{id}','ManufacturerController@edit');
Route::post('update-manufacturer/{id}','ManufacturerController@update');
Route::get('delete-manufacturer/{id}','ManufacturerController@destroy');






// Route::resource('product','ProductController');


