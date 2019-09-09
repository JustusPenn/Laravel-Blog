@extends('welcome')

@section('title', 'Welcome My blog')

@section('content')
    <div class="jumbotron jumbotron-fluid" style="background: url('{{ asset('imgs/01.jpg') }}') center;">
        <div class="container my-5">
          <h1 class="display-4 text-white"><strong>Zebo's Laravel Blog.</strong></h1>
          <p class="lead text-white">Lorem ipsum dolor sit amet consectetur, adipisicing elit. Deleniti quo quam earum iure eligendi ut libero ipsam error dolorum adipisci. Alias repellat sunt dolore sint tempore repellendus earum mollitia dolorum?</p>
          <button class="btn btn-white btn-lg-*">More</button>
        </div>
    </div>

    <div class="container">
        <div class="pt-3 mb-2">
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
                                        {{ strip_tags(Str::words($item->description, 20, '...')) }} <a href="{{ route('blog.article',$item->id) }}" class="b4-link"> more</a>
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
