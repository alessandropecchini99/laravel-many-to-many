@extends('admin.layouts.base')

@section('title', 'Show')

@section('main') 

    <div class="container">
        <h1>{{ $technology->name }}</h1>
        <h6>ID: {{ $technology->id }}</h6>


        <a class="btn btn-secondary" href="/admin/technologies">Technology Index</a>
        <a class="btn btn-secondary" href="/admin/posts">Post Index</a>
    </div>

@endsection