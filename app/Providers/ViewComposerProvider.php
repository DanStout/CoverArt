<?php

namespace Coverart\Providers;

use Coverart\Platform;
use Illuminate\Support\ServiceProvider;
use View;

class ViewComposerProvider extends ServiceProvider
{
    /**
     * Bootstrap the application services.
     *
     * @return void
     */
    public function boot()
    {
        View::composer('covers.form', function (\Illuminate\View\View $view)
        {
            $platforms = Platform::lists('name', 'id');
            $view->with('platforms', $platforms);
        });
    }

    /**
     * Register the application services.
     *
     * @return void
     */
    public function register()
    {
        //
    }
}
