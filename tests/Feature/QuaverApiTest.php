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

    public function testMapIsOk()
    {
        $data = QuaverApi::getMap(2);
        $this->assertNotNull($data);
        $this->assertEquals('HyuN', $data['artist']);
    }
}
