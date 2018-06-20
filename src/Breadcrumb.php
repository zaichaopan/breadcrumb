<?php

namespace Zaichaopan\Breadcrumb;

use Illuminate\Http\Request;

class Breadcrumb
{
    protected $request;

    public function __construct(Request $request)
    {
        $this->request = $request;
    }

    public function links()
    {
        return collect($this->request->segments())->map(function ($segment) {
            return new Link($this->request, $segment);
        })->toArray();
    }
}
