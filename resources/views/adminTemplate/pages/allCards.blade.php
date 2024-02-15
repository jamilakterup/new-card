@extends('adminTemplate.masters')

@section('content')
<h2>All cardse</h2>

<table class="table text-center table-hover">
    <thead>
        <tr>
            <th scope="col">#</th>
            <th scope="col">Front Page</th>
            <th scope="col">Back Page</th>
            <th scope="col">Handle</th>
        </tr>
    </thead>
    <tbody>
        @foreach($cards as $key=>$card)
        <tr>
            <td>
                <div class="mt-5">{{$key+1}}</div>
            </td>
            <td><img src="{{Storage::url($card->front_image)}}" style="height: 150px; width:150px" alt=""></td>
            <td><img src=" {{Storage::url($card->back_image)}}" style="height: 150px; width:150px" alt=""></td>
            <td>
                <a href="{{route('dashboard.edit',$card->id)}}" class="btn btn-success mt-5">Edit</a>

                <button onclick="deleteRow('delete-form-{{$card->id}}')" type="button"
                    class="btn btn-danger">Delete</button>

                <form action="{{route('dashboard.destroy',$card->id)}}" id="delete-form-{{$card->id}}" method="POST">
                    @csrf
                    @method('delete')
                </form>
            </td>
        </tr>

        @endforeach

    </tbody>
</table>

@endsection