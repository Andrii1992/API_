<?php

namespace Tests\Feature;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\DatabaseMigrations;
use Illuminate\Foundation\Testing\WithFaker;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use App\Models\Posts;
use App\Models\User;
use Tests\TestCase;

class UsersTest extends TestCase
{
  use DatabaseMigrations;
  /**
   * A basic feature test example.
   *
   * @return void
   */
  /** @test */
  public function test_a_user_cannot_browse_users()
  {
    $this->signInUser();
    $this->get('/admin/uzytkowniki')->assertStatus(403);
    $this->get('/admin/uzytkowniki/nowy')->assertStatus(403);
    $this->post('/admin/uzytkowniki/nowy')->assertStatus(403);
    $this->get('/admin/uzytkowniki/usun/1')->assertStatus(403);
    $this->get('/admin/uzytkowniki/edycja/1')->assertStatus(403);
    $this->post('/admin/uzytkowniki/edycja')->assertStatus(403);
  }

  /** @test */
  public function guest_cannot_manage_users()
  {
    $this->get('/admin/uzytkowniki')->assertStatus(403);
    $this->get('/admin/uzytkowniki/nowy')->assertStatus(403);
    $this->post('/admin/uzytkowniki/nowy')->assertStatus(403);
    $this->get('/admin/uzytkowniki/usun/1')->assertStatus(403);
    $this->get('/admin/uzytkowniki/edycja/1')->assertStatus(403);
    $this->post('/admin/uzytkowniki/edycja')->assertStatus(403);
  }
  /** @test */
  public function admin_can_manage_users()
  {
    $this->signInAdmin();
    $users = User::factory()->count(3)->make();
    $this->get('/admin/uzytkowniki')->assertStatus(200);
    $this->get('/admin/uzytkowniki/nowy')->assertStatus(200);
    $this->post(
      '/admin/uzytkowniki/nowy',
      [
        'name' => $users[0]->name,
        'email' => $users[0]->email,
        'password' => $users[0]->password,
        'password_confirmation' => $users[0]->password,
      ]
    )->assertStatus(302);
    $this->get('/admin/uzytkowniki')->assertSee($users[0]->name);
    $this->get('/admin/uzytkowniki/edycja/1')->assertStatus(200);
    $this->post(
      '/admin/posty/edycja/',
      [
        'name' => 'test',
        'email' => $users[0]->email
      ]
    )->assertStatus(302);
    $this->get('/admin/uzytkowniki')->assertSee('test');
    $this->get('/admin/uzytkowniki/usun/1')->assertStatus(302);
  }
}
