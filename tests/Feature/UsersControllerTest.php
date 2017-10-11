<?php

namespace Tests\Feature;

use Tests\TestCase;
use Illuminate\Foundation\Testing\WithoutMiddleware;
use Illuminate\Foundation\Testing\DatabaseMigrations;
use Illuminate\Foundation\Testing\DatabaseTransactions;

class UsersControllerTest extends TestCase
{
    /**
     * A basic test example.
     *
     * @return void
     */
    public function testIfUserDoesntSeeUserList()
    {
        $this->get(route('admin.users.index'))
            ->assertRedirect(route('admin.login'))
            ->assertStatus(302);
    }
}
