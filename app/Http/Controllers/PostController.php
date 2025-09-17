<?php

namespace App\Http\Controllers;

use App\Events\PostEvent;
use App\Models\Post;
use App\Notifications\PostNotification;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class PostController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request)
    {
        return view('admin.posts.index');
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('admin.posts.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $data = $request->all();
        $data['user_id'] = Auth::id();
        
        $post = Post::create($data);
        // auth()->user()->notify(new PostNotification($post));
        // User::all()->except($post->user_id)
        //            ->each(function(User $user) use ($post){
        //                 $user->notify(new PostNotification($post));
        //            });
        event(new PostEvent($post));
        return redirect()->back()->with(['success'=>'Post created successfully']);
    }

    /**
     * Display the specified resource.
     */
    public function show(Post $post)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Post $post)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Post $post)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Post $post)
    {
        //
    }
    public function notification(Post $post)
    {
        //
    }
}
