<?php

namespace Tests\Browser;

use CodeFlix\Models\User;
use Illuminate\Foundation\Testing\DatabaseMigrations;
use Laravel\Dusk\Browser;
use Tests\DuskTestCase;

class CategoryTest extends DuskTestCase
{
    use DatabaseMigrations;

    /**
     * A Dusk test example.
     *
     * @return void
     */
    public function testCRUD()
    {
        $user = User::where('email','=','admin@user.com')->first();

        $this->browse(function (Browser $browser) use($user) {
            $browser->loginAs($user)
                ->visit(route('admin.categories.index'))
                ->assertSee('Listagem de categorias')
                ->clickLink('Nova Categoria')
                ->assertSee('Nome categoria')
                ->type('name','testCreate')
                    ->click('button[type=submit]')
                ->assertSee('Listagem de categorias')
                ->assertSee('testCreate');
        });

        $this->categoryUpdate();
        $this->categoryShow();
        $this->categoryDelete();
    }

    protected function categoryUpdate()
    {
        $user = User::where('email','=','admin@user.com')->first();

        $this->browse(function (Browser $browser) use($user) {
            $browser->loginAs($user)
                ->visit(route('admin.categories.edit',['category'=>1]))
                ->assertSee('Editar categoria')
                ->type('name','UpdateTestCategory')
                ->click('button[type=submit]')
                ->assertSee('Listagem de categorias')
                ->assertSee('UpdateTestCategory');
        });
    }

    protected function categoryShow()
    {
        $user = User::where('email','=','admin@user.com')->first();

        $this->browse(function (Browser $browser) use($user) {
            $browser->loginAs($user)
                ->visit(route('admin.categories.show',['category'=>1]))
                ->assertSee('Dados categoria')
                ->assertSee('UpdateTestCategory');
        });
    }

    protected function categoryDelete()
    {
        $user = User::where('email','=','admin@user.com')->first();

        $this->browse(function (Browser $browser) use($user) {
            $browser->loginAs($user)
                ->visit(route('admin.categories.show',['category'=>1]))
                ->click('.btn-danger')
                ->assertSee('Categoria removida')
                ->assertDontSee('UpdateTestCategory');
        });
    }
}
