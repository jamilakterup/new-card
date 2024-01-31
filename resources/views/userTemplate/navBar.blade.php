{{-- top navigation bar:: --}}
<nav class="navbar">
    <div class="container-fluid px-4">
        <a class="navbar-brand text-white">CARD GENERATOR</a>
        <form action="{{route('logout')}}" method="POST">
            @csrf
            <button type="submit" class="btn bg-light-subtle" data-mdb-ripple-init>LOG-OUT</button>
        </form>
    </div>
</nav>