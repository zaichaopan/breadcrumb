<?php

use Illuminate\Database\Eloquent\Model;
use Zaichaopan\Breadcrumb\BreadcrumbLinkInterface;

class Product extends Model implements BreadcrumbLinkInterface
{
    protected $connection = 'testbench';

    public function category()
    {
        return $this->belongsTo(Category::class);
    }

    public function linkText(): string
    {
        return $this->name;
    }

    public function getRouteKeyName()
    {
        return 'name';
    }
}
