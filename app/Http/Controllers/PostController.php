<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class PostController extends Controller
{

    public function index()
    {
        $allPosts = [
            [
                'id' => 1,
                'title' => 'laravel',
                'description' => 'hello this is laravel post',
                'posted_by' => 'Ahmed',
                'created_at' => '2022-01-28 10:05:00',
            ],
            [
                'id' => 2,
                'title' => 'PHP',
                'description' => 'hello this is PHP post',
                'posted_by' => 'Ali',
                'created_at' => '2022-01-30 10:05:00',
            ],
        ];
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
        $allPosts = [
            [
                'id' => 1,
                'title' => 'laravel',
                'description' => 'hello this is laravel post',
                'posted_by' => 'Ahmed',
                'created_at' => '2022-01-28 10:05:00',
            ],
            [
                'id' => 2,
                'title' => 'PHP',
                'description' => 'hello this is PHP post',
                'posted_by' => 'Ali',
                'created_at' => '2022-01-30 10:05:00',
            ],
        ];


        $selectedPost = '';
        foreach ($allPosts as $post) {
            if ($post['id'] == $postId) {
                $selectedPost = $post;
            }
        }
        return view('posts.show', [
            'post' => $selectedPost
        ]);
    }

    //*edit
    public function edit($postId)
    {
        $allPosts = [
            [
                'id' => 1,
                'title' => 'laravel',
                'description' => 'hello this is laravel post',
                'posted_by' => 'Ahmed',
                'created_at' => '2022-01-28 10:05:00',
            ],
            [
                'id' => 2,
                'title' => 'PHP',
                'description' => 'hello this is PHP post',
                'posted_by' => 'Ali',
                'created_at' => '2022-01-30 10:05:00',
            ],
        ];


        $selectedPost = '';
        foreach ($allPosts as $post) {
            if ($post['id'] == $postId) {
                $selectedPost = $post;
            }
        }
        return view('posts.edit', [
            'post' => $selectedPost
        ]);
    }

    //*store
    public function store()
    {
        return view('posts.index');
    }
}
