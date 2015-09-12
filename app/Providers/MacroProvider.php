<?php

namespace Coverart\Providers;

use Collective\Html\FormFacade;
use Illuminate\Support\ServiceProvider;

class MacroProvider extends ServiceProvider
{
    /**
     * Bootstrap the application services.
     *
     * @return void
     */
    public function boot()
    {
        FormFacade::macro('openGroup', function ($fieldName, $errors)
        {
            return '<div class="form-group'.($errors->has($fieldName) ? ' has-error' : '').'">';
        });


        FormFacade::macro('closeGroup', function($fieldName, $errors)
        {
            $txt = '';

            if ($errors->has($fieldName))
                    $txt = '<div class="help-block">'.$errors->first($fieldName).'</div>';

            return $txt.'</div>';
        });
    }

    /**
     * Register the application services.
     *
     * @return void
     */
    public function register()
    {

    }
}
