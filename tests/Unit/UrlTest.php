<?php

namespace Tests\Unit;

use App\Helpers\UrlHelper;
use PHPUnit\Framework\TestCase;

class UrlTest extends TestCase
{
    /**
     * A basic unit test example.
     *
     * @return void
     */
    public function test_url_exist()
    {
        $this->assertTrue(UrlHelper::verifyUrlExists('www.google.com'));
        $this->assertTrue(UrlHelper::verifyUrlExists('https://www.facebook.com'));
        $this->assertTrue(UrlHelper::verifyUrlExists('https://laravel.com/'));
        $this->assertFalse(UrlHelper::verifyUrlExists('https://asdfsadf.com.asdf/'));
    }

}
