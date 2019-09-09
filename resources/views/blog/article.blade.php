@extends('welcome')

@section('title')
    {{$blog->title}} Details
@stop

@section('content')
    <div class="container">
        @if (session('success'))
            <div class="alert alert-success mt-5">
                {{ session('success')}}
            </div>
        @endif

        <div class="row pb-3 d-flex flex-column">
            
            @if ($blog->image)
                <img src="{{ asset('storage/'.$blog->image) }}" alt="post image" class="py-2 img-thumnail">
            @endif
            <h2 class="col-12 text-center">{{ $blog->title }}</h2>
            <p>{!! $blog->description !!}</p>

            @auth
                @if ($blog->user->id == Auth::user()->id)
                    <div class="d-inline">
                        <a href="{{ route('blog.edit', $blog->id) }}" class="btn btn-outline-primary">Edit</a> <button class="btn btn-outline-danger" onclick="document.getElementById('delete').submit();">Delete</button>
                        <form action="{{ route('blog.destroy', $blog->id) }}" method="POST" id="delete">
                            @csrf
                            @method('DELETE')
                        </form>
                    </div>
                @endif 
            @endauth
            <div class="d-block">
                <span class="badge">{{count($blog->comments)}} Comments</span>
                <span>Posted {{ $blog->created_at->diffForHumans()}}</span>
                <span>By {{ $blog->user->name }}</span>
            </div>

            @if ($blog->document)
                <div class="my-3 row">
                    <div class="col-12 text-center h3">Document</div>
                    <div class="col-12 text-center">
                        <a class="text-success" href="{{ asset('storage/'.$blog->document) }}">[ <strong>{{ $blog->caption }}</strong> ]</a>
                    </div>
                </div>
            @endif

            <h3 class="col-12 py-2">Reviews</h3>
            @if($blog->comments)
                <div class="row mx-auto container w-75">
                    @foreach ($blog->comments as $comment)
                        <div class="d-flex flex-column px-2 my-1 border col-12">
                            <span class="d-block">{{ $comment->comment }}</span>
                            <div class="col-12">
                                <span><strong>by {{ $comment->user->name }}</strong></span><span class="float-right">posted {{ $comment->created_at->diffForHumans() }}</span>
                            </div>
                        </div>
                    @endforeach
                </div>
            @endif
            <div class="mx-auto w-75 my-2">
                <h3>Make a Comment</h3>
                @guest
                    <form action="{{ route('article.comment') }}" method="post">
                        @csrf
                        <input type="number" value="{{ $blog->id }}" name="blog_id" hidden>
                        <div class="form-group row">
                            <div class="col-12 col-lg-6 col-md-6 row">
                                <label for="name" class="col-12">Name:</label>
                                <input type="text" name="name" class="mr-1 form-control" placeholder="Name">
                            </div>
                            <div class="col-12 col-lg-6 col-md-6 row">
                                <label for="email" class="col-12">Email:</label>
                                <input type="email" name="email" class="ml-1 form-control" placeholder="Name">
                            </div>
                        </div>
                        <div class="form-group row">
                            <label for="comment" class="col-12">Comment:</label>
                            <textarea name="comment" id="comment" cols="30" rows="5" class="cols-12 form-control"></textarea>
                        </div>
                        <button type="submit" class="btn btn-primary">Place Comment</button>
                    </form>
                @else
                    <form action="{{ route('comment.store') }}" method="post">
                        @csrf
                        <input type="number" value="{{ Auth::user()->id }}" name="user_id" hidden>
                        <input type="number" value="{{ $blog->id }}" name="blog_id" hidden>
                        <div class="form-group row">
                            <label for="comment" class="col-3">{{ Auth::user()->name }}</label>
                            <textarea name="comment" id="comment" cols="30" rows="1" class="col-9 form-control"></textarea>
                        </div>
                        <button type="submit" class="btn btn-primary">Place Comment</button>
                    </form>
                @endguest
            </div>
        </div>
    </div>
@endsection
