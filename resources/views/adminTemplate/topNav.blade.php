{{-- top navigation bar:: --}}
<header class="topbar" data-navbarbg="skin5">
    <nav class="navbar container-fluid px-4">
        <a href="">CARD GENERATOR</a>
        <form action="{{route('logout')}}" method="POST">
            @csrf
            <button type="submit" class="btn btn-light" data-mdb-ripple-init>LOG-OUT</button>
        </form>
    </nav>
</header>