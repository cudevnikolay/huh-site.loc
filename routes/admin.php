<?php

/*Route::middleware('auth:admin')->get('/admin', function () {
    Route::get('', 'Admin\HomeController@index')->name('admin.dashboard');
});*/
Route::prefix('admin')->middleware(['admin', 'auth'])->namespace('Admin')->group(function () {
    Route::get('/', 'HomeController@index')->name('admin.dashboard');

    //Translations
    Route::get('languages', 'TranslationsController@index')->name('language.index');
    Route::get('languages/{locale}/edit', 'TranslationsController@edit')->name('language.edit');
    Route::get('languages/create', 'TranslationsController@create')->name('language.create');
    Route::delete('languages/{locale}', 'TranslationsController@delete')->name('language.delete');
    Route::put('languages/{name}/edit', 'TranslationsController@update')->name('language.update');
    Route::put('languages/store', 'TranslationsController@store')->name('language.store');
    Route::post('languages/{id}/switch-status', 'TranslationsController@switchStatus');
    //Translations api
    Route::post('api/translations', 'Api\TranslationsApiController@index');

    //Social links
    Route::get('social-links', 'SocialLinksController@index')->name('social-links.index');
    Route::post('social-links/update', 'SocialLinksController@update')->name('social-links.update');
    
    //Team
    Route::get('team', 'TeamController@index')->name('team.index');
    Route::get('team/{id}/edit', 'TeamController@edit')->name('team.edit');
    Route::get('team/create', 'TeamController@create')->name('team.create');
    Route::delete('team/{id}', 'TeamController@delete')->name('team.delete');
    Route::put('team/{id}/edit', 'TeamController@update')->name('team.update');
    Route::post('team/store', 'TeamController@store')->name('team.store');
    //Team api
    Route::post('api/team/{id}/switch-status', 'Api\TeamApiController@switchStatus');
    Route::post('api/team', 'Api\TeamApiController@index');
    
    //Quotes
    Route::get('quotes', 'QuotesController@index')->name('quotes.index');
    Route::get('quotes/{id}/edit', 'QuotesController@edit')->name('quotes.edit');
    Route::get('quotes/create', 'QuotesController@create')->name('quotes.create');
    Route::delete('quotes/{id}', 'QuotesController@delete')->name('quotes.delete');
    Route::put('quotes/{id}/edit', 'QuotesController@update')->name('quotes.update');
    Route::post('quotes/store', 'QuotesController@store')->name('quotes.store');
    //Quotes api
    Route::post('api/quotes/{id}/switch-status', 'Api\QuotesApiController@switchStatus');
    Route::post('api/quotes', 'Api\QuotesApiController@index');
    
    //Solutions
    Route::get('solutions', 'SolutionsController@index')->name('solutions.index');
    Route::get('solutions/{id}/edit', 'SolutionsController@edit')->name('solutions.edit');
    Route::get('solutions/create', 'SolutionsController@create')->name('solutions.create');
    Route::delete('solutions/{id}', 'SolutionsController@delete')->name('solutions.delete');
    Route::put('solutions/{id}/edit', 'SolutionsController@update')->name('solutions.update');
    Route::post('solutions/store', 'SolutionsController@store')->name('solutions.store');
    //Solutions api
    Route::post('api/solutions/{id}/switch-status', 'Api\SolutionsApiController@switchStatus');
    Route::post('api/solutions', 'Api\SolutionsApiController@index');
});