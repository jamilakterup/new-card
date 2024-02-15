{{-- top navigation bar:: --}}
<header class="topbar" data-navbarbg="skin5">
    <nav class="d-flex justify-content-between align-items-center pt-2 px-4">
        <a class="text-danger fs-3" href="dashboard.html">CARD GENERATOR</a>
        <!-- ============================================================== -->
        <!-- End Logo -->
        <form action="{{route('logout')}}" method="POST">
            @csrf
            <button type="submit" class="btn btn-secondary" data-mdb-ripple-init>LOG-OUT</button>
        </form>
    </nav>
</header>