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


Route::get('/', ['uses' => 'HomeController@index'])->name('home');

Route::get('export/{ids}/{ext}', ['uses' => 'ExportController@export'])->name('export');

Route::group(['prefix' => 'import'], function () {
    Route::get('/', ['uses' => 'ImportController@index'])->name('import');
    Route::post('/', ['uses' => 'ImportController@import'])->name('import.post');
});

Route::group(['prefix' => 'search'], function () {
    Route::get('/', ['uses' => 'SearchController@index'])->name('search');
    Route::post('/', ['uses' => 'SearchController@search'])->name('search.post');
});

Route::group(['prefix' => 'company'], function () {
    Route::get('{id}', ['uses' => 'CompanyController@show'])->name('company');
});

/* =================================================
 *  INICIO CONTROLE DE USUÁRIOS
 * =================================================
 */

Route::get('login', function () {
    return redirect()->to(route('auth.login'));
})->name('login');

Route::group(['prefix' => 'auth', 'as' => 'auth.'], function (){
    $loginController = 'Auth\LoginController';
    //$registerController = 'Auth\RegisterController';

    // Login Routes
    Route::get('login', $loginController . '@showLoginForm')->name('login.form');
    Route::post('login', $loginController . '@login')->name('login');
    Route::get('logout', $loginController . '@logout')->name('logout');
    // Registration Routes
    //Route::get('register', $registerController . '@showRegistrationForm')->name('register.form');
    //Route::post('register', $registerController . '@register')->name('register');
});

/*Route::group(['prefix' => 'password', 'as' => 'password.'], function (){
    $forgotPassword = 'Auth\ForgotPasswordController';

    // Password Reset Routes...
    Route::get('reset', $forgotPassword . '@showLinkRequestForm');
    Route::post('email', $forgotPassword . '@sendResetLinkEmail');
    Route::group(['prefix' => 'reset', 'as' => 'reset.'], function () {
        $resetPassword = 'Auth\ResetPasswordController';

        Route::post('/', $resetPassword .'@reset');
        Route::get('reset/{token}', $resetPassword . '@showResetForm');
    });
});*/

/* =================================================
 *  FIM CONTROLE DE USUÁRIOS
 * =================================================
 */