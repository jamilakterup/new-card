@extends('adminTemplate.masters')

@section('content')

<div class="container">
    <form action="{{ isset($row['id']) ? route('dashboard.update', $row['id']) : route('dashboard.store') }}"
        method="post" enctype="multipart/form-data">
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
                    <h3 class="my-3">Update Front Template</h3>
                    @else
                    <h3 class="my-3">Upload Front Template</h3>
                    @endif

                    <input type="file" name="front_image" id="front_image" class="form-control"
                        accept=".jpg,.png,.jpeg">

                    {{-- error message show --}}
                    <span class="text-danger">
                        @error('front_image')
                        {{$message}}
                        @enderror
                    </span>
                </div>


                <div>
                    @if (isset($row['id']))
                    <h3 class="my-4">Update Front Template</h3>
                    @else
                    <h4 class="my-4">Upload Front Template (PDF)</h4>
                    @endif
                    <input type="file" name="front_pdf" id="front_pdf" class="form-control" accept=".pdf">

                    {{-- error message show --}}
                    <span class="text-danger">
                        @error('front_pdf')
                        {{$message}}
                        @enderror
                    </span>
                </div>

                <img src="" width="200" height="200" class="front_image_preview d-none mt-3 mx-2">
            </div>


            <div class="col-md-6">
                <div class="form-group files color">
                    @if (isset($row['back_image']))
                    <img src="{{ Storage::url($row['back_image']) }}" style="height: 150px; width:150px" alt="">
                    @endif

                    @if (isset($row['id']))
                    <h3 class="my-3">Update Back Template</h3>
                    @else
                    <h3 class="my-3">Upload Back Template</h3>
                    @endif

                    <input type="file" name="back_image" id="back_image" class="form-control" accept=".jpg,.png,.jpeg">

                    {{-- error message show --}}
                    <span class="text-danger">
                        @error('back_image')
                        {{$message}}
                        @enderror
                    </span>
                </div>

                <div>
                    @if (isset($row['id']))
                    <h3 class="my-4">Update Back Template (PDF)</h3>
                    @else
                    <h4 class="my-4">Upload Back Template (PDF)</h4>
                    @endif
                    <input type="file" name="back_pdf" id="back_pdf" class="form-control" accept=".pdf">

                    {{-- error message show --}}
                    <span class="text-danger">
                        @error('back_pdf')
                        {{$message}}
                        @enderror
                    </span>
                </div>

                <img src="" width="200" height="200" class="back_image_preview d-none mt-3 mx-2">
            </div>

            @if (isset($row['id']))
            <button type="submit" class="btn btn-success mx-auto my-5 p-md-3 w-50" data-mdb-ripple-init>Update
                Template</button>

            @else
            <button type="submit" class="btn btn-success mx-auto my-5 p-md-3 w-50" data-mdb-ripple-init>Upload
                Template</button>

            @endif
        </div>
    </form>

</div>

@endsection