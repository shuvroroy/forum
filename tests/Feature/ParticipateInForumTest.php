<?php

namespace Tests\Feature;

use Tests\TestCase;
use Illuminate\Foundation\Testing\WithFaker;
use Illuminate\Foundation\Testing\RefreshDatabase;

class ParticipateInForumTest extends TestCase
{
    use RefreshDatabase;

    protected $thread;

    protected function setUp()
    {
        parent::setUp();

        $this->thread = factory('App\Models\Thread')->create();
    }

    /** @test */
    function an_unauthenticated_user_may_not_participate_in_forum_threads()
    {
        $this->withoutExceptionHandling();

        $this->expectException('Illuminate\Auth\AuthenticationException');
        
        $this->post("/threads/foo/1/replies", []);
    }

    /** @test */
    function an_authenticated_user_may_participate_in_forum_threads()
    {
        $this->actingAs($user = factory('App\Models\User')->create());

        $reply = factory('App\Models\Reply')->make();

        $this->post($this->thread->path(). '/replies', $reply->toArray());

        $this->get($this->thread->path())
            ->assertSee($reply->body);
    }

    /** @test */
    function a_replies_requires_a_body()
    {
        $this->actingAs($user = factory('App\Models\User')->create());

        $reply = factory('App\Models\Reply')->make(['body' => null]);

        $this->post($this->thread->path(). '/replies', $reply->toArray())
            ->assertSessionHasErrors('body');
    }
}
