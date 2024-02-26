<?php

use App\Http\Controllers\ArticleController;
use App\Http\Controllers\ProfileController;
use App\Models\Article;
//use DragonCode\Contracts\Cashier\Auth\Auth;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Carbon;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Http\Request as HttpRequest;
//use GuzzleHttp\Psr7\Request;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
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

Route::controller(ArticleController::class)->group(function(){
    //글쓰기
    Route::get('/articles/create', 'create')->name('article.create');
    //글저장
    Route::post('/articles', 'save')->name('article.save');
    //글목록
    Route::get('articles', 'index')->name('article.index');
    //글 조회
    Route::get('articles/{id}', 'show')->name('article.show');
    //글 수정화면
    Route::get('articles/{id}/edit', 'edit')->name('article.edit');
    //글 수정
    Route::patch('articles/{id}', 'update')->name('article.update');
    //글 삭제
    Route::delete('articles/{id}', 'delete')->name('article.delete');
});


