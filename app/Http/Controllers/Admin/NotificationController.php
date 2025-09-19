<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Post;
use Illuminate\Support\Facades\Auth;

class NotificationController extends Controller
{
    public function index()
    { 
        $notifications = Auth::user()->notifications()->latest()->paginate(10);

        return view('admin.notifications.index', compact('notifications'));
    }

    public function markAsRead($id) // singular
    {
        $notification = Auth::user()->notifications()->findOrFail($id);
        $notification->markAsRead();

        return redirect()->back()->with('success', 'Notificación marcada como leída.');
    }
    public function read($id) // singular
    {
        $notification = auth()->user()->notifications()->findOrFail($id);
        $notification->markAsRead();

        $post = Post::findOrFail($notification->data['post']);
 
        return view('admin.posts.show', compact("post"));
    } 
}
