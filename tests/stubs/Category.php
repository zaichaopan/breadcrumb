<?php

use Illuminate\Database\Eloquent\Model;
use Zaichaopan\Breadcrumb\BreadcrumbLinkInterface;

class Category extends Model implements BreadcrumbLinkInterface
{
    protected $connection = 'testbench';

    public function products()
    {
        return $this->hasMany(Product::class);
    }

    public function getRouteKeyName()
    {
        return 'name';
    }

    public function linkText() : string
    {
        return $this->name;
    }
}
