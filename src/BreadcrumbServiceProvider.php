<?php

namespace Zaichaopan\Breadcrumb;

use Illuminate\Http\Request;
use Illuminate\Support\ServiceProvider;

class BreadcrumbServiceProvider extends ServiceProvider
{
    public function boot()
    {
        $this->loadViewsFrom(__DIR__ . '/views', 'breadcrumb');

        $this->publishes([
            __DIR__ . '/views' => resource_path('views/vendor/breadcrumb'),
        ]);

        Request::macro('breadcrumb', function () {
            return new Breadcrumb($this);
        });
    }
}
