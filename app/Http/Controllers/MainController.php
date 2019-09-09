<?php
    
namespace App\Http\Controllers;

use App\User;
use App\Blog;
use App\Comment;
use Illuminate\Http\Request;

class MainController extends Controller
{
    public function index()
    {
        $user = User::all();
        $data = Blog::all();
        // $comment = Comment::all();
        return view('index', ['data'=>$data, 'user'=>$user]);
    }

    public function showPost(Blog $blog){
        $comments = Comment::find($blog);
        // dd($comments);
        return view('blog.article', compact('blog','comments'));
    }

    public function createComment() {
        $data = request()->validate([
            'name' => 'required',
            'email' => 'required',
            'comment' => 'required',
            'blog_id'  => 'required'
        ]);

        Comment::create($data);

        return redirect()->back()->with('success', 'Comment Created');
    }
}
