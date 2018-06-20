<?php

use Illuminate\Http\Request;
use Zaichaopan\Breadcrumb\Breadcrumb;

class RequestTest extends TestCase
{
    /** @test */
    public function it_can_get_method_breadcrumbs_by_macroable()
    {
        $breadcrumbs = request()->breadcrumbs();
        $this->assertInstanceOf(Breadcrumb::class, $breadcrumbs);
    }
}
