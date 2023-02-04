<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Resources\PostResource;
use Illuminate\Http\Request;
use App\Models\Post;


class PostController extends Controller
{
    public function index()
    {
        $posts = Post::all();
        return PostResource::collection($posts);
    }



    public function show($postId)
    {
        $post = Post::find($postId);
        return new PostResource($post);
    }



    public function store()
    {
        $title = request()->title;
        $description = request()->description;
        $userId = request()->post_creator;

        $post = Post::create([
            'title' => $title,
            'description' => $description,
            'user_id' => $userId
        ]);
        return $post;
    }
}
