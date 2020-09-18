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
// Backend site .................................
Route::get('/logout','SuperAdminController@logout');
Route::get('/admin','AdminController@index');
Route::get('/dashboard/{lang}','SuperAdminController@index');
Route::post('/admin-dashboard', 'AdminController@dashboard');

// Cateogry Related Route 
Route::get('/category/{lang}', 'CategoryController@all_category');
Route::post('/save-category', 'CategoryController@save_category');
Route::get('/edit-category/{category_id}', 'CategoryController@edit_category');
Route::post('/update-category', 'CategoryController@update_category');
Route::post('/delete-category', 'CategoryController@delete_category');
Route::get('/active_category/{category_id}', 'CategoryController@active_category');



// Company Related Route 
Route::get('/company/{lang}', 'CompanyController@all_company');
Route::post('/save-company', 'CompanyController@save_company');
Route::get('/edit-company/{company_id}', 'CompanyController@edit_company');
Route::post('/update-company', 'CompanyController@update_company');
Route::post('/delete-company', 'CompanyController@delete_company');
Route::get('/active_company/{company_id}', 'CompanyController@active_company'); 

// Company Related Route 
Route::get('/brand/{lang}', 'BrandController@all_brand');
Route::post('/save-brand', 'BrandController@save_brand');
Route::get('/edit-brand/{brand_id}', 'BrandController@edit_brand');
Route::post('/update-brand', 'BrandController@update_brand');
Route::post('/delete-brand', 'BrandController@delete_brand');
Route::get('/active_brand/{brandy_id}', 'BrandController@active_brand'); 

// Products Rots Are Here 
Route::get('/product/{lang}', 'ProductController@all_products');
Route::get('/getsubcategory/{categoryid}', 'ProductController@getsubcategory');
Route::post('/save-product', 'ProductController@save_product');
Route::get('/active_products/{product_id}', 'ProductController@active_products');
Route::get('/edit-products/{product_id}', 'ProductController@edit_product');
Route::post('/update-products', 'ProductController@update_product');
Route::post('/delete-products', 'ProductController@delete_product');


//slider Rots Are Here 
Route::get('/add-slider', 'SliderController@index');
Route::post('/save-slider', 'SliderController@save_slider');
Route::get('/all-sliders', 'SliderController@all_sliders');
Route::get('/edit-slider/{slider_id}', 'SliderController@edit_slider');
Route::post('/update-slider/{slider_id}', 'SliderController@update_slider');
Route::get('/delete-slider/{slider_id}', 'SliderController@delete_slider');

//manage rots are here 
Route::get('/manage-order/{lang?}', 'CheckoutController@manage_order');
Route::get('/view-order/{order_id}/{lang?}', 'CheckoutController@view_order');
Route::get('/active_order/{order_id}/{lang?}', 'CheckoutController@active_order');
Route::get('/unactive_order/{order_id}/{lang?}', 'CheckoutController@unactive_order');
Route::get('/delete-order/{order_id}/{lang?}', 'CheckoutController@delete_order');


// show routs Are here 
Route::post('/add-to-cart','CartController@add_to_cart');
Route::get('/show-cart/{lang?}','CartController@show_cart');
Route::post('/update-cart','CartController@cart_update');
Route::get('/delete-to-cart/{rowId}/{lang?}','CartController@delete_to_cart');
//checkout routs here 
Route::get('/login-check/{lang?}','CheckoutController@login_check');
Route::post('/customer-registration','CheckoutController@customer_registration');
Route::get('/checkout/{lang?}','CheckoutController@checkout');
Route::post('/save-shiping-details','CheckoutController@save_shiping_details');
//Customer Login & Logout Are here  
Route::post('/customer-login/{lang?}','CheckoutController@customer_login');
Route::get('/customer-logout/{lang?}','CheckoutController@customer_logout');

//show category wise product here 
Route::get('/product_by_category/{Category_id}','HomeController@show_product_by_categorys');
Route::get('/product_by_manufacture/{manufacture_id}','HomeController@show_product_by_manufactures');



// Paymetn
Route::get('/payment/{lang?}','CheckoutController@payment');
Route::post('/order-place','CheckoutController@order_place');

// Frontend site
Route::get('/{lang?}','HomeController@index');
Route::get('/view_product/{product_id}/{lang?}','HomeController@product_details_by_id');
Route::get('/{lang?}/{catgoryname}','HomeController@category');



