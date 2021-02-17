<?php

Route::post('/admin/login', 'AuthController@login')->name('admin.login');

Route::prefix('Admin')->group(function () {
    Route::get('/login', function () {
        return view('Admin.loginAdmin');
    });
    Route::group(['middleware' => 'roles', 'roles' => ['Admin']], function () {

        Route::get('/logout/logout', 'AuthController@logout')->name('user.logout');
        Route::get('/home', 'AuthController@index')->name('admin.dashboard');

        // Profile Route
        Route::prefix('profile')->group(function () {
            Route::get('/index', 'profileController@index')->name('profile.index');
            Route::post('/index', 'profileController@update')->name('profile.update');
        });

        // Category Routes
        Route::prefix('Category')->group(function () {
            Route::get('/index', 'CategoryController@index')->name('Category.index');
            Route::get('/allData', 'CategoryController@allData')->name('Category.allData');
            Route::post('/create', 'CategoryController@create')->name('Category.create');
            Route::get('/edit/{id}', 'CategoryController@edit')->name('Category.edit');
            Route::post('/update', 'CategoryController@update')->name('Category.update');
            Route::get('/destroy/{id}', 'CategoryController@destroy')->name('Category.destroy');
            Route::get('/ChangeStatus/{id}', 'CategoryController@ChangeStatus')->name('Category.ChangeStatus');
        });

        // Color Routes
        Route::prefix('Color')->group(function () {
            Route::get('/index', 'ColorController@index')->name('Color.index');
            Route::get('/allData', 'ColorController@allData')->name('Color.allData');
            Route::post('/create', 'ColorController@create')->name('Color.create');
            Route::get('/edit/{id}', 'ColorController@edit')->name('Color.edit');
            Route::post('/update', 'ColorController@update')->name('Color.update');
            Route::get('/destroy/{id}', 'ColorController@destroy')->name('Color.destroy');
        });

        // Product Routes
        Route::prefix('Product')->group(function () {
            Route::get('/index', 'ProductController@index')->name('Product.index');
            Route::get('/allData', 'ProductController@allData')->name('Product.allData');
            Route::get('/createForm', 'ProductController@createForm')->name('Product.createForm');
            Route::post('/create', 'ProductController@create')->name('Product.create');
            Route::get('/edit/{id}', 'ProductController@edit')->name('Product.edit');
            Route::post('/update', 'ProductController@update')->name('Product.update');
            Route::get('/destroy/{id}', 'ProductController@destroy')->name('Product.destroy');
            Route::get('/ChangeStatus/{id}', 'ProductController@ChangeStatus')->name('Product.ChangeStatus');
            Route::get('/ProductDetails/{id}', 'ProductController@ProductDetails')->name('Product.ProductDetails');
            Route::post('/saveProductDetails', 'ProductController@saveProductDetails')->name('Product.saveProductDetails');
        });


        // Brands Routes
        Route::prefix('Brands')->group(function () {
            Route::get('/index', 'BrandsController@index')->name('Brands.index');
            Route::get('/allData', 'BrandsController@allData')->name('Brands.allData');
            Route::post('/create', 'BrandsController@create')->name('Brands.create');
            Route::get('/edit/{id}', 'BrandsController@edit')->name('Brands.edit');
            Route::post('/update', 'BrandsController@update')->name('Brands.update');
            Route::get('/destroy/{id}', 'BrandsController@destroy')->name('Brands.destroy');
        });

        // ProductImage Routes
        Route::prefix('ProductImage')->group(function () {
            Route::get('/index/{id}', 'ProductImageController@index')->name('ProductImage.index');
            Route::get('/allData/{id}', 'ProductImageController@allData')->name('ProductImage.allData');
            Route::post('/create', 'ProductImageController@create')->name('ProductImage.create');
            Route::get('/destroy/{id}', 'ProductImageController@destroy')->name('ProductImage.destroy');
        });


        // ProductSizes Routes
        Route::prefix('ProductSizes')->group(function () {
            Route::get('/index/{id}', 'ProductSizesController@index')->name('ProductSizes.index');
            Route::get('/allData/{id}', 'ProductSizesController@allData')->name('ProductSizes.allData');
            Route::get('/edit/{id}', 'ProductSizesController@edit')->name('ProductSizes.edit');
            Route::post('/create', 'ProductSizesController@create')->name('ProductSizes.create');
            Route::post('/update', 'ProductSizesController@update')->name('ProductSizes.update');
            Route::get('/destroy/{id}', 'ProductSizesController@destroy')->name('ProductSizes.destroy');
        });

        // Sliders Routes
        Route::prefix('Sliders')->group(function () {
            Route::get('/index', 'SlidersController@index')->name('Sliders.index');
            Route::get('/allData', 'SlidersController@allData')->name('Sliders.allData');
            Route::get('/edit/{id}', 'SlidersController@edit')->name('Sliders.edit');
            Route::post('/create', 'SlidersController@create')->name('Sliders.create');
            Route::post('/update', 'SlidersController@update')->name('Sliders.update');
            Route::get('/destroy/{id}', 'SlidersController@destroy')->name('Sliders.destroy');
        });

        // Discount_code Routes
        Route::prefix('Discount_code')->group(function () {
            Route::get('/index', 'Discount_codeController@index')->name('Discount_code.index');
            Route::get('/allData', 'Discount_codeController@allData')->name('Discount_code.allData');
            Route::get('/edit/{id}', 'Discount_codeController@edit')->name('Discount_code.edit');
            Route::post('/create', 'Discount_codeController@create')->name('Discount_code.create');
            Route::post('/update', 'Discount_codeController@update')->name('Discount_code.update');
            Route::get('/destroy/{id}', 'Discount_codeController@destroy')->name('Discount_code.destroy');
        });

    });
});

