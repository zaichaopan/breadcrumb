<?php
use Zaichaopan\Breadcrumb\BreadcrumbServiceProvider;

abstract class TestCase extends Orchestra\Testbench\TestCase
{
    protected function getPackageProviders($app)
    {
        return [BreadcrumbServiceProvider::class];
    }

    public function setUp()
    {
        parent::setUp();
        Eloquent::unguard();
        $this->artisan('migrate', [
            '--database' => 'testbench'
        ]);
    }

    public function tearDown()
    {
        \Schema::drop('categories');
        \Schema::drop('products');
    }

    protected function getEnvironmentSetUp($app)
    {
       // $app['config']->set('url', 'http:://breadcrumbs.com');
        $app['config']->set('database.default', 'testbench');
        $app['config']->set('database.connections.testbench', [
            'driver' => 'sqlite',
            'database' => ':memory:',
            'prefix' => '',
        ]);

        $app['config']->set('view.paths', [__DIR__ . '/../src/views']);

        \Schema::create('categories', function ($table) {
            $table->increments('id');
            $table->string('name');
            $table->timestamps();
        });

        \Schema::create('products', function ($table) {
            $table->increments('id');
            $table->string('name');
            $table->unsignedInteger('category_id');
            $table->foreign('category_id')->on('id')->references('categories');
            $table->timestamps();
        });
    }
}
