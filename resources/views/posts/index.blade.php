@extends('layouts.main')

@section('content')
<div class="container">
        <div class="d-flex justify-content-between">
            <div>
                <h4>All Post</h4>
            </div>
            <div> 
                @if(Auth::check())
                <a href="{{ route('posts.create') }}" class="btn btn-primary">New Post</a>
                @else
                <a href="{{ route('login') }}" class="btn btn-primary">Login to Create New Post</a>
                @endif
            </div>
        </div>
        <hr>
        <div class="row">
            @forelse($posts as $post)
                <div class="col-md-6">
                    <div class="card mb-4">
                        <div class="card-header">
                            <div class="card-header">
                            <h2><b>{{ $post->title }}</b></h2>
                            </div>
                            @if($post->thumbnail)
                            <img style="height: 270px; object-fit: cover; object-position: center;" class="card-img-top" src="{{ $post->takeImage }}" >
                            @endif
                            <div class="card-body">
                                {{ Str::limit($post->body, 100) }}
                            </div>
                            <a href="/posts/{{ $post->slug }}">Read more</a>
                        </div>
                        <div class="card-footer d-flex justify-content-between">
                            Published on {{ $post->created_at->format("d F Y")}}
                            @can('update', $post)
                            <a href="/posts/{{ $post->slug }}/edit" class="btn btn-sm btn-success">Edit</a>
                            @endcan
                        </div>
                    </div>
                </div>
                @empty     
                <div class="col-md-6">
                    <div class="alert-alert-info">    
                        There are no post.
                    </div>
                </div>
            @endforelse
        </div>
    <div class="d-flex justify-content-center">
        <div>
            {{ $posts->links()}}
        </div>
    </div>
</div> 
@endsection