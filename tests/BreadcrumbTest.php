<?php

use Illuminate\Http\Request;
use Zaichaopan\Breadcrumb\Link;

class BreadcrumbTest extends TestCase
{
    /** @test */
    public function it_can_links()
    {
        $request = Request::create('/category/meat/beef', 'GET');
        $links = $request->breadcrumb()->links();
        $this->assertInternalType('array', $links);

        foreach ($links as $link) {
            $this->assertInstanceOf(Link::class, $link);
        }
    }
}
