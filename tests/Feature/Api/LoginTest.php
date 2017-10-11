<?php

namespace Tests\Feature\Api;

use Dingo\Api\Routing\UrlGenerator;
use Illuminate\Foundation\Testing\DatabaseMigrations;
use Tests\TestCase;

class LoginTest extends TestCase
{
    use DatabaseMigrations;
    /**
     * A basic test example.
     *
     * @return void
     */
    public function testAccessToken()
    {
        // User admin already created in migration
        $urlGenerator = app(UrlGenerator::class)->version('v1');

        $this
            ->post($urlGenerator->route('api.access_token'),[
                'email' => 'admin@user.com',
                'password' => 'secret'
            ])
            ->assertStatus(200)
            ->assertJsonStructure(['token']);
    }
}
