<?php

namespace Tests\Feature;

use Tests\TestCase;
use Illuminate\Foundation\Testing\RefreshDatabase;

class ThreadTest extends TestCase
{
    use RefreshDatabase;

    /** @test */
    function a_user_can_view_all_threads()
    {
        $thread = factory('App\Models\Thread')->create();

        $this->get('/threads')
            ->assertSee($thread->title)
            ->assertStatus(200);
    }

    /** @test */
    function a_user_can_read_a_single_thread()
    {
        $thread = factory('App\Models\Thread')->create();

        $this->get('/threads/' . $thread->id)
            ->assertSee($thread->title)
            ->assertSee($thread->body)
            ->assertStatus(200);
    }
}
