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
 * Static pages
 */
Route::get('/', 'HomeController@index')->name('home');
Route::get('/home', 'HomeController@index');
Route::get('/about', 'HomeController@show')->name('about');
Route::get('/borrow', 'HomeController@borrow');
Route::get('/return', 'HomeController@return');

/*
 * Login and Logout pages
 */
Auth::routes();
//Route::get('/login', 'Auth\LoginController@showLoginForm')->name("login");
//Route::post('/login', 'Auth\LoginController@login');
//Route::post('/logout', 'Auth\LoginController@logout')->name("logout");
//Route::get('/register', 'Auth\RegisterController@showRegisterForm')->name("register");
//Route::post('/register', 'Auth\RegisterController@register');

Route::middleware(['auth', 'decentralize'])->group(function () {
    //Book manager
    Route::resource('book', 'BookController');

    //Book's copy manager
    Route::get('/book/{book_id}/copy/create', ['as' => 'book.copy.create', 'uses' => 'BookCopyController@create']);
    Route::post('/book/{book_id}/copy', ['as' => 'book.copy.store', 'uses' => 'BookCopyController@store']);

    //Borrow book registration
    Route::get('/register-to-borrow-book/create',
        ['as' => 'book.borrow.register.create', 'uses' => 'BookBorrowRegistrationController@create']);
    Route::post('/register-to-borrow-book/store',
        ['as' => 'book.borrow.register.store', 'uses' => 'BookBorrowRegistrationController@store']);

    //Borrow book
    Route::get('/borrow-book/create', 'BorrowBookController@create')->name('borrow-book.create');
    Route::post('/borrow-book/store', 'BorrowBookController@store')->name('borrow-book.store');

    //Return book
    Route::get('/return-book/create', 'ReturnBookController@create')->name('return-book.create');
    Route::post('/return-book/store', 'ReturnBookController@store')->name('return-book.store');
});
