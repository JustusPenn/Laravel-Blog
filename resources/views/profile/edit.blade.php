@extends('welcome')

@section('title', 'Edit '.$profile->user->name.'`s Profile')
    
@section('content')
    <div class="container my-3 mx-auto w-75 py-4">
        <div class="row border rounded p-2 text-center">
            <h3 class="col-12 ">{{ $profile->user->name }}'s Profile</h3> 
            
            <span class="col-12"><strong>Edit your Profile</strong></span>
            <small class="col-12">Change any information in the form where neccessary.</small>
        </div>
        <form action="{{ route('profile.update', $profile->id) }}" method="post" enctype="multipart/form-data">
            @csrf
            {{-- @method('PATCH') --}}
            <input type="number" value="{{ Auth::user()->id }}" name="user_id" hidden>
            <div class="form-group row py-2">
                <div class="col-12 col-md-8 d-flex flex-column my-auto">
                    <label for="picture"><strong>Profile Picture:</strong></label>
                    <input type="file" name="picture" id="picture">
                    <span class="text-danger"><strong>{{ $errors->first('picture') }}</strong></span>
                </div>
                <div class="col-12 col-md-4 d-block" >
                    <div class="w-25" id="profile"></div>
                </div>
            </div>

            <div class="form-group d-flex flex-column">
              <label for="contact">Phone Number:</label>
              <input type="tel" name="contact" id="contact" class="form-control" value="{{ $profile->contact }}" placeholder="671-234-567" >
              <span class="text-danger"><strong>{{ $errors->first('contact') }}</strong></span>
            </div>

            <div class="form-group d-flex flex-column">
              <label for="address">Address:</label>
              <input type="text" name="address" id="address" class="form-control" value="{{ $profile->address }}" placeholder="Detailed Address eg Musang - Rendezvous Junction">
              <span class="text-danger"><strong>{{ $errors->first('address') }}</strong></span>
            </div>

            <div class="form-group d-flex flex-column">
                <label for="about">About:</label>
                <textarea name="about" id="about" cols="30" rows="5" placeholder="A brief Description abut your self">{{ $profile->about }}</textarea>
                <span class="text-danger"><strong>{{ $errors->first('about') }}</strong></span>
            </div>

            <button class="btn btn-success" type="submit">Submit</button>
        </form>
    </div>
@stop

@section('scripts')
    <script>
        $("#picture").on('change', function () {

            if (typeof (FileReader) != "undefined") {

                var image_holder = $("#profile");
                image_holder.empty();

                var reader = new FileReader();
                reader.onload = function (e) {
                    $("<img />", {
                        "src": e.target.result,
                        "class": "thumbnail border",
                        "height" : 200,
                        "width" : 250
                    }).appendTo(image_holder);
                }
                image_holder.show();
                reader.readAsDataURL($(this)[0].files[0]);
            } else {
                alert("This browser does not support FileReader.");
            }
        });
    </script>
    <script src="{{ asset('js\tinymce\tinymce.min.js') }}"></script>
    <script>
        tinymce.init({
            selector: '#about',
            menubar: false,
            plugins: 'colorpicker link',
        });
    </script>
@endsection