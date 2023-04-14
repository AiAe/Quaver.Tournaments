<?php

namespace Tests;

use App\Http\Middleware\Authenticated;
use App\Http\Middleware\Tournament;
use App\Models\User;
use Illuminate\Foundation\Testing\TestCase as BaseTestCase;

abstract class TestCase extends BaseTestCase
{
    use CreatesApplication;

    protected function setUp(): void
    {
        parent::setUp();
        $this->withoutVite();
        $this->withMiddleware([Authenticated::class, Tournament::class]);

        // Disables observer
        User::unsetEventDispatcher();
    }
}
