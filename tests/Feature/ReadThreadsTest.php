<?php

namespace Tests\Feature;

use Tests\TestCase;
use Illuminate\Foundation\Testing\RefreshDatabase;

class ReadThreadsTest extends TestCase
{
    use RefreshDatabase;

    protected $thread;

    public function setUp()
    {
        parent::setUp();

        $this->thread = factory('App\Models\Thread')->create();
    }

    /** @test */
    function a_user_can_view_all_threads()
    {
        $this->get('/threads')
            ->assertSee($this->thread->title)
            ->assertStatus(200);
    }

    /** @test */
    function a_user_can_read_a_single_thread()
    {
        $this->get($this->thread->path())
            ->assertSee($this->thread->title)
            ->assertSee($this->thread->body)
            ->assertStatus(200);
    }

    /** @test */
    function a_user_can_read_replies_that_are_associated_with_a_thread()
    {
        $reply = factory('App\Models\Reply')
            ->create(['thread_id' => $this->thread->id]);

        $this->get($this->thread->path())
            ->assertSee($reply->body);
    }

    /** @test */
    function a_user_can_filter_threads_according_to_a_channel()
    {
        $channel = factory('App\Models\Channel')->create();
        $threadInChannel = factory('App\Models\Thread')->create(['channel_id' => $channel->id]);
        $threadNotInChannel = factory('App\Models\Thread')->create();

        $this->get('/threads/'. $channel->slug)
            ->assertSee($threadInChannel->title)
            ->assertDontSee($threadNotInChannel->title);
    }

    /** @test */
    function a_user_can_filter_threads_by_any_username()
    {
        $this->be($user = factory('App\Models\User')->create(['name' => 'JohnDoe']));

        $threadByJohn = factory('App\Models\Thread')->create(['user_id' => $user->id]);
        $threadNotByJohn = $this->thread;

        $this->get('/threads?by=JohnDoe')
            ->assertSee($threadByJohn->title)
            ->assertDontSee($threadNotByJohn->title);
    }

    /** @test */
    function a_user_can_filter_threads_by_popularity()
    {
        $threadWithTwoReplies = factory('App\Models\Thread')->create();
        factory('App\Models\Reply', 2)->create(['thread_id' => $threadWithTwoReplies->id]);

        $threadWithThreeReplies = factory('App\Models\Thread')->create();
        factory('App\Models\Reply', 3)->create(['thread_id' => $threadWithThreeReplies->id]);

        $threadWithNoReplies = $this->thread;

        $response = $this->getJson('/threads?popularity=1')->json();

        $this->assertEquals([3, 2, 0], array_column($response, 'replies_count'));
    }
}
