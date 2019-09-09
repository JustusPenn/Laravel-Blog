@extends('welcome')

@section('title', $profile->user->name.'`s Profile')
    
@section('content')
    <div class="container my-2 mx-auto w-75 py-3">
        <div class="row p-2 text-center">
            <h3 class="col-12 ">Welcome {{ Auth::user()->name }} </h3> 
        </div>
        <div class="my-2 py-1 container">
            <div class="row">
                <div class="col-12 col-md-6 col-lg-8 d-flex flex-column">
                    <h4 class="text-center">Profile Information</h4>
                    <span><strong>Name: </strong>{{ $profile->user->name }}</span>
                    <span><strong>Email: </strong>{{ $profile->user->email }}</span>
                    <span><strong>Contact: </strong>{{ $profile->contact }}</span>
                    <span><strong>Address: </strong>{{ $profile->address }}</span>
                    <span><strong>About: </strong>{!! $profile->about !!}</span>
                </div>
                <div class="col-4 col-md-6 col-lg-4 d-block">
                    <img class="img-thumbnail" src="{{ asset('storage/'.$profile->picture) }}" alt="Profile Picture">
                </div>
            </div>
        </div>
        <div class="d-inline-block">
            <a href="{{ route('profile.edit', $profile->id)}}" class="btn btn-outline-primary">Edit Profile</a>
        </div>
    </div>
@stop

@section('scripts')

@endsection