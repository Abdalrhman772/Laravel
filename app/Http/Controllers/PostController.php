<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Validation\Rule;
use App\Models\Post;
use App\Models\User;
use App\Models\Comment;
use Illuminate\Support\Facades\Storage;
use App\http\Requests\StorePostRequest;

class PostController extends Controller
{

    public function index()
    {
        $selectedPost = Post::paginate(4);
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
        $comments = Comment::where('post_id', $postId)->get();
        $selectedPost = Post::find($postId);
        return view('posts.show', [
            'post' => $selectedPost,
            'comments' => $comments
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

        $request->validate([
            'title' => [Rule::unique('posts')->ignore($selectedPost->id)]
        ]);

        if (!$selectedPost) {
            return to_route(route: 'posts.index');
        }

        if ($request->hasFile('image')) {
            Storage::delete($selectedPost->image_path);
            $postImage = $request->file('image');
            $image_path = $postImage->store('images');
            $selectedPost->image_path = $image_path;
        } elseif (isset($request->delete_image)) {
            Storage::delete($selectedPost->image_path);
            $image_path = '';
            $selectedPost->image_path = $image_path;
        }

        $selectedPost->title = $request->title;
        $selectedPost->description = $request->description;
        $selectedPost->user_id = $request->post_creator;
        $selectedPost->save();
        return to_route(route: 'posts.index');
    }

    //*store -- insert into db
    public function store(Request $request)
    {
        $title = request()->title;
        $description = request()->description;
        $userId = request()->post_creator;


        $image_path = null;
        if ($request->hasFile('image')) {
            $postImage = $request->file('image');
            $image_path = $postImage->store('images');
        }

        Post::create([
            'title' => $title,
            'description' => $description,
            'user_id' => $userId,
            'image_path' => $image_path,
        ]);
        return redirect()->route('posts.index');
    }

    //*destroy 
    public function destroy($postId)
    {
        $selectedPost = Post::find($postId);
        if (!$selectedPost) {
            return to_route('posts.index');
        }

        $postComments = Comment::where('id', $postId)->get();
        $postComments->each->delete();

        Storage::delete($selectedPost->image_path);

        $selectedPost->forceDelete();
        return to_route('posts.index');
    }
}
