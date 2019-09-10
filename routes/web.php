<?php

Auth::routes();

// Routes under localizations
$localizator = resolve(\App\Helpers\UriLocalizer::class);

// Routes under localizations
Route::group([
    'prefix'     => $localizator->localeFromRequest(),
    'middleware' => ['waawiLocalizationRedirect']
],function () {
    Route::get('/', 'HomeController@index')->name('home');
    Route::get('/platform', 'PageController@platform')->name('platform');
    //Route::get('/team', 'PageController@team')->name('team');
    Route::get('/solution', 'PageController@solution')->name('solution');
    Route::get('/training', 'PageController@training')->name('training');
    Route::get('/ia-solution', 'PageController@iaSolution')->name('ia-solution');
    Route::get('/contact', 'PageController@contact')->name('contact');
});

Route::post('/contact', 'ContactController@send')->name('contact-send');
