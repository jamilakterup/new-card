<!DOCTYPE html>
<html lang="en">

<head>
    @include('userTemplate.head')
</head>

<body>


    {{ $slot }}


    @include('userTemplate.scripts')
</body>

</html>