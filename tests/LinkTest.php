<?php

use Illuminate\Http\Request;
use Zaichaopan\Breadcrumb\Breadcrumb;

class LinkTest extends TestCase
{
    public function setUp()
    {
        parent::setUp();

        $this->request = Request::create('/categories/meat/beef', 'GET');
    }

    /** @test */
    public function it_can_get_name()
    {
        $links = $this->request->breadcrumbs()->links();

        $this->assertEquals(title_case('categories'), $links[0]->name());
        $this->assertEquals(title_case('meat'), $links[1]->name());
        $this->assertEquals(title_case('beef'), $links[2]->name());
    }

    /** @test */
    public function it_can_get_url()
    {
        $links = $this->request->breadcrumbs()->links();
        $appUrl = 'http://localhost';

        $this->assertEquals($appUrl . '/categories', $links[0]->url());
        $this->assertEquals($appUrl . '/categories/meat', $links[1]->url());
        $this->assertEquals($appUrl . '/categories/meat/beef', $links[2]->url());
    }

    /** @test */
    public function it_can_get_position()
    {
        $links = $this->request->breadcrumbs()->links();
        $this->assertEquals(0, $links[0]->position());
        $this->assertEquals(1, $links[1]->position());
        $this->assertEquals(2, $links[2]->position());
    }

    /** @test */
    public function it_can_get_model()
    {
        $category = Category::create(['name' => 'meat']);
        $product = Product::create(['name' => 'beef', 'category_id' => $category->id]);

        $mockedRequest = \Mockery::mock($this->request);
        $mockedRequest->shouldReceive('route')->andReturn((object) ['parameters' => compact('category', 'product')]);
        $mockedRequest->shouldReceive('breadcrumbs')->andReturn(new Breadcrumb($mockedRequest));

        $links = $mockedRequest->breadcrumbs()->links();

        $this->assertEquals(null, $links[0]->model());
        $this->assertEquals('Categories', $links[0]->linkText());
        $this->assertEquals($category, $links[1]->model());
        $this->assertEquals('Meat', $links[1]->linkText());
        $this->assertEquals($product, $links[2]->model());
        $this->assertEquals('Beef', $links[2]->linkText());
    }
}
