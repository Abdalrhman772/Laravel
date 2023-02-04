<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Post;
use App\Models\User;
use App\http\Requests\StorePostRequest;

class PostController extends Controller
{

    public function index()
    {
        $selectedPost = Post::paginate(6);
        return view('posts.index', [
            'posts' => $selectedPost,
        ]);
    }


    public function create()
    {
        $users = User::get();
        return view('posts.create', ['users' => $users]);
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
        $users = User::get();
        $selectedPost = Post::find($postId);

        return view('posts.edit', [
            'post' => $selectedPost,
            'users' => $users
        ]);
    }


    public function update($postId, Request $request)
    {
        $selectedPost = Post::find($postId);
        if (!$selectedPost) {
            return to_route(route: 'posts.index');
        }
        $selectedPost->title = $request->title;
        $selectedPost->description = $request->description;
        $selectedPost->user_id = $request->post_creator;
        $selectedPost->save();
        return to_route(route: 'posts.index');
    }

    //*store -- insert into db
    public function store()
    {
        $title = request()->title;
        $description = request()->description;
        $userId = request()->post_creator;

        Post::create([
            'title' => $title,
            'description' => $description,
            'user_id' => $userId
        ]);
        return to_route('posts.index');
    }

    //*destroy 
    public function destroy($postId)
    {
        $selectedPost = Post::find($postId);
        if (!$selectedPost) {
            return to_route('posts.index');
        }
        $selectedPost->forceDelete();
        return to_route('posts.index');
    }
}
