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

//Route::get('/', function () {return view('welcome');});


//Topページ
Route::get('/', 'QuestionController@top')->name('top');

//アカウント情報表示
Route::get('account', 'AccountController@account')->name('account');
Route::get('accountForm', 'AccountController@accountForm')->name('accountForm');
Route::post('accountEdit', 'AccountController@accountEdit')->name('accountEdit');

//質問検索
Route::get('questionSearch', 'QuestionController@search');
Route::post('questionSearch', 'QuestionController@result');

//質問ページ表示・作成
Route::get('question', 'QuestionController@question');
Route::post('question', 'QuestionController@questionPost');

//質問編集
Route::get('questionForm', 'QuestionController@questionForm')->name('questionForm');
Route::post('questionForm', 'QuestionController@questionEdit');

//質問詳細・回答・コメント
Route::get('q-detail', 'QuestionController@detail')->name('detail');
Route::post('q-detail', 'QuestionController@post');

//質問削除
Route::get('questionDelete', 'QuestionController@delete');
Route::post('questionDelete', 'QuestionController@remove');

//Auth認証
Auth::routes();
Route::get('/home', 'HomeController@index')->name('home');
