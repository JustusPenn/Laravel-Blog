@extends('welcome')

@section('title', 'Create a Post');

@section('content')
<div class="container">
        <div class="mb-2">

            <div class="p-3">
                <h3 class="text-center">Blog Articles</h3>
            </div>

            @if (session('success'))
                <div class="alert alert-success my-3">
                    {{ session('success')}}
                </div>
            @endif
    
            @if (count($data)==0)
                <div class="alert alert-primary">
                    <strong>Information: </strong>No Posts Created Yet!!!
                </div>
            @else
    
                <div class="row">
                    @foreach ($data as $item)
                        <div class="col-12 col-lg-4 col-md-6">
                            <div class="border rounded p-2 m-1">
                                <div class="d-block">
                                    <div class="d-flex flex-column">
                                        <h3 class="text-center">{{$item->title}}</h3>
                                    </div>
                                    <div>
                                        @if ($item->image)
                                            <img src="{{ asset('storage/'.$item->image) }}" alt="Post Image" class="rounded img-thumbnail">
                                        @endif
                                    </div>
                                    <div class="pt-2 d-flex-column">
                                        {{ strip_tags(Str::words($item->description, 20, '...')) }} <a href="{{ route('blog.show',$item->id) }}" class="b4-link"> more</a>
                                    </div>
                                    <div class="pt-1 row">
                                        <div class="col-6 text-left">Posted {{ $item->created_at->diffForHumans() }} </div>
                                        <div class="col-6 text-right">Author: {{ $item->user->name }}</div>
                                    </div>
                        
                                </div>
                            </div>
                        </div>
                    @endforeach
                </div>
            @endif
    
        </div>    
    </div>
    
@endsection

@section('scripts')
 
@endsection
