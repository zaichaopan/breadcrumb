<?php

namespace Zaichaopan\Breadcrumb;

use Illuminate\Http\Request;
use Illuminate\Support\ServiceProvider;

class BreadcrumbServiceProvider extends ServiceProvider
{
    public function boot()
    {
        Request::macro('breadcrumbs', function () {
            return new Breadcrumb($this);
        });
    }
}
