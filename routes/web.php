<?php

use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\Auth;


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

Route::get('/', function () {
    return view('welcome');
});
Auth::routes();

// ログイン画面
Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');
// 検索画面表示
Route::get('/index', [App\Http\Controllers\ArticleController::class, 'index'])->name('article.index');
// 検索機能
Route::get('/get', [App\Http\Controllers\ArticleController::class, 'get'])->name('article.search');
// 削除処理
Route::delete('/delete/{id}', [App\Http\Controllers\ArticleController::class, 'destroy'])->name('article.destroy');
// 商品登録画面表示
Route::get('/create', [App\Http\Controllers\ArticleController::class, 'showRegistForm'])->name('article.create');
// 登録処理
Route::post('/create', [App\Http\Controllers\ArticleController::class, 'registArticle'])->name('regist.article');
// 詳細画面
Route::get('/article/{id}', [App\Http\Controllers\ArticleController::class, 'showArticleDetail'])->name('article.detail');
// 編集画面
Route::get('/edit/{id}', [App\Http\Controllers\ArticleController::class, 'edit'])->name('article.edit');
// 更新処理
Route::put('/edit/{id}', [App\Http\Controllers\ArticleController::class, 'update'])->name('article.update');

