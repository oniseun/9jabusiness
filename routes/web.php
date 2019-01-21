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
Route::get('sitemap.xml', function()
{
   return response()->view('sitemap')->header('Content-Type', 'text/xml');
} );


Route::get('/', 'IndexController@main');

Route::view('contact', 'public.contact');

Route::post('send/feedback',  "IndexController@send_feedback");

Route::get('categories', 'CategoryController@main');

Route::get('locations', 'LocationController@states');

Route::get('listing/{url}', "ListingController@info")->where('url', '[A-Za-z0-9_\-]+');

Route::get('categories/{url}',"ListingController@category")->where('url', '[A-Za-z0-9_\-]+');
Route::get('categories/{url}/prev/{from_time}/{page_num}','ListingController@category_prev')
		->where(['url' => '[A-Za-z0-9_\-]+', 'page_num' => '[0-9]+', 'from_time' => '[0-9]+' ]);
Route::get('categories/{url}/next/{from_time}/{page_num}','ListingController@category_next')
		->where(['url' => '[A-Za-z0-9_\-]+', 'page_num' => '[0-9]+', 'from_time' => '[0-9]+' ]);

Route::get('locations/{url}',"ListingController@location")->where('url', '[A-Za-z0-9_\-]+');
Route::get('locations/{url}/prev/{from_time}/{page_num}','ListingController@location_prev')
		->where(['url' => '[A-Za-z0-9_\-]+', 'page_num' => '[0-9]+', 'from_time' => '[0-9]+' ]);
Route::get('locations/{url}/next/{from_time}/{page_num}','ListingController@location_next')
		->where(['url' => '[A-Za-z0-9_\-]+', 'page_num' => '[0-9]+', 'from_time' => '[0-9]+' ]);


Route::get('author/{url}', "ListingController@author")->where('url', '[A-Za-z0-9_\-\.]+');
Route::get('author/{url}/prev/{from_time}/{page_num}','ListingController@author_prev')
		->where(['url' => '[A-Za-z0-9_\-]+', 'page_num' => '[0-9]+', 'from_time' => '[0-9]+' ]);
Route::get('author/{url}/next/{from_time}/{page_num}','ListingController@author_next')
		->where(['url' => '[A-Za-z0-9_\-]+', 'page_num' => '[0-9]+', 'from_time' => '[0-9]+' ]);

Route::get('search',"ListingController@search");
Route::get('search/prev/{from_time}/{page_num}','ListingController@search_prev')
		->where(['page_num' => '[0-9]+', 'from_time' => '[0-9]+' ]);
Route::get('search/next/{from_time}/{page_num}','ListingController@search_next')
		->where(['page_num' => '[0-9]+', 'from_time' => '[0-9]+' ]);

Route::redirect('dashboard', 'admin/list/recent/listing');

Route::get('admin/login', 'AdminController@login_form');



Route::post('admin/action/login','AdminController@login');

Route::get('admin/banned', 'AdminController@banned_form');


Route::group(['middleware' => ['web.auth']], function () {


			Route::group(['prefix' => 'admin/form'],function () 
			{

					Route::get('logout','AdminController@logout_form');

			});

			Route::group(['prefix' => 'admin/form/add'],function () 
			{

					Route::get('category','CategoryController@add_form');
					Route::get('city','LocationController@add_city_form');
					Route::get('admin','AdminController@add_form');
					Route::get('listing','ListingController@select_state');
					Route::get('listing/{state_id}','ListingController@add_form')->where('state_id', '[0-9]+');

			});

			Route::group(['prefix' => 'admin/add'],function () 
			{


					Route::post('category','CategoryController@add');
					Route::post('city','LocationController@add_city');
					Route::post('admin','AdminController@add');
					Route::post('listing','ListingController@add');

			});

			Route::group(['prefix' => 'admin/form/edit'],function () 
			{

					Route::get('profile','AdminController@edit_profile');
					Route::get('password','AdminController@edit_password');
					Route::get('listing/{id}','ListingController@edit_form')->where('id', '[0-9]+');
					Route::get('category/{id}','CategoryController@edit_form')->where('id', '[0-9]+');
					Route::get('city/{id}','LocationController@edit_city_form')->where('id', '[0-9]+');

			});



			Route::group(['prefix' => 'admin/edit'],function () 
			{

					Route::post('profile','AdminController@update_profile');
					Route::post('password','AdminController@update_password');
					Route::post('photo','AdminController@update_photo');
					Route::post('listing','ListingController@update_listing');
					Route::post('category','CategoryController@update_category');
					Route::post('city','LocationController@update_city');

			});

			Route::group(['prefix' => 'admin/list'],function () 
			{


					Route::get('categories','CategoryController@admin_list');
					Route::get('cities','LocationController@select_state');
					Route::get('cities/{state_id}','LocationController@cities')->where('state_id', '[0-9]+');
					Route::get('admins','AdminController@admin_list');

					## Listings
					Route::get('unapproved/listing','ListingController@unapproved_listing');
					Route::get('unapproved/listing/prev/{from_time}/{page_num}','ListingController@unapproved_listing_prev')
						->where(['page_num' => '[0-9]+', 'from_time' => '[0-9]+' ]);
					Route::get('unapproved/listing/next/{from_time}/{page_num}','ListingController@unapproved_listing_next')
						->where(['page_num' => '[0-9]+', 'from_time' => '[0-9]+' ]);

					Route::get('recent/listing','ListingController@recent_listing');
					Route::get('recent/listing/prev/{from_time}/{page_num}','ListingController@recent_listing_prev')
						->where(['page_num' => '[0-9]+', 'from_time' => '[0-9]+' ]);
					Route::get('recent/listing/next/{from_time}/{page_num}','ListingController@recent_listing_next')
						->where(['page_num' => '[0-9]+', 'from_time' => '[0-9]+' ]);

					Route::get('trash/listing','ListingController@trash_listing');
					Route::get('trash/listing/prev/{from_time}/{page_num}','ListingController@trash_listing_prev')
						->where(['page_num' => '[0-9]+', 'from_time' => '[0-9]+' ]);
					Route::get('trash/listing/next/{from_time}/{page_num}','ListingController@trash_listing_next')
						->where(['page_num' => '[0-9]+', 'from_time' => '[0-9]+' ]);

					Route::get('expired/listing','ListingController@expired_listing');
					Route::get('expired/listing/prev/{from_time}/{page_num}','ListingController@expired_listing_prev')
						->where(['page_num' => '[0-9]+', 'from_time' => '[0-9]+' ]);
					Route::get('expired/listing/next/{from_time}/{page_num}','ListingController@expired_listing_next')
						->where(['page_num' => '[0-9]+', 'from_time' => '[0-9]+' ]);


					Route::get('search/listing','ListingController@search_listing');

			});

			Route::group(['prefix' => 'admin/action'],function () 
			{

					Route::post('approve/listing','ListingController@approve');
					Route::post('delete/listing','ListingController@remove');
					Route::post('restore/listing','ListingController@restore');


					Route::post('ban/admin','AdminController@ban_admin');
					Route::post('unban/admin','AdminController@unban_admin');
					Route::post('logout','AdminController@logout');

			});

});
Route::view('errors/404', 'public.404');

