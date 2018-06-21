<?php

namespace Zaichaopan\Breadcrumb;

use Illuminate\Http\Request;
use Illuminate\Database\Eloquent\Model;

class Link
{
    /**
     *
     * @var Illuminate\Http\Request
     */
    protected $request;

    /**
     *
     * @var string
     */
    protected $segment;

    public function __construct(Request $request, string $segment)
    {
        $this->request = $request;
        $this->segment = $segment;
    }

    public function name(): string
    {
        return $this->segment;
    }

    public function model(): ?Model
    {
        return collect($this->getRouteParameters())->first(function ($value, $key) {
            if (is_string($value)) {
                return false;
            }

            $routeKey = $value->getRouteKeyName();

            if ($routeKey === 'id') {
                return (int) $value->{$routeKey} === (int) $this->segment;
            }

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
