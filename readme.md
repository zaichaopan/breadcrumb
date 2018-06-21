# Breadcrumb

This package allows you to add dynamic breadcrumb to your laravel app. It can be used in laravel 5.5 or higher.

## Installation

```bash
composer require zaichaopan/breadcrumb
```

## Usage

* Implement __BreadcrumbLinkInterface__ in your eloquent model which you want to use to generate breadcrumb.

To better understand how to use this package. Consider the following example: your app can list different products which may belong to different categories.

```php
// web.php
Route::get('/categories/{category}/products/{product}', 'ProductsController@show');
```

```php
// ...
class ProductsController extends Controller
{
    public function show(Category $category, Product $product)
    {
        // ...
        return view('product.show', compact('product'));
    }
}
```

To generate the breadcrumb link in the __products.show__ view. You need to implement the __BreadcrumbLinkInterface__ in your __Category__ and __Product__ model.

There is only one method in the __BreadcrumbLinkInterface__ : __LinkText__. It is used to define the text of the link when generating the breadcrumb. This package needs to know it because you may have model id in the url or you may replace the id with uuid or slug in the url. We don't want to use any one of them for the text for the url when generating the breadcrumb.

To implement the interface in the model:

```php
// Category.php
class Category extends Model implements BreadcrumbLinkInterface
{
    public function linkText() : string
    {
        // you want to display category name in the breadcrumb link
        return $this->name;
    }
}
```

```php
// Product.php
class Product extends Model implements BreadcrumbLinkInterface
{

    public function linkText(): string
    {
         // you want to display product name in the breadcrumb link
        return $this->name;
    }
}
```

* Include breadcrumb nav link in the view

This package provides a default bootstrap4-style breadcrumb nav partial view.


To include in your __products.show__ view:

```html
@include('breadcrumb::_nav')
```

If you want to customize the breadcrumb nav. You can publish the view.

```bash
php artisan vendor:publish
```

Then choose the provider: __Zaichaopan\Breadcrumb\BreadcrumbServiceProvider__

That is all you need to do to use this package.
