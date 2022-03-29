<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;
use Collective\Html\FormFacade as Form;

class FormServiceProvider extends ServiceProvider
{
    /**
     * Register services.
     *
     * @return void
     */
    public function register()
    {
        //return;
    }

    /**
     * Bootstrap services.
     *
     * @return void
     */
    public function boot()
    {
        //Register the form components
        Form::component('bsText', 'components.form.text', ['name', 'value' => null, 'attributes' => []]);
        Form::component("bsSelect", 'components.form.select', ['name', 'value' => null, 'attributes' => []]);
    }
}
