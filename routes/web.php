<?php

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


Route::get('top', 'TopController@top');

//アカウント情報表示
Route::get('account', 'TopController@account')->middleware('auth');

//質問ページ
Route::get('question', 'QuestionController@question');
Route::post('question', 'QuestionController@questionPost');


//質問詳細・回答・コメント
Route::get('q-detail', 'QuestionController@detail');
Route::post('q-detail', 'QuestionController@post');


//Auth認証
Auth::routes();
Route::get('/home', 'HomeController@index')->name('home');
