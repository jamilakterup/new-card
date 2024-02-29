<!DOCTYPE html>
<html lang="en">

<head>
    @include('userTemplate.head')
</head>

<body>
    @include('userTemplate.navbar')

    {{ $slot }}


    @include('userTemplate.scripts')
</body>

</html>