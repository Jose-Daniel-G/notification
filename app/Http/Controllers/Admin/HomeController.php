<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Post;
use Illuminate\Http\Request;

class HomeController extends Controller
{
    public function __construct() {  $this->middleware('auth'); }

    public function index() { 
       $posts = Post::with(['category', 'image'])
                ->latest()
                ->get();
        return view('home', compact('posts'));
        // return view('admin.index',compact('posts')); 
    }

    public function store(Request $request) {}

    public function show($id) {}

    public function edit($id) {}

    public function update(Request $request, $id) {}

    public function destroy(Request $request) {}
}
