<?php

namespace App\Http\Controllers;

use App\Models\Thread;

class RepliesController extends Controller
{
    /**
     * RepliesController constructor.
     */
    public function __construct()
    {
        $this->middleware('auth');
    }

    public function store(Thread $thread)
    {
        $thread->addReply([
            'user_id' => auth()->id(),
            'body' => request('body')
        ]);

        return back();
    }
}
