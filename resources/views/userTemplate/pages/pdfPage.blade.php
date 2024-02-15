@extends('userTemplate.masters')

@section('content')

<div class="col-md-6 mx-auto text-center">
    <div class="form-group files">
        <h3 class="my-3">Upload CSV File Here</h3>
        <form action="{{route('/pdf')}}" method="POST" enctype="multipart/form-data">
            @csrf
            <input type="hidden" value="{{$card_id}}" name="card_id">
            <input type="file" name="csv" id="csv" class="form-control" accept=".csv">
            <button type="submit" class="btn btn-success px-5 py-3 my-4">Generate Card</button>
        </form>
    </div>
</div>

@endsection