<?php

namespace App\Http\Controllers;

use App\Post;
use App\Http\Requests\PostRequest;

class PostController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth')->except(['index', 'show']);
    }
    public function index()
    {
        $posts = Post::latest()->paginate(4);
        return view('posts.index', ['posts' => $posts]);
    }

    public function show(Post $post ){
        //$post = Post::where('slug', $post)->first();
        return view('posts.show', compact('post'));
    }

    public function create()
    {
        return view('posts.create',  [
            'post' => new Post()
            ]);
    }
    public function store(PostRequest $request)
    {
        //validasi inputan
        $request->validate(([
            'thumbnail' => 'image|mimes:jpeg,png,jpg,svg|max:2048'
        ]));

        $attr = $request->all();
        //mengubah judul jadi slug
        $slug = \Str::slug(request('title'));
        $attr['slug'] = $slug;

        if(request()->file('thumbnail')){
            $thumbnail = request()->file('thumbnail') -> store("images/posts");
        }else{
            $thumbnail = null;
        }

        $thumbnail = request()->file('thumbnail');
        $thumbnailUrl = $thumbnail -> storeAs("images/posts","{$slug}.{$thumbnail->extension()}");
        
        $attr['thumbnail'] = $thumbnailUrl;
        //membuat post baru
        $post = auth()->user()->posts()->create($attr);

        session()->flash('success', 'The post was created');
        return redirect('posts');
    }

    public function edit(Post $post){
        return view('posts.edit', [
            'post' =>$post
            ]);
    }

    public function update(PostRequest $request, Post $post){
        
        $this->authorize('update', $post);
        if(request()->file('thumbnail')){
            \Storage::delete($post->thumbnail);
            $thumbnail = request()->file('thumbnail') -> store("images/posts");
        }else{
            $thumbnail = $post->thumbnail;
        }
        
        $attr = $request->all();
        $attr['thumbnail'] = $thumbnail;
        $post->update($attr);
        session()->flash('success', 'The post was updated');
        
        return redirect('posts');
    }

    public function destroy(Post $post)
    {
        $this->authorize('delete', $post);

        \Storage::delete($post->thumbnail);
        $post->delete();
        session()->flash('error', 'The post was delete');
        return redirect('posts');
        
        
    }
}
