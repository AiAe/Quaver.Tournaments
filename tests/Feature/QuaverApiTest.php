<?php

namespace Tests\Feature;

use App\Http\QuaverApi\QuaverApi;
use Tests\TestCase;

class QuaverApiTest extends TestCase
{
    public function testUserFullIsOk()
    {
        $data = QuaverApi::getUserFull(1);
        $this->assertNotNull($data);
        $this->assertEquals('Swan', $data['info']['username']);
    }
}
