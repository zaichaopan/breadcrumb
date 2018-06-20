<?php

use Illuminate\Routing\Controller;

class ProductsController extends Controller
{
    public function show(Category $category, Product $product)
    {
        return view('_breadcrumbs');
    }
}
