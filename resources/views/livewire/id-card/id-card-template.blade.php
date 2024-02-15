<div class="side-nav col-3 px-4 py-4 min-vh-100">
    <div class="row row-cols-1 row-cols-md-2 g-4">
        @foreach ($cards as $card)
        <div class="col" wire:click="asignIdCard({{$card->id}})">
            <div class="card h-100" role="button">
                <img src="{{Storage::url($card->front_image)}}" height="200px" width="100%"
                    class="card-img {{$card->id==$selectedCard ? 'active-card' : ''}}" alt="card-image">
            </div>
        </div>
        @endforeach
    </div>
</div>