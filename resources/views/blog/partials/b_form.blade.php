    @csrf

    <input type="number" value="{{ Auth::user()->id }}" name="user_id" hidden>

    <div class="form-group">
        <label for="title"><strong>Title:</strong></label>
        <input type="text" class="form-control" name="title" value="{{ old('title') ?? $blog->title }}">
        <div class="text-danger">{{ $errors->first('title') }}</div>
    </div>


    <div class="form-group">
        <label for="title"><strong>Description:</strong></label>
        <textarea id="description" class="form-control" name="description" cols="30" rows="8">{{ old('description') ?? $blog->description }}</textarea>
        <div class="text-danger">{{ $errors->first('description') }}</div>
    </div>

    <div class="row">
        <div class="form-group col-12 col-md-6">
            <label for="title">Image Upload</label>
            <input type="file" name="image" class="d-flex flex-column">
            <div class="text-danger">{{ $errors->first('image') }}</div>
        </div>
    
        <div class="form-group col-12 col-md-6">
            <label for="title">Document Upload</label>
            <input type="file" name="document" class="d-flex flex-column">
            <div class="text-danger">{{ $errors->first('document') }}</div>

            <div class="form-group my-3">
                <label for="caption"><strong>Document caption:</strong></label>
                <input type="text" class="form-control" name="caption" value="{{ old('caption') ?? $blog->caption }}">
                <div class="text-danger">{{ $errors->first('caption') }}</div>
            </div>
        </div>
    </div>