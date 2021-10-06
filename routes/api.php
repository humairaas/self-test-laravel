<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\SelfTestController;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| is assigned the "api" middleware group. Enjoy building your API!
|
*/

Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
    return $request->user();
});

Route::group(['tag' => 'Demo Api'], function(){
    Route::post('post',[SelfTestController::class, 'postData'])->name('Post Data');
    Route::post('postTest',[SelfTestController::class, 'postTestData'])->name('Post Test Data');

    Route::get('getTestRange',[SelfTestController::class, 'getTestRange'])->name('Get Score Range');
    Route::get('getState',[SelfTestController::class, 'getState'])->name('Get State List');
    Route::get('getCity',[SelfTestController::class, 'getCity'])->name('Get City List');
    Route::get('getPostcode',[SelfTestController::class, 'getPostcode'])->name('Get Postcode List');

    Route::delete('delete',[SelfTestController::class, 'deleteData'])->name('Delete Data');


});
