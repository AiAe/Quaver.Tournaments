<?php

namespace Tests\Feature;

use App\Models\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

class SeederTest extends TestCase
{
    use RefreshDatabase;

    public function testSeedWithoutErrors()
    {
        $this->seed();
        $this->assertGreaterThan(5, User::count());
    }
}
