{{-- top navigation bar:: --}}
<nav class="navbar bg-light">
    <div class="container-fluid px-4">
        <div class="d-flex align-items-center">
            <a class="navbar-brand text-dark">CARD GENERATOR</a>
            <a href="{{url('/')}}" class="text-success ms-4 px-3">Home</a>
            <a href="{{url('design')}}" class="text-success ms-4 px-3">Design</a>
            <a href="{{url('dashboard')}}" class="text-success px-3">Dashboard</a>
        </div>
        <form action="{{route('logout')}}" method="POST">
            @csrf
            <button type="submit" class="btn btn-secondary" data-mdb-ripple-init>LOG-OUT</button>
        </form>
    </div>
</nav>