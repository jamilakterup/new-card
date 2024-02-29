<!DOCTYPE html>
<html lang="en">

<head>
    @include('userTemplate.head')
</head>

<body>

    @include('userTemplate.navBar')

    <div style="min-height:495px">
        @yield('content')
    </div>

    @include('userTemplate.footer')
    @include('userTemplate.scripts')
</body>

</html>