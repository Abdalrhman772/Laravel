@extends('layouts.app')

@section('title') Show @endsection

@section('content')
<style>
  body{
    background-color: rgb(4, 69, 122);
  }
    h5,p{
        font-weight: bold;
    }
    .right{
      color: rgb(20, 78, 187)
    }
    .header-bg{
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
      <h5 class="card-title">Title: <span class="right">{{$post['title']}}</span></h5>
      <h5 class="card-title">Description: <span class="right">{{$post->description}}</span></h5>
    </div>
  </div>
<div class="card border-dark">
    <div class="card-header header-bg fs-5">
      Post Creator info
    </div>
    <div class="card-body">
      <h5 class="card-title ">Name: <span class="right">{{$post->user['name']}}</span> </h5>
      <h5 class="card-title ">Title: <span class="right">{{$post['title']}}</span></h5>
      <h5 class="card-title">Created at: <span class="right">{{$post['created_at']->format('Y-m-d')}}</span></h5>
    </div>
  </div>
  @endsection
  