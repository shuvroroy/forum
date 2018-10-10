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
    }
    
    /** @test */
    function an_authenticated_user_can_create_new_forum_threads()
    {
       $this->be($user = factory('App\Models\User')->create());

        $thread = factory('App\Models\Thread')->make();

        $this->post('/threads', $thread->toArray());

        $this->get($thread->path())
            ->assertSee($thread->title);
    }
}
