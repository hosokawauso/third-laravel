<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\MypageController;
use App\Http\Controllers\TodoController;
use App\Http\Controllers\DiaryController;
use App\Http\Controllers\ContactController;

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

Route::get('/login', function () {
    return view('auth.login');
})->middleware('guest')->name('login');

Route::get('/mypage', [MypageController::class, 'index'])
       ->middleware(['auth'])  //ログイン済みのみアクセス可能
       ->name('mypage');



//ログイン操作の定義
//Route::middleware(['auth', 'personal'])->group(function () {
    //Route::get('/',  [TodoController::class, 'index']);
//});




// Todo操作の定義
Route::get('/', [TodoController::class, 'index'])->name('todos.index');
Route::post('/todos', [TodoController::class, 'store'])->name('todos.store');
Route::patch('/todos/update', [TodoController::class, 'update'])->name('todos.update');
Route::delete('/todos/delete', [TodoController::class, 'destroy'])->name('todos.destroy');

//日記操作の定義
Route::get('/diary', [DiaryController::class, 'index'])->name('diary.index');
Route::post('/diary', [DiaryController::class, 'store'])->name('diary.store');

//お問い合わせ操作の定義


    Route::get('/contact', [ContactController::class, 'contact'])->name('contact.contact');
    Route::post('/contact/confirm', [ContactController::class, 'confirm'])->name('contact.confirm');
    Route::post('/contact/thanks', [ContactController::class, 'thanks'])->name('contact.thanks.post');
    Route::get('/contact/thanks', [ContactController::class, 'showThanks'])->name('contact.thanks');
    


