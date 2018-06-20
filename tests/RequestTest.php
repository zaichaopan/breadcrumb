<?php

use Illuminate\Http\Request;
use Zaichaopan\Breadcrumb\Breadcrumb;

class RequestTest extends TestCase
{
    /** @test */
    public function it_can_get_method_breadcrumb_by_macroable()
    {
        $breadcrumb = request()->breadcrumb();
        $this->assertInstanceOf(Breadcrumb::class, $breadcrumb);
    }
}
