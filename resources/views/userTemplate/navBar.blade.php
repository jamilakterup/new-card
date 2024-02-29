{{-- top navigation bar:: --}}
<nav class="navbar bg-light">
    <div class="container-fluid px-4">
        <div class="d-flex align-items-center">
            <a class="navbar-brand text-dark">CARD GENERATOR</a>
            <a href="{{url('/')}}" class="btn btn-link text-success ms-4 px-3">Home</a>
            <a href="{{url('card/mapping')}}" class="btn btn-link text-success ms-4 px-3">Card Mapping</a>
            <a href="{{url('dashboard')}}" class="btn btn-link text-success px-3">Dashboard</a>
            <div class="dropdown px-3">
                <button class="btn btn-link text-success dropdown-toggle" type="button" data-bs-toggle="dropdown"
                    aria-expanded="false">
                    Select Template
                </button>
                <ul class="dropdown-menu">
                    @php
                    $cardInfos=App\Models\CardInfo::all();
                    @endphp
                    @foreach($cardInfos as $cardInfo)
                    <li><a class="dropdown-item"
                            href="{{url('design/pdf/'.$cardInfo->card_id)}}">{{$cardInfo->card->card_title}}</a></li>
                    @endforeach
                </ul>
            </div>
        </div>

        @if (Route::has('login'))
        @auth
        <form action="{{route('logout')}}" method="POST">
            @csrf
            <button type="submit" class="btn btn-secondary" data-mdb-ripple-init>LOG-OUT</button>
        </form>
        @else
        <a href="{{ route('login') }}" class="btn btn-outline-secondary">Log
            in</a>
        @endauth
        @endif
    </div>
</nav>