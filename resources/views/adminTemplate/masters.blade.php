<!DOCTYPE html>
<html dir="ltr" lang="en">

<head>
    @include('admintemplate.head')
</head>

<body>
    @include('adminTemplate.topNav')

    <div id="main-wrapper" data-layout="vertical">

        @include('adminTemplate.sideNav')

        <div class="page-wrapper" style="min-height: 478px;">
            <div class="container-fluid">
                <div class="row">
                    <div class="col-md-12">
                        <div class="white-box">
                            @yield('content')
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <footer class="footer text-center"> 2©24 All rights reserves by <a href="https://www.rajit.com/">RajIT</a>
        </footer>
    </div>

    @include('admintemplate.scripts')



</body>

</html>