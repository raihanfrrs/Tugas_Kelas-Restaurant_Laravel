<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Restaurant</title>

    <!-- ========== VENDOR CSS ========= -->
    <link rel="stylesheet" href="{{ asset('/') }}assets/vendor/bootstrap-5.2.2-dist/css/bootstrap.min.css" />
    <link rel="stylesheet" href="{{ asset('/') }}assets/vendor/lineicons/lineicons.css" />
    <link rel="stylesheet" href="{{ asset('/') }}assets/vendor/materialdesignicons/materialdesignicons.min.css" />
    <link rel="stylesheet" href="{{ asset('/') }}assets/vendor/datatables/css/datatables.min.css"/>
    <link rel="stylesheet" href="{{ asset('/') }}assets/vendor/sweetalert2/css/sweetalert2.min.css"/>

    <!-- ========== VENDOR JS ========= -->
    <script src="{{ asset('/') }}assets/vendor/sweetalert2/js/sweetalert2.min.js" type="text/javascript"></script>

    <!-- ========== MAIN CSS ========= -->
    <link rel="stylesheet" href="{{ asset('/') }}assets/css/main.css" />
</head>
<body>
    @auth
        @include('partials.sidebar')
    @endauth

    <main class="main-wrapper @guest ms-1 @endguest">
        @auth
            @include('partials.navbar')
        @endauth

        <section class="section">
            <div class="container-fluid">
                @include('partials.title-wrapper')
                
                @include('partials.flasher')

                @yield('section')
            </div>
        </section>

        @include('partials.footer')
    </main>
</body>
    <!-- ========== VENDOR JS ========= -->
    <script src="{{ asset('/') }}assets/vendor/bootstrap-5.2.2-dist/js/bootstrap.bundle.min.js" type="text/javascript"></script>
    <script src="{{ asset('/') }}assets/vendor/jquery/jquery-3.6.1.min.js" type="text/javascript"></script>
    <script src="{{ asset('/') }}assets/vendor/datatables/js/datatables.min.js" type="text/javascript"></script>

    <!-- ========== MAIN JS ========= -->
    <script src="{{ asset('/') }}assets/js/main.js" type="text/javascript"></script>
    <script src="{{ asset('/') }}assets/js/datatables.js" type="text/javascript"></script>
    <script src="{{ asset('/') }}assets/js/pre-image.js" type="text/javascript"></script>
</html>