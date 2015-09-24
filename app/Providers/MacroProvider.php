<?php

namespace Coverart\Providers;

use Carbon\Carbon;
use Collective\Html\FormFacade;
use Form;
use Html;
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
        Html::macro('time', function(Carbon $time){
            return '<time title="'.$time.'">'.$time->diffForHumans().'</span>';
        });

        Form::macro('openGroup', function ($fieldName, $errors, $extraClasses = '')
        {
            return '<div class="form-group'.($errors->has($fieldName) ? ' has-error' : '').' '.$extraClasses.'">';
        });

        Form::macro('closeGroup', function($fieldName, $errors, $noErrorText = null)
        {
            $msg = '';
            if ($errors->has($fieldName))
                $msg = $errors->first($fieldName);
            elseif($noErrorText)
                $msg = $noErrorText;

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
