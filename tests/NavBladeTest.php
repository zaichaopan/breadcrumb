<?php

class NavBladeTest extends TestCase
{
    public function setUp()
    {
        parent::setUp();

        $this->defineRoute();
        $this->category = Category::create(['name' => 'meat']);
        $this->product = Product::create(['name' => 'beef', 'category_id' => $this->category->id]);
    }

    /** @test */
    public function it_can_show_correct_breadcrumb_links()
    {
        $response = $this->get('/categories/meat/products');
        $content = $response->content();
        $this->assertRegexp('/<a href="http:\/\/localhost\/categories">Categories<\/a>/', $content);
        $this->assertRegexp('/<a href="http:\/\/localhost\/categories\/meat">Meat<\/a>/', $content);
        $this->assertRegexp('/<a href="http:\/\/localhost\/categories\/meat\/products">Products<\/a>/', $content);

        $response = $this->get('/categories/meat/products/beef');
        $content = $response->content();
        $this->assertRegexp('/<a href="http:\/\/localhost\/categories">Categories<\/a>/', $content);
        $this->assertRegexp('/<a href="http:\/\/localhost\/categories\/meat">Meat<\/a>/', $content);
        $this->assertRegexp('/<a href="http:\/\/localhost\/categories\/meat\/products">Products<\/a>/', $content);
        $this->assertRegexp('/<a href="http:\/\/localhost\/categories\/meat\/products\/beef">Beef<\/a>/', $content);
    }

    protected function defineRoute()
    {
        $this->app['router']->get(
            '/categories/{category}/products',
            ['uses' => 'ProductsController@index']
        );

        $this->app['router']->get(
            '/categories/{category}/products/{product}',
            ['uses' => 'ProductsController@show']
        );
    }
}
