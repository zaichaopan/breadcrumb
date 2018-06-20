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
            $link = app()->make(Link::class);
            $link->setSegment($segment);
            $link->setRequest($this->request);
            return $link;
        })->toArray();
    }
}
