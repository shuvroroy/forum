<?php

namespace App\Http\Controllers;

use App\Models\Favorite;
use App\Models\Reply;

class FavoritesController extends Controller
{

    /**
     * FavoritesController constructor.
     */
    public function __construct()
    {
        return $this->middleware('auth');
    }

    public function store(Reply $reply)
    {
        return $reply->favorite();
    }
}
