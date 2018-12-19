<?php

Auth::routes();
Route::get('/home', 'HomeController@index')->name('home');
Route::get('/','IndexController@index')->name('index');
Route::get('/category/{category}','IndexController@category')->name('category.detail');
Route::get('about','AboutController@about')->name('about_us');
Route::get('service','ServiceController@services')->name('service');
Route::get('prices','PriceController@price')->name('prices');
Route::get('portfolio','PortfolioController@portfolio')->name('portfolio');
Route::get('/portfolio/{portfolio}','PortfolioController@detail')->name('portfolio.detail');
Route::get('blog','BlogController@index')->name('blog');
Route::get('/blog/{blog}','BlogController@show')->name('show');
Route::get('contact','ContactController@contact')->name('contact_us');
Route::post('message','ContactController@message')->name('send');
Route::post('quote','QuoteController@quote')->name('quotes');
Route::group(['prefix'=>'arch'], function (){
  Route::get('/','DashboardController@index')->name('dashboard');
  Route::resource('category','Admin\CategoryController');
  Route::resource('slider','Admin\SliderController');
  Route::resource('explore','Admin\ExploreController');
  Route::resource('service','Admin\ServiceController');
  Route::resource('client','Admin\ClientController');
  Route::resource('price','Admin\PriceController');
  Route::resource('team','Admin\TeamController');
  Route::resource('portfolio','Admin\PortfolioController');
  Route::resource('message','Admin\MessageController');
  Route::resource('blog','Admin\BlogController');
  Route::resource('quote','Admin\QuoteController');
  Route::resource('homeportfolio','Admin\HomeportrfolioController');
  Route::resource('requestq','Admin\RequestController');
  Route::resource('aboutheader','Admin\AboutheaderController');
  Route::resource('blogheader','Admin\BlogheaderController');
  Route::resource('contactheader','Admin\ContactheaderController');
  Route::resource('nav','Admin\NavController');
  Route::resource('logo','LogoController');
  Route::resource('commercial','Admin\CommercialController');
  Route::resource('education','Admin\EducationController');
  Route::resource('civic','Admin\CivicController');
  Route::resource('medical','Admin\MedicalController');
  Route::resource('agric','Admin\AgricController');
  Route::resource('relig','Admin\ReligController');
  Route::resource('industrial','Admin\IndustrialController');
  Route::resource('portfolioheader','Admin\PortfolioheaderController');
});
