<?php

namespace App\Http\Controllers;

use App\User;
use App\Blog;
use App\Comment;
use Illuminate\Http\Request;
use Intervention\Image\Facades\Image;

class BlogController extends Controller
{

    /** Auth middleware */
    public function __construct()
    {
        $this->middleware('auth');
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $user = User::all();
        $data = Blog::all();
        // $comment = Comment::all();
        return view('blog.blogs', ['data'=>$data, 'user'=>$user]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $blog = new Blog();
        return view('blog.create', compact('blog'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $blog = Blog::create($this->validateRequest());

        $this->storeImage($blog);
        if (auth()->user()) {
            return redirect('/blog')->with('success', 'New Blog Post created');
        }
        return redirect('/')->with('success', 'New Blog Post Added');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Blog  $blog
     * @return \Illuminate\Http\Response
     */
    public function show(Blog $blog)
    {
        $comments = Comment::find($blog);
        // dd($comments);
        return view('blog.show', compact('blog','comments'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Blog  $blog
     * @return \Illuminate\Http\Response
     */
    public function edit(Blog $blog)
    {
        return view('blog.edit', compact('blog'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Blog  $blog
     * @return \Illuminate\Http\Response
     */
    public function update(Blog $blog)
    {
        $blog->update($this->validateRequest());

        $this->storeImage($blog);

        $this->storeDocument($blog);

        return redirect('blog/'.$blog->id)->with('success','Post Updated Successfully');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Blog  $blog
     * @return \Illuminate\Http\Response
     */
    public function destroy(Blog $blog)
    {
        $blog->delete();

        return redirect('/')->with('success', 'Post Deleted successfully');
    }

    private function validateRequest(){
        return tap(request()->validate([
            'title' => 'required|min:5',
            'description' => 'required',
            'user_id' => 'required',
            'caption' => 'sometimes'
        ]), function(){
            if(request()->hasFile('image')){
                request()->validate([
                    'image'=>'file|image|max:10000',
                ]);
            }
            if(request()->hasFile('document')){
                request()->validate([
                    'document'=>'file|mimes:pdf,doc,docx|max:25000',
                ]);
            }
        });
    }

    private function storeImage($blog){
        if(request()->has('image')){

            $blog->update([
                'image' => request()->image->store('uploads/blog', 'public'),
            ]);

            $image = Image::make(public_path('storage/'.$blog->image))->resize(1200,700);
            $image->save();
        }
    }

    private function storeDocument($blog){
        if(request()->has('document')){

            $blog->update([
                'document' => request()->document->store('uploads/docs', 'public'),
            ]);
  
        }
    }
}
