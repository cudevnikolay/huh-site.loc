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
    
    Route::post('api/translations', 'Api\TranslationsApiController@index');

    //Social links
    Route::get('social-links', 'SocialLinksController@index')->name('social-links.index');
    Route::post('social-links/update', 'SocialLinksController@update')->name('social-links.update');
});