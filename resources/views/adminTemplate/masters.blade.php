<!DOCTYPE html>
<html dir="ltr" lang="en">

<head>
    @include('admintemplate.head')
</head>

<body>
    {{-- ============================== loader ================================== --}}
    {{-- <div class="preloader">
        <div class="lds-ripple">
            <div class="lds-pos"></div>
            <div class="lds-pos"></div>
        </div>
    </div> --}}


    <div id="main-wrapper" data-layout="vertical" data-navbarbg="skin5" data-sidebartype="full"
        data-sidebar-position="absolute" data-header-position="absolute" data-boxed-layout="full">
        <!-- ============================================================== -->
        <!-- Topbar header - style you can find in pages.scss -->
        <!-- ============================================================== -->
        @include('adminTemplate.topNav')


        <!-- ============================================================== -->
        <!-- End Topbar header -->
        <!-- ============================================================== -->
        @include('adminTemplate.sideNav')
        <!-- ============================================================== -->
        <!-- Page wrapper  -->
        <!-- ============================================================== -->
        <div class="page-wrapper" style="min-height: 478px;">
            <!-- ============================================================== -->
            <!-- Container fluid  -->
            <!-- ============================================================== -->
            <div class="container-fluid">
                <!-- ============================================================== -->
                <!-- Start Page Content -->
                <!-- ============================================================== -->
                <div class="row">
                    <div class="col-md-12">
                        <div class="white-box">
                            @yield('content')
                        </div>
                    </div>
                </div>
            </div>
            <!-- ============================================================== -->
            <!-- footer -->
            <!-- ============================================================== -->
        </div>
        <footer class="footer text-center"> 2021 © Ample Admin brought to you by <a
                href="https://www.wrappixel.com/">wrappixel.com</a>
        </footer>
    </div>

    @include('admintemplate.scripts')



</body>

</html>