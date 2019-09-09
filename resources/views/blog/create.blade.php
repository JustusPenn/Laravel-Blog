@extends('welcome')

@section('title', 'Create a Post');

@section('content')
    <div class="container">
        <div class="p-3">
            <h3 class="text-center">Create New Article</h3>
        </div>
    
        <div class="pb-3">
            <form action="{{ route('blog.store') }}" enctype="multipart/form-data" method="POST">
                @include('blog.partials.b_form')
    
                <button type="submit" class="btn btn-outline-primary btn-lg">Submit</button>
            </form>
        </div>
    </div>
@endsection

@section('scripts')
    <script src="{{ asset('js\tinymce\tinymce.min.js') }}"></script>
    <script>
        tinymce.init({
            selector: '#description',
            menubar: false,
            plugins: 'colorpicker link',
        });
    </script>
@endsection
