<?php

use Illuminate\Routing\Controller;

class ProductsController extends Controller
{
    public function index(Category $category)
    {
        return view('_breadcrumb');
    }

    public function show(Category $category, Product $product)
    {
        return view('_breadcrumb');
    }
}
