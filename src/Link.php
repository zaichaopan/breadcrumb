<?php

namespace Zaichaopan\Breadcrumb;

use Illuminate\Http\Request;
use Illuminate\Database\Eloquent\Model;

class Link
{
    protected $request;

    protected $segment;

    public function setRequest(Request $request)
    {
        $this->request = $request;
    }

    public function setSegment(string $segment)
    {
        $this->segment = $segment;
    }

    public function name(): string
    {
        return title_case($this->segment);
    }

    public function model(): ?Model
    {
        return collect($this->getRouteParameters())->first(function ($value, $key) {
            $routeKey = $value->getRouteKeyName();
            return  $value->{$routeKey} === $this->segment;
        });
    }

    public function getRouteParameters(): ?array
    {
        return $this->request->route()->parameters;
    }

    public function linkText(): string
    {
        return title_case(optional($this->model())->linkText() ?? $this->name());
    }

    public function url(): string
    {
        return url(implode(array_slice($this->request->segments(), 0, $this->position() + 1), '/'));
    }

    public function position(): ?int
    {
        return array_search($this->segment, $this->request->segments());
    }
}
