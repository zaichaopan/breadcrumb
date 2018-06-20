<?php

use Illuminate\Http\Request;
use Zaichaopan\Breadcrumb\Breadcrumb;

class LinkTest extends TestCase
{
    const BASE_URL = 'http://localhost';

    public function setUp()
    {
        parent::setUp();

        $this->request = Request::create('/categories/meat/products/beef', 'GET');
    }

    /** @test */
    public function it_can_get_name()
    {
        $links = $this->request->breadcrumb()->links();

        $this->assertEquals(title_case('categories'), $links[0]->name());
        $this->assertEquals(title_case('meat'), $links[1]->name());
        $this->assertEquals(title_case('products'), $links[2]->name());
        $this->assertEquals(title_case('beef'), $links[3]->name());
    }

    /** @test */
    public function it_can_get_url()
    {
        $links = $this->request->breadcrumb()->links();

        $this->assertEquals(static::BASE_URL . '/categories', $links[0]->url());
        $this->assertEquals(static::BASE_URL . '/categories/meat', $links[1]->url());
        $this->assertEquals(static::BASE_URL . '/categories/meat/products', $links[2]->url());
        $this->assertEquals(static::BASE_URL . '/categories/meat/products/beef', $links[3]->url());
    }

    /** @test */
    public function it_can_get_position()
    {
        $links = $this->request->breadcrumb()->links();
        $this->assertEquals(0, $links[0]->position());
        $this->assertEquals(1, $links[1]->position());
        $this->assertEquals(2, $links[2]->position());
        $this->assertEquals(3, $links[3]->position());
    }

    /** @test */
    public function it_can_get_model()
    {
        $category = Category::create(['name' => 'meat']);
        $product = Product::create(['name' => 'beef', 'category_id' => $category->id]);
        $mockedRequest = \Mockery::mock($this->request);
        $mockedRequest->shouldReceive('route')->andReturn((object) ['parameters' => [
            'categories' => 'categories',
            'category' => $category,
            'products' => 'products',
            'product' => $product
        ]]);
        $mockedRequest->shouldReceive('breadcrumb')->andReturn(new Breadcrumb($mockedRequest));
        $links = $mockedRequest->breadcrumb()->links();

        $this->assertEquals(null, $links[0]->model());
        $this->assertEquals('Categories', $links[0]->linkText());
        $this->assertEquals($category, $links[1]->model());
        $this->assertEquals('Meat', $links[1]->linkText());
        $this->assertEquals(null, $links[2]->model());
        $this->assertEquals('Products', $links[2]->linkText());
        $this->assertEquals($product, $links[3]->model());
        $this->assertEquals('Beef', $links[3]->linkText());
    }
}
