<?php
Route::group([

    'middleware' => 'api',

], function ($router) {
              
                Route::post('login', 'Api\AuthController@login');
                Route::post('logout', 'Api\AuthController@logout');
                Route::post('register', 'Api\AuthController@register');
                // Route::any('get_states', 'Api\StateDistrict@get_states');
                // Route::any('get_district', 'Api\StateDistrict@get_district');
                // Route::post('forget-password', 'Api\AuthController@forgetPassword');
                //Route::any('search', 'Api\UserApiController@search');
    Route::group(['middleware' => 'auth:api'], 
    function ($router) {
       
        Route::post('registration-form', 'Api\UserApiController@registrationForm');

        Route::group(['middleware' => 'activate_account'], function(){
                    Route::post('refresh', 'Api\AuthController@refresh');
                    Route::post('me', 'Api\AuthController@me');
                    Route::any('dashboard', 'Api\UserApiController@users');
                    Route::get('business-profile-info', 'Api\UserProfileController@businessProfileInfo');
                    Route::post('business-profile', 'Api\UserProfileController@businessProfile');
                    Route::get('get-commodities', 'Api\commoditiesController@getCommodities');
                    Route::post('add-commodities', 'Api\commoditiesController@addCommodities');

                    Route::post('doc_business_profile', 'Api\BusinessProfileController@docBusinessPro');
                    Route::get('get_business_profile/{id}', 'Api\BusinessProfileController@profileEdit');
                    Route::post('update_business_profile', 'Api\BusinessProfileController@profileUpdate');
                    Route::get('about_bussiness/{id}', 'Api\BusinessProfileController@about_bussiness_edit');
                    Route::post('about_bussiness_update', 'Api\BusinessProfileController@aboutUpdate');
                    Route::post('add-new-address', 'Api\AddressController@newAddress');
                    Route::post('add-gallery', 'Api\GalleryController@addGalleryImage');
                    Route::get('get-gallery', 'Api\GalleryController@getGallery');
                    Route::post('add-rating', 'Api\RatingController@ratingAdd');
                    Route::post('update-contact-detail', 'Api\BusinessProfileController@contactUpdate');

                    Route::post('update-gallery-products-image', 'Api\GalleryController@productGalleryUpdate');
                    Route::post('address-update', 'Api\AddressController@updateAddress');
                    Route::post('doc-update', 'Api\BusinessProfileController@docUpdate');

                    Route::get('directory-listing','Api\DirectoryController@directoryListing');
                    Route::get('directory-search','Api\DirectoryController@directorySearch');
                });
                });
   


});
