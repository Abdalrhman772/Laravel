@extends('layouts.app')

@section('title')
    Show
@endsection

@section('content')
    <style>
        body {
            background-color: rgb(4, 69, 122);
        }

        h5,
        p {
            font-weight: bold;
        }

        .right {
            color: rgb(20, 78, 187)
        }

        .header-bg {
            font-weight: bold;
            color: white;
            background-color: rgb(0, 41, 117)
        }
    </style>
    <div class="card border-dark my-5">
        <div class="card-header header-bg fs-5">
            Post info
        </div>
        <div class="card-body">
            <h5 class="card-title">Title: <span class="right">{{ $post['title'] }}</span></h5>
            <h5 class="card-title">Description: <span class="right">{{ $post->description }}</span></h5>
            @if ($post->image_path)
                <img src="{{ url($post->image_path) }}" class="object-fit-contain" alt="post image"
                    style="max-height: 40rem;" />
            @endif
        </div>
    </div>
    <div class="card border-dark">
        <div class="card-header header-bg fs-5">
            Post Creator info
        </div>
        <div class="card-body">
            <h5 class="card-title ">Name: <span class="right">{{ $post->user['name'] }}</span> </h5>
            <h5 class="card-title ">Title: <span class="right">{{ $post['title'] }}</span></h5>
            <h5 class="card-title">Created at: <span class="right">{{ $post['created_at']->format('Y-m-d') }}</span></h5>
        </div>
    </div>
    <section class="card mt-5">
        <div class="card-body p-4">
            <form action="{{ route('comments.store') }}" method="POST" class="form-outline mb-4 d-flex gap-2">
                @csrf
                <input type="text" name="text" class="form-control" placeholder="Write a comment..." />
                <input type="hidden" name="postId" value="{{ $post->id }}" />
                <input type="submit" value="Add" class="btn btn-success btn-sm" />
            </form>

            @if ($errors->any())
                @foreach ($errors->all() as $error)
                    <p class="mb-0 text-danger">
                        {{ $error }}
                    </p>
                @endforeach
            @endif

            @foreach ($comments as $comment)
                <div class="card bg-light mt-2">
                    <div class="card-body">
                        <p>{{ $comment->text }}</p>

                        <div class="small text-muted">
                            <span class="d-block right fw-bold">by: {{ $comment->user->name }}</span>

                            <span class="right fw-bold">on: {{ $comment->created_at->format('Y-m-d') }}</span>
                        </div>

                        <div class="card mt-2">
                            <form method="POST" action="{{ route('comments.destroy', $comment->post_id) }}">
                                @csrf
                                @method('DELETE')
                                <input type="submit" value="Delete" class="btn btn-danger btn-sm" />
                            </form>
                        </div>
                    </div>
                </div>
            @endforeach
        </div>
    </section>
@endsection
