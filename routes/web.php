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

/*********************General Function for Both (Front-end & Back-end) ***********************/
/* Route::post('/get_states', 'HomeController@getStates');
Route::post('/get_product_views', 'HomeController@getProductViews');
Route::post('/get_product_other_info', 'HomeController@getProductOtherInformation');
Route::post('/delete_action', 'HomeController@deleteAction')->middleware('auth');
 */
Route::get('/clear-cache', function() {

    //$exitCode = Artisan::call('cache:clear');
   
    // return what you want
});
 
/*********************Exception Handling ***********************/
Route::get('/exception', 'ExceptionController@index')->name('exception');
Route::post('/exception', 'ExceptionController@index')->name('exception');

//Login and Logout 
Route::get('/', 'Auth\AdminLoginController@showLoginForm')->name('login');
Route::get('/login', 'Auth\AdminLoginController@showLoginForm')->name('admin.login');
Route::post('/login', 'Auth\AdminLoginController@login')->name('admin.login');
Route::post('/logout', 'Auth\AdminLoginController@logout')->name('admin.logout');

//General  
Route::get('/dashboard', 'Admin\AdminController@dashboard')->name('admin.dashboard');
Route::get('/get_customer_detail', 'Admin\AdminController@CustomerDetail')->name('admin.get_customer_detail');
Route::get('/my_profile', 'Admin\AdminController@myProfile')->name('admin.my_profile');
Route::post('/my_profile', 'Admin\AdminController@myProfile')->name('admin.my_profile');
Route::get('/change_password', 'Admin\AdminController@change_password')->name('admin.change_password');
Route::post('/change_password', 'Admin\AdminController@change_password')->name('admin.change_password');
 
Route::post('/delete_action', 'Admin\AdminController@deleteAction'); 

Route::get('/website_setting', 'Admin\AdminController@websiteSetting')->name('admin.website_setting');
Route::get('/search', 'Admin\AdminController@getrestaurant')->name('admin.search');
Route::get('/getlearning', 'Admin\AdminController@getlearning')->name('admin.getlearning');
Route::post('/update_question_table', 'Admin\AdminController@update_question_table')->name('admin.update_question_table');
Route::post('/website_setting', 'Admin\AdminController@websiteSetting')->name('admin.website_setting');
Route::post('/get_states', 'Admin\AdminController@getStates');
Route::get('/settings/taxes/returnsetting', 'Admin\AdminController@returnsetting')->name('admin.returnsetting');
Route::get('/settings/taxes/taxrates', 'Admin\AdminController@taxrates')->name('admin.taxrates');

Route::get('/users', 'Admin\UserController@index')->name('admin.users.index');
Route::get('/users/create', 'Admin\UserController@create')->name('admin.users.create'); 
Route::post('/users/store', 'Admin\UserController@store')->name('admin.users.store');
Route::get('/users/edit/{id}', 'Admin\UserController@edit')->name('admin.users.edit');
Route::post('/users/edit', 'Admin\UserController@edit')->name('admin.users.edit');

Route::get('/usertype', 'Admin\UsertypeController@index')->name('admin.usertype.index');
Route::get('/usertype/create', 'Admin\UsertypeController@create')->name('admin.usertype.create');  		
Route::post('/usertype/store', 'Admin\UsertypeController@store')->name('admin.usertype.store');
Route::get('/usertype/edit/{id}', 'Admin\UsertypeController@edit')->name('admin.usertype.edit');
Route::post('/usertype/edit', 'Admin\UsertypeController@edit')->name('admin.usertype.edit');

Route::get('/userrole', 'Admin\UserroleController@index')->name('admin.userrole.index');
Route::get('/userrole/create', 'Admin\UserroleController@create')->name('admin.userrole.create');  
Route::post('/userrole/store', 'Admin\UserroleController@store')->name('admin.userrole.store');
Route::get('/userrole/edit/{id}', 'Admin\UserroleController@edit')->name('admin.userrole.edit');
Route::post('/userrole/edit', 'Admin\UserroleController@edit')->name('admin.userrole.edit');

 
//CMS Pages
Route::get('/cms_pages', 'Admin\CmsPageController@index')->name('admin.cms_pages.index');
Route::get('/cms_pages/create', 'Admin\CmsPageController@create')->name('admin.cms_pages.create');
Route::post('/cms_pages/store', 'Admin\CmsPageController@store')->name('admin.cms_pages.store');
Route::get('/cms_pages/edit/{id}', 'Admin\CmsPageController@editCmsPage')->name('admin.edit_cms_page');
Route::post('/cms_pages/edit', 'Admin\CmsPageController@editCmsPage')->name('admin.edit_cms_page');

//Email Templates Pages
Route::get('/email_templates', 'Admin\EmailTemplateController@index')->name('admin.email.index');
Route::get('/email_templates/create', 'Admin\EmailTemplateController@create')->name('admin.email.create');
Route::post('/email_templates/store', 'Admin\EmailTemplateController@store')->name('admin.email.store');
Route::get('/edit_email_template/{id}', 'Admin\EmailTemplateController@editEmailTemplate')->name('admin.edit_email_template');
Route::post('/edit_email_template', 'Admin\EmailTemplateController@editEmailTemplate')->name('admin.edit_email_template');	

//SEO Tool
Route::get('/edit_seo/{id}', 'Admin\AdminController@editSeo')->name('admin.edit_seo');
Route::post('/edit_seo', 'Admin\AdminController@editSeo')->name('admin.edit_seo');

Route::get('/api-key', 'Admin\AdminController@editapi')->name('admin.edit_api');
Route::post('/api-key', 'Admin\AdminController@editapi')->name('admin.edit_api');	


//restaurants  Start   
Route::get('/restaurants', 'Admin\RestaurantController@index')->name('admin.restaurants.index');
Route::get('/restaurant/create', 'Admin\RestaurantController@create')->name('admin.restaurants.create');	 
Route::post('/restaurant/store', 'Admin\RestaurantController@store')->name('admin.restaurants.store');
Route::get('/restaurant/edit/{id}', 'Admin\RestaurantController@edit')->name('admin.restaurants.edit');
Route::post('/restaurant/edit', 'Admin\RestaurantController@edit')->name('admin.restaurants.update');
Route::get('/restaurant/hours/{rid}', 'Admin\RestaurantController@hours')->name('admin.restaurants.hours');
Route::post('/restaurant/addHour', 'Admin\RestaurantController@addHour')->name('admin.restaurants.addHour');
Route::get('/restaurant/RemoveHour/{id}', 'Admin\RestaurantController@RemoveHour')->name('admin.restaurants.addHour');

//cuisine  Start   
Route::get('/cuisine', 'Admin\CuisineController@index')->name('admin.cuisine.index');
Route::get('/cuisine/create', 'Admin\CuisineController@create')->name('admin.cuisine.create');	 
Route::post('/cuisine/store', 'Admin\CuisineController@store')->name('admin.cuisine.store');
Route::get('/cuisine/edit/{id}', 'Admin\CuisineController@edit')->name('admin.cuisine.edit');
Route::post('/cuisine/edit', 'Admin\CuisineController@edit')->name('admin.cuisine.update');

//Country  Start   
Route::get('/country', 'Admin\CountryController@index')->name('admin.country.index');
Route::get('/country/create', 'Admin\CountryController@create')->name('admin.country.create');	 
Route::post('/country/store', 'Admin\CountryController@store')->name('admin.country.store');
Route::get('/country/edit/{id}', 'Admin\CountryController@edit')->name('admin.country.edit');
Route::post('/country/edit', 'Admin\CountryController@edit')->name('admin.country.update');

//StateController  Start   
Route::get('/state', 'Admin\StateController@index')->name('admin.state.index');
Route::get('/state/create', 'Admin\StateController@create')->name('admin.state.create');	 
Route::post('/state/store', 'Admin\StateController@store')->name('admin.state.store');
Route::get('/state/edit/{id}', 'Admin\StateController@edit')->name('admin.state.edit');
Route::post('/state/edit', 'Admin\StateController@edit')->name('admin.state.update');

//Categories  Start   
Route::get('/categories', 'Admin\CategoryController@index')->name('admin.categories.index');
Route::get('/categories/create', 'Admin\CategoryController@create')->name('admin.categories.create');	 
Route::post('/categories/store', 'Admin\CategoryController@store')->name('admin.categories.store');
Route::get('/categories/edit/{id}', 'Admin\CategoryController@edit')->name('admin.categories.edit');
Route::post('/categories/edit', 'Admin\CategoryController@edit')->name('admin.categories.update');

//menus  Start   
Route::get('/menus', 'Admin\MenuController@index')->name('admin.menus.index');
Route::get('/menus/create', 'Admin\MenuController@create')->name('admin.menus.create');	 
Route::post('/menus/store', 'Admin\MenuController@store')->name('admin.menus.store');
Route::get('/menus/edit/{id}', 'Admin\MenuController@edit')->name('admin.menus.edit');
Route::post('/menus/edit', 'Admin\MenuController@edit')->name('admin.menus.update');

//modifiers  Start   
Route::get('/modifiers', 'Admin\ModifiersController@index')->name('admin.modifiers.index');
Route::get('/modifiers/create', 'Admin\ModifiersController@create')->name('admin.modifiers.create');	 
Route::post('/modifiers/store', 'Admin\ModifiersController@store')->name('admin.modifiers.store');
Route::get('/modifiers/edit/{id}', 'Admin\ModifiersController@edit')->name('admin.modifiers.edit');
Route::post('/modifiers/edit', 'Admin\ModifiersController@edit')->name('admin.modifiers.update');