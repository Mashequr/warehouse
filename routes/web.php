<?php

use App\Http\Controllers\Controller;
use App\Http\Controllers\TestController;
use Illuminate\Routing\Route as RoutingRoute;
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



Auth::routes();

Route::get('/', function () {
    return redirect(route('login'));
});

Route::get('/home', 'BasicController@index')->name('admin_dashboard');

Route::get('/category/add','CategoryController@addcategory')->name('admin_addcategory');
Route::post('/category/save','CategoryController@savecategory')->name('admin_savecategory');
Route::post('/category/delete','CategoryController@deletecategory')->name('admin_deletecategory');

Route::get('/clients/add','ClientController@addclient')->name('admin_addclients');
Route::post('/clients/save','ClientController@saveclient')->name('admin_saveclients');
Route::post('/clients/delete','ClientController@deleteclient')->name('admin_deleteclient');

Route::get('/stock/add','StockController@addstock')->name('admin_addstock');
Route::post('/stock/save','StockController@savestock')->name('admin_savestock');
Route::get('/stock/confirm/{sid}','StockController@confirmstock')->name('admin_confirmstock');
Route::post('/stock/confirm/invoice','StockController@confirminvoice')->name('admin_confirminvoice');

Route::get('/stock/viewstocks','StockController@viewstocks')->name('admin_viewstocks');
Route::get('/stock/dischargedstocks','StockController@dischargedstocks')->name('admin_dischargedstocks');
Route::get('/stock/viewinvoice/{stockid}','StockController@viewinvoice')->name('admin_viewinvoice');
Route::post('/stock/deletestocks','StockController@deletestocks')->name('admin_deletestocks');
Route::post('/stock/dischargestocks','StockController@dischargestocks')->name('admin_dischargestocks');
Route::post('/stock/confirmdischarge','StockController@confirmdischarge')->name('admin_confirmdischarge');

Route::get('/stock/profile','ProfileController@viewprofile')->name('admin_profile');
Route::post('/stock/profile/changeavatar','ProfileController@changeavatar')->name('admin_changeavatar');
Route::post('/stock/profile/changepassword','ProfileController@changepassword')->name('admin_changepassword');
