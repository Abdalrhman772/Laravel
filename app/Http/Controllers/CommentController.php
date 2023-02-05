<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Comment;
use Illuminate\Support\Facades\Auth;

class CommentController extends Controller
{
    public function store(Request $request)
    {
        // always make a request to validate
        $request->validate([
            'text' => ['required'],
            'postId' => ['required', 'exists:posts,id'],
        ]);

        Comment::create([
            'text' => $request->text,
            'id' => $request->postId,
            'user_id' => Auth::user()->id,
        ]);

        return redirect()->route('posts.show', $request->postId);
    }

    public function destroy($commentId)
    {
        $selectedComment = Comment::find($commentId);

        if (!$selectedComment) {
            return to_route(route: 'posts.index');
        }

        $postId = $selectedComment->id;
        $selectedComment->delete();

        return redirect()->route('posts.show', $postId);
    }
}
