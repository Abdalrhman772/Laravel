@extends('layouts.app')

@section('title') create @endsection

@section('content')
 <form method="POST" action="/posts">
        @csrf
        <div class="mb-3">
            <label class="form-label">Title</label>
            <input type="text" name="title" class="form-control" >
        </div>
        <div class="mb-3">
            <label  class="form-label">Description</label>
            <textarea
                class="form-control"
                name="description"
            ></textarea>
        </div>
        <div class="mb-3">
            <label class="form-check-label">Post Creator</label>

            <select name="post_creator" class="form-control">
               @foreach ($users as $user)
                   <option value="{{$user->id}}"> {{$user->name}} </option>
               @endforeach
            </select>
        </div>
        <button type="submit" class="btn btn-success">Submit</لا>
    </form>
@endsection