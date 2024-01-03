<?php

use App\Http\Controllers\ProfileController;
use Illuminate\Http\Request as HttpRequest;
//use GuzzleHttp\Psr7\Request;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

use function Laravel\Prompts\alert;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "web" middleware group. Make something great!
|
*/

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


Route::get('/articles/create', function () {
    return view('/articles/create');
});

Route::post('/articles', function (Request $request) {
    //Laravel 유효성검사 제공기능(메뉴얼 참조)
    $request->validate([
        'content'=>[
            'required',
            'string',
            'max:30'
        ]
    ]);

    //유효성검사
    /*
    $data = $_POST['content'];
    if(!$data){
        return redirect()->back();
    }
    if(!is_string($data)){
        return redirect()->back();
    }
    if(!strlen($data) > 255){
        return redirect()->back();
    }
    */

    return "저장되었습니다";
});
