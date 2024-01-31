@extends('adminTemplate.masters')

@section('content')

<div class="container">
    <form action="{{ isset($row['id']) ? route('card.update', $row['id']) : route('card.store') }}" method="post"
        enctype="multipart/form-data">
        @csrf
        @if(isset($row['id']))
        @method('put')
        @endif

        <div class="row">
            <div class="col-md-6">
                <div class="form-group files">

                    @if (isset($row['front_image']))
                    <img src="{{ Storage::url($row['front_image']) }}" style="height: 150px; width:150px" alt="">
                    @endif

                    @if (isset($row['id']))
                    <h3 class="my-3">Update Front Side Image</h3>
                    @else
                    <h3 class="my-3">Upload Front Side Image </h3>
                    @endif

                    <input type="file" name="front_image" id="front_image" class="form-control">
                </div>
                <img src="" width="200" height="200" class="front_image_preview d-none mt-3 mx-2">

                <span class="text-danger">
                    @error('front_image')
                    {{$message}}
                    @enderror
                </span>
            </div>


            <div class="col-md-6">
                <div class="form-group files color">

                    @if (isset($row['back_image']))
                    <img src="{{ Storage::url($row['back_image']) }}" style="height: 150px; width:150px" alt="">
                    @endif

                    @if (isset($row['id']))
                    <h3 class="my-3">Update Back Side Image</h3>
                    @else
                    <h3 class="my-3">Upload Back Side Image</h3>
                    @endif

                    <input type="file" name="back_image" id="back_image" class="form-control">
                </div>
                <img src="" width="200" height="200" class="back_image_preview d-none mt-3 mx-2">

                <span class="text-danger">
                    @error('back_image')
                    {{$message}}
                    @enderror
                </span>
            </div>

            @if (isset($row['id']))
            <button type="submit" class="btn btn-dark mx-auto my-5 p-md-3 w-50" data-mdb-ripple-init>Update
                Card</button>

            @else
            <button type="submit" class="btn btn-dark mx-auto my-5 p-md-3 w-50" data-mdb-ripple-init>Upload
                Card</button>

            @endif
        </div>
    </form>

</div>

@endsection