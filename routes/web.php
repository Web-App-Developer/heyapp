<?php

use Illuminate\Support\Facades\Route;

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
Route::resource('/online-requests', 'OnlineRegistrationController');



//Overwirte All Default Login-Registration Routes
// Route::group(['middleware' => ['web']], function() {

 // Login Routes...
     Route::get('login', ['as' => 'login', 'uses' => 'Auth\LoginController@showLoginForm']);
     Route::post('login', ['as' => 'login', 'uses' => 'Auth\LoginController@login']);
     Route::post('logout', ['as' => 'logout', 'uses' => 'Auth\LoginController@logout']);

// // Registration Routes...
//     Route::get('register', ['as' => 'register', 'uses' => 'Auth\RegisterController@showRegistrationForm']);
//     Route::post('register', ['as' => 'register', 'uses' => 'Auth\RegisterController@register']);

// // Password Reset Routes...
//     Route::get('password/reset', ['as' => 'password.reset', 'uses' => 'Auth\ForgotPasswordController@showLinkRequestForm']);
//     Route::post('password/email', ['as' => 'password.email', 'uses' => 'Auth\ForgotPasswordController@sendResetLinkEmail']);
//     Route::get('password/reset/{token}', ['as' => 'password.reset.token', 'uses' => 'Auth\ResetPasswordController@showResetForm']);
//     Route::post('password/reset', ['as' => 'password.reset.post', 'uses' => 'Auth\ResetPasswordController@reset']);
// });


// //Auth::routes();
Route::get('/home', 'HomeController@index')->name('home');

Route::group(['as'=>'admin.', 'prefix'=>'admin', 'middleware'=>['auth']], function(){
	Route::get('/inbox', 'Admin\AdminController@inbox')->name('newRequests.get');
	Route::get('/in-progress', 'Admin\AdminController@in_progress')->name('inProgressRequests.get');
	Route::get('/solved', 'Admin\AdminController@get_solved')->name('solvedRequests.get');
	Route::get('/trashed', 'Admin\AdminController@get_trash')->name('trashedRequests.get');
	
	//move to
	Route::post('/move/to/{itemID}', 'Admin\AdminController@move__to')->name('moveTo.post');
	Route::get('/view-file/{id}/{fileName}', 'Admin\AdminController@view_file')->name('viewFile.get');
	
	//admin profile
	//profile routes
 	Route::get('/profile', 'Admin\ProfileController@my_profile')->name('myProfile');
 	Route::post('/profile-change-info', 'Admin\ProfileController@change_email')->name('changeInfo');
 	Route::post('/profile-change-pass', 'Admin\ProfileController@change_password')->name('changePassword');
 	
 	//manage admins
 	Route::group(['middleware'=>['SA_MW']], function(){
 		Route::resource('admins', 'Admin\UsersController');
	 	Route::get('delete-admin/{id}', 'Admin\UsersController@delete_admin')->name('deleteAdmin.post');
	 	Route::post('update-pass-admin/{id}', 'Admin\UsersController@update_pass')->name('updateAdminPassword.post');
 	});

 	//reply
 	Route::post('/reply-email', 'Admin\AdminController@reply_email')->name('replyEmail.post');
});


