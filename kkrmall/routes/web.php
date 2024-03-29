<?php
//Controller
use App\Http\Controllers\admin\MainController;
use App\Http\Controllers\Auth\RegisteredUserController;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\PaymentController;
use App\Http\Controllers\ProductController;
use App\Http\Controllers\ProfileController;
//Moddel
use Illuminate\Database\Eloquent\Model;
use App\Models\Banner;
//Utill
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;


Route::get('/', function () {
    return view('welcome');
});

Route::get('/dashboard', function () {
    return view('dashboard');
})->middleware(['auth', 'verified'])->name('dashboard');

Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});

require __DIR__.'/auth.php';

//관리자페이지
Route::get('/admin',[MainController::class,'home'])->name('admin');

Route::get('/admin/orderList',[MainController::class,'orderList'])->name('admin.orderList');

Route::get('/admin/orderInfo/{id}',[MainController::class,'orderInfo'])->name('admin.orderInfo');

Route::get('/admin/productList',[MainController::class,'productList'])->name('admin.productList');

Route::get('/admin/productManage/{id}',[MainController::class,'productManage'])->name('admin.productManage');

Route::get('/admin/productRegist',[MainController::class,'productRegist'])->name('admin.productRegist');

Route::post('/admin/productStore',[MainController::class,'productStore'])->name('admin.productStore');

Route::post('/admin/productUpdate',[MainController::class,'productUpdate'])->name('admin.productUpdate');

//홈화면
Route::get('/home',[HomeController::class,'home'])->name('home');


Route::get('/productDetail/{id}',[ProductController::class,'productDetail'])->name('productDetail');

Route::post('/getOptionPrice',[ProductController::class,'getOptionPrice'])->name('getOptionPrice');

Route::post('/paymentReady',[ProductController::class,'paymentReady'])->name('paymentReady');

Route::post('/paymentCheckout',[ProductController::class,'paymentCheckout'])->name('paymentCheckout');

Route::post('/paymentResult',[PaymentController::class,'paymentResult'])->name('paymentResult');

Route::post('/paymentComplete',[ProductController::class,'paymentComplete'])->name('paymentComplete');
