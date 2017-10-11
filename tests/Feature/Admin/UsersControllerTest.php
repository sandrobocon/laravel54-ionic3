<?php

namespace Tests\Feature;

use CodeFlix\Models\User;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Foundation\Testing\DatabaseMigrations;
use Tests\TestCase;

class UsersControllerTest extends TestCase
{
    use DatabaseMigrations;
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

    public function testIfUserSeeUserList()
    {
        Model::unguard();
        $user = factory(User::class)
            ->states('admin')
            ->create(['verified'=>true]);

        $this->actingAs($user)
            ->get(route('admin.users.index'))
            ->assertSee('Listagem de usuários')
            ->assertStatus(200);
    }
}
