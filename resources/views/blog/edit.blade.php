@extends('welcome')

@section('title', 'Edit'.$blog->title.'Post');

@section('styles')
    
@endsection

@section('content')
    <section class="container">
        <div class="row p-3">
            <h3 class="text-center"> Edit {{ $blog->title }} Post</h3>
        </div>
    
        <div class="pb-3">
            <form action="{{ route('blog.update', $blog->id) }}" enctype="multipart/form-data" method="POST">
                @method('PATCH')
                @include('blog.partials.b_form')
    
                <button type="submit" class="btn btn-outline-primary btn-lg">Submit</button>
            </form>
        </div>
    </section>
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
