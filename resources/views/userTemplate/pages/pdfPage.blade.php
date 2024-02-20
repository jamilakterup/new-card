@extends('userTemplate.masters')

@section('content')

<div class="form-group text-center col-10 mx-auto">
    <form action="{{route('/pdf')}}" method="POST" enctype="multipart/form-data">
        @csrf
        <input type="hidden" value="{{$card_id}}" name="card_id">
        <div class="row w-100">
            <div class="col my-3">
                <div class="csv-file">
                    <h3 class="my-3">Upload CSV File Here</h3>
                    <input type="file" name="csv" id="csv" class="form-control" accept=".csv">
                </div>
                @error('csv')
                <span class="text-danger">{{$message}}</span>
                @enderror
            </div>
            <div class="col my-3">
                <div class="multi-images">
                    <h3 class="my-3">Select Multiple Images</h3>
                    <input type="file" multiple name="images[]" id="images" class="form-control" accept=".jpg">
                </div>
                @error('images')
                <span class="text-danger">{{$message}}</span>
                @enderror
            </div>
        </div>
        <button type="submit" class="btn btn-success w-25 px-5 py-3 my-4">Generate Card</button>
    </form>
</div>

@endsection