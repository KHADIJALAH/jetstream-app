<?php

namespace App\Http\Controllers;

use App\Models\ForumTopic;
use App\Models\ForumPost;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class ForumController extends Controller
{
    public function index()
    {
        $topics = ForumTopic::with('user')->latest()->paginate(15);
        return view('forum.index', compact('topics'));
    }

    public function showTopic(ForumTopic $topic)
    {
        $posts = $topic->posts()->with('user')->latest()->paginate(10); // Added latest() for posts
        return view('forum.topic', compact('topic', 'posts'));
    }

    public function storeTopic(Request $request)
    {
        $request->validate([
            'title' => 'required|string|max:255',
            'content' => 'required|string|max:2000',
        ]);

        Auth::user()->forumTopics()->create([
            'title' => $request->title,
            'content' => $request->content,
        ]);

        return redirect()->route('forum.index')->with('success', 'Topic created successfully!');
    }

    public function storePost(Request $request, ForumTopic $topic)
    {
        $request->validate(['content' => 'required|string|max:2000']);

        $topic->posts()->create([
            'user_id' => Auth::id(),
            'content' => $request->content,
        ]);

        return back()->with('success', 'Post added successfully!');
    }

    // You might want to add methods for editing/deleting topics and posts
}