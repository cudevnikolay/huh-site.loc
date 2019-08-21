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
});