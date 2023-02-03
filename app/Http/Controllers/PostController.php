<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Post;
use App\http\Requests\StorePostRequest;

class PostController extends Controller
{

    public function index()
    {
        $allPosts = Post::all();
        return view('posts.index', [
            'posts' => $allPosts,
        ]);
    }


    public function create()
    {
        return view('posts.create');
    }

    //*show
    public function show($postId)
    {
        $selectedPost = Post::find($postId);
        return view('posts.show', [
            'post' => $selectedPost
        ]);
    }

    //*edit
    public function edit($postId)
    {



        $title = request()->title;
        $description = request()->description;

        Post::where('id', $postId)->update([
            'title' => $title,
            'description' => $description
        ]);
        $selectedPost = Post::find($postId);

        return view('posts.edit', [
            'post' => $selectedPost
        ]);
    }

    //*store -- insert into db
    public function store()
    {
        $title = request()->title;
        $description = request()->description;

        Post::create([
            'title' => $title,
            'description' => $description
        ]);
        return to_route('posts.index');
    }
}
