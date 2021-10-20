<?php

namespace Tests\Feature;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\DatabaseMigrations;
use Illuminate\Foundation\Testing\WithFaker;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use App\Models\Posts;
use App\Models\User;
use Tests\TestCase;

class PostsTest extends TestCase
{
  use DatabaseMigrations;
  /**
   * A basic feature test example.
   *
   * @return void
   */
  /** @test */
  public function test_a_guest_can_browse_home()
  {
    $this->get('/')->assertStatus(200);
  }
  /** @test */
  public function test_a_guest_can_browse_posts()
  {
    $response = $this->get('/api/blog');
    $response->assertStatus(200);
  }

  /** @test */
  public function guest_cannot_manage_posts()
  {
    $post = Posts::factory()->count(3)->make();
    $this->get('/admin')->assertStatus(403);
    $this->get('/admin/posty/usun/1')->assertStatus(403);
    $this->get('/admin/posty/edycja/1')->assertStatus(403);
    $this->post('/admin/posty/edycja')->assertStatus(403);
    $this->get('/admin/posty/nowypost')->assertStatus(403);
    $this->post('/admin/posty/nowypost')->assertStatus(403);
  }
  /** @test */
  public function user_can_manage_posts()
  {
    $this->signInUser();
    $this->get('/admin')->assertStatus(200);
    $this->get('/admin/posty')->assertStatus(200);
    $post = Posts::factory()->count(50)->make();
    $this->get('/admin/posty/nowypost')->assertStatus(200);
    $this->post(
      '/admin/posty/nowypost',
      [
        'title' => $post[0]->title,
        'content' => $post[0]->content,
        'excerpt' => $post[0]->excerpt,
        'type' => $post[0]->type,
      ]
    )->assertStatus(302);    
    $this->get('/admin/posty')->assertSee($post[0]->title);
    $this->get('/admin/posty/edycja/1')->assertStatus(200);
    $this->post(
      '/admin/posty/edycja/',
      [
        'id' => '1',
        'title' => 'test',
        'content' => $post[0]->content,
        'excerpt' => $post[0]->excerpt,
        'type' => $post[0]->type,
      ]
    )->assertStatus(302);
    $this->get('/admin/posty/usun/1')->assertStatus(302);
  }

  /** @test */
  public function admin_can_manage_posts()
  {
    $this->signInAdmin();;
    $this->get('/admin')->assertStatus(200);
    $this->get('/admin/posty')->assertStatus(200);
    $post = Posts::factory()->count(50)->make();
    $this->get('/admin/posty/nowypost')->assertStatus(200);
    $this->post(
      '/admin/posty/nowypost',
      [
        'title' => $post[0]->title,
        'content' => $post[0]->content,
        'excerpt' => $post[0]->excerpt,
        'type' => $post[0]->type,
      ]
    )->assertStatus(302);
    $this->get('/admin/posty')->assertSee($post[0]->title);
    $this->get('/admin/posty/edycja/1')->assertStatus(200);
    $this->post(
      '/admin/posty/edycja/',
      [
        'id' => '1',
        'title' => 'test',
        'content' => $post[0]->content,
        'excerpt' => $post[0]->excerpt,
        'type' => $post[0]->type,
      ]
    )->assertStatus(302);
    $this->get('/admin/posty/usun/1')->assertStatus(302);
  }
}
