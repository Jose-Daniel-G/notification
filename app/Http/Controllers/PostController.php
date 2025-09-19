<?php

namespace App\Http\Controllers;

use App\Events\PostEvent;
use App\Models\Category;
use App\Models\Image;
use App\Models\Post;
use App\Notifications\PostNotification;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Str;

class PostController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request)
    {
        $posts = Post::all();
        $categories = Category::all();
        return view('admin.posts.index', compact('posts', 'categories'));
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
    {  $request->validate(['title' => 'required', 'description' => 'required', 'foto' => 'required|image|max:40960', 'category' => 'required']);

        $post = new Post();
        $post->title = $request->title;
        $post->body = $request->description;
        $post->user_id = Auth::user()->id;
        $post->slug = Str::slug($request->title);
        $post->category_id = $request->category;

        $post->save();

        $imagen_id = $post->getKey();                   // El ID del  "Post" después de crearlo 

        if ($request->hasFile('foto')) {
            $file = $request->file('foto');
            $nombre = time() . "_" . $file->getClientOriginalName();
            $ruta = $file->storeAs('uploads', $nombre); // $ruta = $file->store('uploads', 'public');
            $url = 'storage/' . $ruta;

            Image::create(['url' => $url, 'imageable_id' => $imagen_id, 'imageable_type' => Post::class]); // $post->image()->create(['url' => $url]);
        }

        event(new PostEvent($post));
        return redirect()->back()->with(['success' => 'Post created successfully']);
    }

    /**
     * Display the specified resource.
     */
    public function show(Post $post)
    {
        $similares = Post::where('category_id', $post->category_id)
            ->where('status', 2)
            ->where('id', '!=', $post->id)
            ->latest('id')
            ->take(4)
            ->get();
        return view('admin.notifications.show', compact('post', 'similares'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Post $post)
    {
        $categories = Category::all();
        return view('admin.posts.edit', compact('post', 'categories'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Post $post)
    {
        // 1. Validate the request data
        $request->validate([
            'title' => 'required|max:255',
            'body' => 'required',
            // Add other validation rules for your post fields
        ]);

        // 2. Fill the Post model with validated data
        $post->fill($request->all());

        $post->save();

        // 4. Redirect to the index page with a success message
        return redirect()->route('admin.posts.index')->with('success', 'Publicación actualizada correctamente.');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy($id)
    {
        $post = Post::find($id);

        if (!$post) {
            return redirect()->back()->with('error', "Publicación con id $id no encontrada");
        }

        if ($post->image) {              // Borrar imagen asociada
            $path = str_replace('storage/', '', $post->image->url);
            Storage::disk('public')->delete($path);
            $post->image->delete();
        }

        $post->tags()->detach();          // Opcional: detach tags si quieres limpiar pivot

        $post->delete();

        return redirect()->back()->with('success', 'Publicación eliminada correctamente');
    }
}
