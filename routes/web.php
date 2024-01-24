<?php

use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\SignController;
use App\Http\Controllers\UploadController;
use App\Http\Controllers\RequestSignController;


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

Route::middleware(['auth'])->group(function () {
    Route::get('/pengaturan', [App\Http\Controllers\UserController::class, 'create'])->name('pengaturan');
    Route::post('PIN/{id}', [App\Http\Controllers\UserController::class, 'pinUser'])->name('PIN.pinUser'); 
    Route::post('PINReq/{id}', [App\Http\Controllers\UserController::class, 'pinReq'])->name('PIN.pinReq');
    // Route::post('PINReDec/{id}', [App\Http\Controllers\UserController::class, 'pinReqDecline'])->name('PIN.pinReqDecline');
    Route::post('/edit/name', [App\Http\Controllers\UserController::class, 'name'])->name('edit.name');
    Route::post('/edit/password', [App\Http\Controllers\UserController::class, 'password'])->name('edit.password');
    Route::post('/add/pin', [App\Http\Controllers\UserController::class, 'pin'])->name('add.pin');
    Route::resource('/upload', App\Http\Controllers\UploadController::class);
    // Route::delete('myproductsDeleteAll', 'UploadController@deleteAll');
    Route::delete('DeleteAll', [UploadController::class, 'deleteAll']);
    Route::delete('DeleteAllReq', [RequestSignController::class, 'deleteAll']);
    // Route::resource('/signed', App\Http\Controllers\SignedController::class);
    // Route::resource('/request', App\Http\Controllers\RequestController::class);
    Route::resource('/permintaan', App\Http\Controllers\RequestSignController::class);
    Route::get('contactus', function () {
        return view('/server/user/contactus');
    });
    Route::get('/requestsign/{id}', [RequestSignController::class, 'index']);
    Route::get('/pilihTipe/{id}', [SignController::class, 'index']);
    Route::get('/certout/{id}', [SignController::class, 'show'])->name('certout');
    Route::get('/certoutReq/{id}', [SignController::class, 'certoutRequestSignature']);
    Route::post('/requestsign/{id}', [RequestSignController::class, 'store']);

    // Route::get('/uploaded', [UploadController::class, 'show']);
    Route::get('/permintaan', [RequestSignController::class, 'show']);
    Route::get('/meminta', [UploadController::class, 'showSignatureRequest']);
    Route::get('/signedFile', [UploadController::class, 'showSignFile']);
    Route::delete('/signedFile/{id}', [UploadController::class, 'destroySigned'])->name('delete');
    Route::get('/signedFile/{file_signed}', [UploadController::class, 'DownloadBarcode']);
    Route::get('/checkFile/{id}', [UploadController::class, 'checkFile']);
    Route::get('/checkFileTtd/{id}', [UploadController::class, 'checkFileTtd']);
    Route::get('/signed', [SignController::class, 'show']);
    Route::get('/appOrdecSign/{id}', [RequestSignController::class, 'req']);
    Route::get('/statusApproved/{id}', [RequestSignController::class, 'statusApproved'])->name('statusApproved');
    Route::get('/statusDecline/{id}', [RequestSignController::class, 'statusDecline'])->name('statusDecline');
    Route::get('guide', function () {
        return view("/client/guide");
    });

    
    Route::post('Feedback/{id}', [App\Http\Controllers\RequestSignController::class, 'feedback'])->name('Feed.Feedback');

        //=========Role Admin ============
        Route::middleware(['admin'])->group(function () {
            Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');
            Route::resource('/user', App\Http\Controllers\UserController::class);
        });
  
        //=========Role Users ============
        Route::middleware(['users'])->group(function () {
            Route::resource('/', App\Http\Controllers\ClientController::class);
            Route::get('/homeUser', [App\Http\Controllers\ClientController::class, 'index'])->name('homeUser');
        });

        // Route::get('home', function () {
        //     return view('/client/homeUser');
        // });

});
