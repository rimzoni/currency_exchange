<?php

/*
|--------------------------------------------------------------------------
| Application Routes
|--------------------------------------------------------------------------
|
| Here is where you can register all of the routes for an application.
| It's a breeze. Simply tell Laravel the URIs it should respond to
| and give it the controller to call when that URI is requested.
|
*/

/*
|--------------------------------------------------------------------------
| View routes for Web Application
|--------------------------------------------------------------------------
|
| Route the user to the parts of the application
|
*/
Route::get('/', 'WebAppController@home');
Route::get('/surcharges', 'WebAppController@surcharges');
Route::get('/actions', 'WebAppController@actions');
Route::get('/rates', 'WebAppController@rates');
Route::get('/emails', 'WebAppController@emails');
Route::get('/discounts', 'WebAppController@discounts');
Route::get('/orders', 'WebAppController@orders');


/*
|--------------------------------------------------------------------------
| Resource prefix
|--------------------------------------------------------------------------
|
| Adding prefix to the resources urls.
| For development of an application while in production.
| New route group will be added with prefix v2 with duplicated controllers
|
*/
// index() - for displaying list of the resource
// - create() - this displays the form for creating the school resource
// - store() - this is for the submit request of the form to create a school
// - show($id) - this displays a single school
// - edit($id) - display edit form a single school
// - update($id) - update a school
// - destroy($id) - delete
// ,
//           ['except' => ['edit', 'update', 'destroy']]));
Route::group(array('prefix' => 'api/v1'), function()
    {
      Route::get('orders/updateStatus', 'OrdersController@updateStatus');
      Route::resource('orders', 'OrdersController');
      Route::resource('actions', 'ActionsController');
      Route::resource('emails', 'EmailsController');
      Route::resource('discounts', 'DiscountsController');
      Route::get('rates/valueBySource', 'RatesController@showRateBySourceCurrency');
      Route::get('rates/rateBySource', 'RatesController@showRatesBySourceCurrency');
      Route::get('rates/updateRates', 'RatesController@updateExternalRate');
      Route::resource('rates', 'RatesController');
      Route::get('calculations/calculateRate','CalculationsController@calculateRate');
      Route::get('calculations/calculateTotalAmount','CalculationsController@calculateTotalAmount');
      Route::resource('surcharges/getAmount', 'SurchargesController@getAmountByPurchase');
      Route::resource('surcharges', 'SurchargesController');
    });
