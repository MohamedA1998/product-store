<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">

        @vite(['resources/js/app.js'])
        <title>Ecommerce | {{ $title ?? 'Dashboard' }}</title>
    </head>
    <body>
        
        <!--wrapper-->
        <div class="wrapper">
            <!--sidebar wrapper -->
            @include('admin.particles.sidebar')
            <!--end sidebar wrapper -->

            <!--start header -->
            @include('admin.particles.header')
            <!--end header -->

            <!--start page wrapper -->
            {{ $slot }}
            <!--end page wrapper -->
            
            <!--start overlay-->
            <div class="overlay toggle-icon"></div>
            <!--end overlay-->
            <!--Start Back To Top Button-->
            <a href="javaScript:;" class="back-to-top"><i class='bx bxs-up-arrow-alt'></i></a>
            <!--End Back To Top Button-->
            <footer class="page-footer">
                <p class="mb-0">Copyright © 2024. All right reserved.</p>
            </footer>
        </div>
        <!--end wrapper-->
        
        <!--plugins-->
        <script src="{{ asset('assets/js/jquery.min.js') }}"></script>
        <script src="{{ asset('assets/js/metisMenu.min.js') }}"></script>
        <script src="{{ asset('assets/js/perfect-scrollbar.js') }}"></script>
        <script src="{{ asset('assets/js/jquery.dataTables.min.js') }}"></script>
        <script src="{{ asset('assets/js/dataTables.bootstrap5.min.js') }}"></script>
        <script>
            $(document).ready(function() {
                $('#example').DataTable();
            } );
        </script>
        <!--app JS-->
        <script src="{{ asset('assets/js/app.js') }}"></script>
    </body>
</html>
