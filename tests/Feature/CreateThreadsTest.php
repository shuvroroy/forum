<?php

namespace Tests\Feature;

use Tests\TestCase;
use Illuminate\Foundation\Testing\WithFaker;
use Illuminate\Foundation\Testing\RefreshDatabase;

class CreateThreadsTest extends TestCase
{
    use RefreshDatabase;
    
    /** @test */
    function guest_may_not_create_threads()
    {
        $this->expectException('Illuminate\Auth\AuthenticationException');

        $thread = factory('App\Models\Thread')->make();

        $this->post('/threads', $thread->toArray());

        $this->withoutExceptionHandling()->get('/threads/create')
            ->assertRedirect('/login');
    }
    
    /** @test */
    function an_authenticated_user_can_create_new_forum_threads()
    {
       $this->be($user = factory('App\Models\User')->create());

        $thread = factory('App\Models\Thread')->make();

        $response = $this->post('/threads', $thread->toArray());

        $this->get($response->headers->get('Location'))
            ->assertSee($thread->title)
            ->assertSee($thread->body);
    }

    /** @test */
    function a_thread_requires_a_title()
    {
        $this->publishThread(['title' => null])
            ->assertSessionHasErrors('title');
    }

    /** @test */
    function a_thread_requires_a_body()
    {
        $this->publishThread(['body' => null])
            ->assertSessionHasErrors('body');
    }

    /** @test */
    function a_thread_requires_a_valid_channel()
    {
        factory('App\Models\Channel', 2)->create();

        $this->publishThread(['channel_id' => null])
            ->assertSessionHasErrors('channel_id');

        $this->publishThread(['channel_id' => 999])
            ->assertSessionHasErrors('channel_id');
    }

    /** @test */
    function guest_cannot_delete_threads()
    {
        $thread = factory('App\Models\Thread')->create();

        $this->delete($thread->path())
            ->assertRedirect('/login');
    }

    /** @test */
    function threads_may_only_be_deleted_by_those_who_have_permission()
    {
        // TODO:
    }

    /** @test */
    function a_thread_can_be_deleted()
    {
        $this->be($user = factory('App\Models\User')->create());

        $thread = factory('App\Models\Thread')->create();
        $reply = factory('App\Models\Reply')->create(['thread_id' => $thread->id]);

        $this->json('DELETE', $thread->path())
            ->assertStatus(204);

        $this->assertDatabaseMissing('threads', ['id' => $thread->id]);
        $this->assertDatabaseMissing('replies', ['id' => $reply->id]);
    }

    public function publishThread($overrides = [])
    {
        $this->be($user = factory('App\Models\User')->create());

        $thread = factory('App\Models\Thread')->make($overrides);

        return $this->post('/threads', $thread->toArray());
    }
}
