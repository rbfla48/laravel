<?php
//Controller
use App\Http\Controllers\admin\MainController;
use App\Http\Controllers\Auth\RegisteredUserController;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\PaymentController;
use App\Http\Controllers\ProductController;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\EmailHistoryController;
//Moddel
use Illuminate\Database\Eloquent\Model;
use App\Models\Banner;
use App\Models\Product;
use App\Models\User;
//Utill
use Illuminate\Support\Facades\DB;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use Illuminate\Foundation\Auth\EmailVerificationRequest;
use Illuminate\Support\Facades\Auth;




Route::get('/', function () {
    //상단배너 슬라이드이미지
    $bannerData = Banner::where('banner_active', 'Y')
    ->orderBy('banner_order','ASC')
    ->get();

    //하단 상품 슬라이드
    $product = Product::select(
                                'product.id as id',
                                'product.name as product_name',
                                'product.normal as normal',
                                'product.price as price',
                                DB::raw('round(((product.normal - product.price)/product.normal)*100) as discount'), // 연산 부분을 DB::raw()로 랩핑
                                'product_content.content as content')
    ->join('product_content','product.id', '=', 'product_content.product_id')
    ->where('product_content.type', '=', 'thumbnail')
    ->get();
    
    return view('home',['banner'=>$bannerData,'product'=>$product]);
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
//Route::get('/home',[HomeController::class,'home'])->name('home');

Route::post('/getUserInfo',[ProfileController::class,'getUserInfo'])->name('getUserInfo');

Route::get('/productDetail/{id}',[ProductController::class,'productDetail'])->name('productDetail');

Route::post('/getOptionPrice',[ProductController::class,'getOptionPrice'])->name('getOptionPrice');

Route::post('/paymentReady',[ProductController::class,'paymentReady'])->name('paymentReady');

Route::post('/paymentCheckout',[ProductController::class,'paymentCheckout'])->name('paymentCheckout');

Route::post('/paymentResult',[PaymentController::class,'paymentResult'])->name('paymentResult');

Route::post('/paymentComplete',[ProductController::class,'paymentComplete'])->name('paymentComplete');

//메일전송
Route::get('/email', function () {
    return view('emailForm');
})->name('emailForm');

Route::post('/emailSend', [EmailHistoryController::class, 'emailSend'])->name('emailSend');