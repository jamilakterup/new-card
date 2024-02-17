<!DOCTYPE html>
<html lang="en">

<head>
    @include('userTemplate.head')
</head>

<body>

    @include('userTemplate.navBar')

    @yield('content')


    @include('userTemplate.scripts')
</body>

</html>