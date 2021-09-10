<?php

namespace Kxk911\Digittorussianstring;

use Illuminate\Support\ServiceProvider;

class DigittorussianstringServiceProvider extends ServiceProvider
{
    /**
     * Register services.
     *
     * @return void
     */
    public function register()
    {
        $this->app->make('Kxk911\Digittorussianstring\Digittorussianstring');
    }

    /**
     * Bootstrap services.
     *
     * @return void
     */
    public function boot()
    {
        //
    }
}
