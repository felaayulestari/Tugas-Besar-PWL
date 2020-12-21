@extends('layouts.main')

@section('title', $post->title)

@section('content')
    <div class="container">
    <img img style="height: 270px; object-fit: cover; object-position: center;" class="card-img-top" src="{{ asset($post->takeImage) }}" alt="">              
    <h1>{{ $post->title }}</h1>
    <div class="text-secondary">
    Create by {{ $post->author->name }} &middot; {{ $post->created_at->format("d F Y") }}
    </div>
    <hr>
    <p>{!! nl2br($post->body) !!}</p>
        <div>
        @can('update', $post)
            <!-- Button trigger modal -->
            <button type="button" class="btn btn-link btn-danger btn-sm" data-toggle="modal" data-target="#exampleModal">
                Delete
            </button>
            <!-- Modal -->
            <div class="modal fade" id="exampleModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
            <div class="modal-dialog">
                <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLabel">Apakah anda ingin menghapusnya?</h5>
                    <button type="button" class="btn-close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <div>
                        <div>{{ $post->title }}</div>
                        <div class="text-secondary">
                            <small>Published: {{ $post->created_at->format("d F Y") }}</small>
                        </div>
                    </div>
                    <form action="/posts/{{ $post->slug }}/delete" method="post">
                        @csrf
                        @method("delete")
                        <div class="d-flex ">
                            <button type="submit" class="btn btn-danger mr-3">Ya</button>
                            <button type="button" class="btn btn-success" data-dismiss="modal">Tidak</button>                
                        </div>
                    </form>
                </div>
                </div>
            </div>
            </div>
            @endcan
        </div>
    </div>
@endsection
