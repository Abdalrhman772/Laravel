@extends('layouts.app')

@section('title') edit @endsection

@section('content')
<style>
    label,p{
        font-weight: bold;
    }
</style>
<form method="POST" action="{{route('posts.update', ['post'=>$post->id])}}">
  @csrf
 @method('PUT')
  <div class="mb-3">
    <label for="title" class="form-label">Title</label>
    <input type="text" name="title" class="form-control" value="{{$post['title']}}" id="title">
  </div>
  <div class="form-floating mb-3">
    <p class="form-label">Description</p>
    <textarea class="form-control" name="description" id="desc" style="height: 100px">{{$post->description}}</textarea>
  </div>
  <div class="mb-3">
    <label class="form-check-label">Post Creator</label>

    <select name="post_creator" class="form-control">
       @foreach ($users as $user)
           <option name="posted_by" value="{{$user->id}}" @if($user->id == $post->user_id) selected @endif>  {{$user->name}} </option>
       @endforeach
    </select>
</div>
  <button type="submit" class="btn btn-primary">UPDATE</لا>
</form>
  @endsection
  