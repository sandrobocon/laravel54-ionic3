<?php

namespace Tests\Browser;

use Tests\DuskTestCase;
use Laravel\Dusk\Browser;
use Illuminate\Foundation\Testing\DatabaseMigrations;

class LoginTest extends DuskTestCase
{
    use DatabaseMigrations;
    /**
     * A Dusk test example.
     *
     * @return void
     */
    public function testLoginFailed()
    {
        // Login failed
        $this->browse(function (Browser $browser) {
            $browser->visit('/admin/login')
                    ->type('email','user@test.com')
                    ->type('password','xxxxxxxx')
                    ->press('Login')
                    ->assertSee('Login');
        });

        // Login Success
        $this->browse(function (Browser $browser) {
            $browser->visit('/admin/login')
                ->type('email','admin@user.com')
                ->type('password','secret')
                ->press('Login')
                ->assertPathIs('/admin/dashboard')
                ->assertSee('administrativa');
        });
    }
}
