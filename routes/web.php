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

Auth::routes();
Route::group(['prefix' => '/'], function() {
  Route::get('/', function () {
    if (Auth::check()){
      return redirect()->route('home');
    }else{
      return view('auth/login');
    };
  });
  Route::get('slack/login', 'Auth\AuthenticateController@slackAuth');
  Route::get('callback', 'Auth\AuthenticateController@userinfo');
  Route::get('home', 'UserController@index')->name('home');
  Route::resource('report', 'DailyReportController');
  Route::resource('/schedule', 'WorkScheduleController', ['except' => 'show']);
  Route::post('/register', 'Auth\RegisterController@register');
  Route::get('/register/{query}', 'Auth\RegisterController@showRegistrationForm');
  Route::resource('question', 'QuestionController');
  Route::get('question/*/mypage',['as' => 'question.mypage', 'uses' => 'QuestionController@myPage']);
  Route::post('question/confirm',['as' => 'question.confirm', 'uses' => 'QuestionController@confirm']);
  Route::post('question/{id}/confirm',['as' => 'confirm.updata', 'uses' => 'QuestionController@confirm']);
});

Route::group(['prefix' => 'admin', 'as' => 'admin.' ,'namespace' => 'Admin'], function() {
  Route::get('login', ['as' => 'login', 'uses' => 'Auth\LoginController@showLoginForm']);
  Route::post('login', ['as' => 'login', 'uses' => 'Auth\LoginController@login']);
  Route::post('logout', ['as' => 'logout', 'uses' => 'Auth\LoginController@logout']);


  Route::resource('report', DailyReportController::class, ['only' => ['index', 'show']]);
  Route::get('/', ['as' => 'home', 'uses' => 'HomeController@index']);
  Route::resource('store', StoreController::class);

  Route::resource('adminuser', AdminUserController::class);
  Route::get('adminuser/{adminuser}/mailedit', ['as' => 'adminuser.mailedit', 'AdminUserController@mailedit']);
  Route::post('adminuser/sendmail', ['as' => 'adminuser.sendmail', 'uses' => 'AdminUserController@sendmail']);
  Route::resource('user', 'UserController');
  Route::POST('password/email',['as' => 'password.email', 'uses' => 'Auth\ForgotPasswordController@sendResetLinkEmail']);
  Route::GET('password/reset',['as' => 'password.request', 'uses' => 'Auth\ForgotPasswordController@showLinkRequestForm']);
  Route::POST('password/reset', ['as' => 'password.request', 'uses' => 'Auth\ResetPasswordController@reset']);
  Route::GET('password/reset/{token}', ['as' => 'password.reset', 'uses' => 'Auth\ResetPasswordController@showResetForm']);

  Route::post('/register', ['as' => 'register', 'uses' => 'Auth\AdminRegisterController@adminRegister']);
  Route::get('/register/', 'Auth\AdminRegisterController@showAdminRegistrationForm');

  Route::resource('user', UserController::class);
  Route::resource('schedule', WorkScheduleController::class, ['only' => 'index']);

  // access_right
  Route::get('/access_right', ['as' => 'access_right.index', 'uses' => 'AccessRightController@index']);
  Route::post('/access_right/sendMail', ['as' => 'access_right.sendMail', 'uses' => 'AccessRightController@sendMail']);
  Route::get('/access_right/permission', ['as' => 'access_right.permission', 'uses' => 'AccessRightController@permission']);
  Route::post('/access_right/replyMail/{query}', ['as' => 'access_right.replyMail', 'uses' => 'AccessRightController@replyMail']);

  Route::get('rent/confirm', ['as' => 'rent.confirm', 'uses' => 'RentalItemController@confirm']);
  Route::get('rent/update_confirm', ['as' => 'rent.updateConfirm', 'uses' => 'RentalItemController@updateConfirm']);
  Route::put('rent/update_confirm', ['as' => 'rent.updateItems', 'uses' => 'RentalItemController@updateItems']);
  Route::resource('rent', RentalItemController::class);

  Route::get('item_category/confirm', ['as' => 'item_category.confirm', 'uses' => 'ItemCategoryController@confirm']);
  Route::get('item_category/update_confirm', ['as' => 'item_category.updateConfirm', 'uses' => 'ItemCategoryController@updateConfirm']);
  Route::put('item_category/update_confirm', ['as' => 'item_category.updateCategory', 'uses' => 'ItemCategoryController@updateCategory']);
  Route::resource('item_category', ItemCategoryController::class);

  // Route::get('question', ['as' => 'question.index', 'uses' => 'QuestionController@index']);
  // Route::post('question/show', ['as' => 'question.show', 'uses' => 'QuestionController@show']);
  Route::get('question/create', ['as' => 'question.create', 'uses' => 'QuestionController@create']);
  Route::put('question/create', ['as' => 'question.updateAnswer', 'uses' => 'QuestionController@updateAnswer']);
  Route::resource('question', QuestionController::class);


});

