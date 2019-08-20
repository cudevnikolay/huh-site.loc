<?php

namespace App\Providers;

use App\Http\ViewComposers\SocialLinksComposer;
use Illuminate\Support\Facades\View;
use Illuminate\Support\ServiceProvider;

class ComposerServiceProvider extends ServiceProvider
{
    public function boot()
    {
        View::composer('includes.footer', SocialLinksComposer::class);
    }

    public function register()
    {

    }
}