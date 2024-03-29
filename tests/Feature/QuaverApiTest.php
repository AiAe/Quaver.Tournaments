<?php

/** @noinspection PhpUnhandledExceptionInspection */

namespace Tests\Feature;

use App\Http\QuaverApi\QuaverApi;
use Exception;
use Tests\TestCase;

class QuaverApiTest extends TestCase
{
    public function testUserFullIsOk()
    {
        $data = QuaverApi::getUserFull(1);
        $this->assertEquals('Swan', $data['info']['username']);
    }

    public function testMapIsOk()
    {
        $data = QuaverApi::getMap(2);
        $this->assertEquals('HyuN', $data['artist']);
    }

    public function testMapsetIsOk()
    {
        $data = QuaverApi::getMapset(2);
        $this->assertEquals('HyuN', $data['artist']);
    }

    public function testRankedMapsetsIsOk()
    {
        $data = QuaverApi::getRankedMapsetIds();
        $this->assertEquals(2, $data[0]);
    }

    public function testExceptionThrown()
    {
        $this->expectException(Exception::class);
        QuaverApi::getMap(-1);
        $this->expectException(Exception::class);
        QuaverApi::getUserFull(-1);
    }
}
