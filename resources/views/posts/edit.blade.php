@extends('layouts.app')

@section('title') edit @endsection

@section('content')
<style>
    label,p{
        font-weight: bold;
    }
</style>
<form>
  <div class="mb-3">
    <label for="title" class="form-label">Title</label>
    <input type="text" name="title" class="form-control" value="{{$post['title']}}" id="title">
  </div>
  <div class="form-floating mb-3">
    <p class="form-label">Description</p>
    <textarea class="form-control" name="description" id="desc" style="height: 100px">{{$post->description}}</textarea>
  </div>
  <div class="mb-3">
    <label for="title" class="form-label">Post Creator</label>
    <input type="text" name="posted-by" value="{{$post['posted_by']}}" class="form-control" id="creator">
  </div>
  <button type="submit" class="btn btn-primary">UPDATE</لا>
</form>
  @endsection
  