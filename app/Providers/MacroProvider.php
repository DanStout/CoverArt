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
        FormFacade::macro('openGroup', function ($fieldName, $errors, $extraClasses = '')
        {
            return '<div class="form-group'.($errors->has($fieldName) ? ' has-error' : '').' '.$extraClasses.'">';
        });

        FormFacade::macro('closeGroup', function($fieldName, $errors, $noErrorText = null)
        {

            if ($errors->has($fieldName))
                $msg = $errors->first($fieldName);
            elseif($noErrorText)
                $msg = $noErrorText;
            else return '</div>';

            return '<div class="help-block">'.$msg.'</div></div>';
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
