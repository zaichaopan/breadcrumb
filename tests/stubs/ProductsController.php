<?php

use Illuminate\Routing\Controller;

class ProductsController extends Controller
{
    public function index(Category $category)
    {
        return view('_nav');
    }

    public function show(Category $category, Product $product)
    {
        return view('_nav');
    }
}
