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
/**
 * Маршруты аутентификации и выхода пользователя
 */
Route::post('/', ['uses' => 'Auth\MyAuthController@authUser']);
Route::post('/logout', 'Auth\MyAuthController@logoutUser');
/**
 * маршрут на главную страницу сайта
 */
Route::get('/', ['uses' => 'MyController@show', 'as' => 'index_page']);
/**
 * маршрут для просмотра объявлений
 */
Route::get('/{id}', ['uses' => 'MyController@showArticle', 'as' => 'show_article'])->where('id', '[0-9]+');
/**
 * /edit/{id?} - маршрут для создания/редактирования объявлений
 */
Route::get('/edit/{id?}', ['uses' => 'MyController@createArticle', 'as' => 'create_article'])->where('id', '[0-9]+');
Route::post('/edit/{id?}', ['uses' => 'MyController@saveArticle', 'as' => 'save_article'])->where('id', '[0-9]+');
/**
 * маршрут по удалению объявления
 */
Route::get('/delete/{id}', ['uses' => 'MyController@deleteArticle']);


/**
 * Альтернативный путь логаута POST запросом
 */
//\App\Http\Controllers\Auth\LoginController@logout

