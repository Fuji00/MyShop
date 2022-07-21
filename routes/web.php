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
/*
Route::get('/', function () {
    return view('welcome');
});
*/

//ログイン処理
Auth::routes();

//メイン画面
Route::get('/','ItemController@index')->name('home');


//プロフィール編集
Route::resource('profile','ProfileController')->only([
    'edit','update',
]);
//プロフィール画像編集
Route::get('/profile/{profile}/edit_image','ProfileController@edit_image')->name('profile.edit_image');
//プロフィール画像更新
Route::patch('/profile/{profile}/edit_image','ProfileController@update_image')->name('profile.update_image');


//プロフィール詳細
Route::resource('users','UserController')->only([
    'show',
]);
//出品商品一覧
Route::get('/users/{user}/exhibitions','UserController@exhibitions')->name('users.exhibitions');









//新規出品 商品情報編集 商品詳細
Route::resource('items','ItemController')->only([
    'create','edit','show','store','destroy','update','index',
]);
//商品画像変更
Route::get('items/{item}/edit_image','ItemController@edit_image')->name('items.edit_image');
Route::patch('items/{item}/edit_image','ItemController@update_image')->name('items.update_image');

//購入確認
Route::get('items/{item}/confirm','ItemController@confirm')->name('items.confirm');
Route::post('items/{item}/confirm','ItemController@confirm_store')->name('items.confirm_store');

//購入確定
Route::get('items/{item}/finish','ItemController@finish')->name('items.finish');
Route::post('items/{item}/finish','ItemController@finish_store')->name('items.finish_store');





//お気に入り一覧
Route::resource('likes','LikeController')->only([
    'index',
]);
Route::patch('likes/{like}/toggle_like','ItemController@toggleLike')->name('items.toggle_like');

Route::post('/items/{id}','ItemController@likeTest')->name('items.like_test');//ajax用





/*// 投稿一覧
Route::get('/posts', 'PostsController@index');
// 投稿追加フォーム
Route::get('/posts/create', 'PostsController@create');
// 投稿追加
Route::post('/posts', 'PostsController@store');
// 投稿詳細
Route::get('/posts/{id}', 'PostsController@show');
// 投稿更新フォーム
Route::get('/posts/{id}/edit', 'PostsController@edit');
// 投稿更新
Route::patch('/posts/{id}', 'PostsController@update');
// 投稿削除
Route::delete('posts', 'PostsController@destroy');*/


