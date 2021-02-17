<?php


/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| is assigned the "api" middleware group. Enjoy building your API!
|
*/
use Illuminate\Http\Request;

header('Access-Control-Allow-Origin: *');
header('Access-Control-Allow-Methods: *');
header('Access-Control-Allow-Headers: *');

header('Content-Type: application/json; charset=UTF-8', true);


/** Start Auth Route **/

Route::middleware('auth:api')->group(function () {
    //Auth_private
    Route::prefix('Auth_private')->group(function()
    {
        Route::post('/change_password', 'Api\UserController@change_password')->name('user.change_password');
        Route::post('/edit_profile', 'Api\UserController@edit_profile')->name('user.edit_profile');
        Route::post('/change_setting', 'Api\UserController@change_setting')->name('user.change_setting');
        Route::post('/check_password_code', 'Api\UserController@check_password_code')->name('user.check_password_code');
        Route::post('/check_active_code', 'Api\UserController@check_active_code')->name('user.check_active_code');
        Route::get('/my_info', 'Api\UserController@my_info')->name('user.my_info');
        Route::post('/reset_password', 'Api\UserController@reset_password')->name('user.reset_password');
    });

    //whishlist
    Route::prefix('whishlist')->group(function()
    {
        Route::post('/addTOWhishlist', 'Api\ProductsController@addTOWhishlist')->name('whishlist.addTOWhishlist');
        Route::get('/myWhishlist', 'Api\ProductsController@myWhishlist')->name('whishlist.myWhishlist');
    });

    /** Locations */
    Route::prefix('Locations')->group(function () {
        Route::post('/add_address', 'Api\LocationsController@add_address')->name('Locations.add_address');
        Route::post('/edit_address/{id}', 'Api\LocationsController@edit_address')->name('Locations.edit_address');
        Route::post('/delete_address/{id}', 'Api\LocationsController@delete_address')->name('Locations.delete_address');
        Route::get('/single_address/{id}', 'Api\LocationsController@single_address')->name('Locations.single_address');
        Route::get('/my_addresses', 'Api\LocationsController@my_addresses')->name('Locations.my_addresses');
        Route::post('/changeDefault/{id}', 'Api\LocationsController@changeDefault')->name('Locations.changeDefault');
    });

    /** Cart */
    Route::prefix('Cart')->group(function () {
        Route::post('/addToCart', 'Api\CartController@addToCart')->name('Cart.addToCart');
        Route::get('/myCart', 'Api\CartController@myCart')->name('Cart.myCart');
        Route::post('/deleteMyCart', 'Api\CartController@deleteMyCart')->name('Cart.deleteMyCart');
        Route::post('/deleteFromCart', 'Api\CartController@deleteFromCart')->name('Cart.deleteFromCart');
        Route::post('/updateCart', 'Api\CartController@updateCart')->name('Cart.updateCart');
    });


    /** Order */
    Route::prefix('Order')->group(function () {
        Route::post('/makeOrder', 'Api\OrderController@makeOrder')->name('Order.makeOrder');
        Route::post('/checkDiscountCode', 'Api\OrderController@checkDiscountCode')->name('Order.checkDiscountCode');
        Route::post('/removeDiscountCode', 'Api\OrderController@removeDiscountCode')->name('Order.removeDiscountCode');
        Route::get('/myOrders', 'Api\OrderController@myOrders')->name('Order.myOrders');
        Route::get('/singleOrder', 'Api\OrderController@singleOrder')->name('Order.singleOrder');
    });
});
/** End Auth Route **/

/** Auth_general */
Route::prefix('Auth_general')->group(function()
{
    Route::post('/register', 'Api\UserController@register')->name('user.register');
    Route::post('/login', 'Api\UserController@login')->name('user.login');
    Route::post('/forget_password', 'Api\UserController@forget_password')->name('user.forget_password');
});

//Category
Route::prefix('Category')->group(function()
{
    Route::get('/mainCategory', 'Api\CategoryController@mainCategory')->name('Category.mainCategory');
    Route::get('/subCategory', 'Api\CategoryController@subCategory')->name('Category.subCategory');
});

//Category
Route::prefix('Products')->group(function()
{
    Route::get('/ProductsByCategory', 'Api\ProductsController@ProductsByCategory')->name('Products.ProductsByCategory');
    Route::get('/singleProduct', 'Api\ProductsController@singleProduct')->name('Products.singleProduct');
});
