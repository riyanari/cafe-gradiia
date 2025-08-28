<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8" />
    <meta http-equiv="X-UA-Compatible" content="IE=edge" />
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no" />
    <meta name="description" content="" />
    <meta name="author" content="" />
    <title>@yield('title') - CafeMyU</title>
    <link href="https://cdn.jsdelivr.net/npm/simple-datatables@7.1.2/dist/style.min.css" rel="stylesheet" />
    <link href="{{ asset('/sb/css/styles.css') }}" rel="stylesheet" />
    <script src="https://use.fontawesome.com/releases/v6.3.0/js/all.js" crossorigin="anonymous"></script>
</head>

<body class="sb-nav-fixed">
    @include('admin.layouts.header')
    <div id="layoutSidenav">
        @include('admin.layouts.sidenav')
        <div id="layoutSidenav_content">
            <main>
                @yield('content')

            </main>
            <footer class="py-4 bg-light mt-auto">
                @include('admin.layouts.footer')
            </footer>
        </div>
    </div>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/js/bootstrap.bundle.min.js" crossorigin="anonymous"></script>
    <script src="{{ asset('/sb/js/scripts.js') }}"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/Chart.js/2.8.0/Chart.min.js" crossorigin="anonymous"></script>
    <script src="{{ asset('/sb/assets/demo/chart-area-demo.js') }} "></script>
    <script src="{{ asset('/sb/assets/demo/chart-bar-demo.js') }} "></script>
    <script src="https://cdn.jsdelivr.net/npm/simple-datatables@7.1.2/dist/umd/simple-datatables.min.js" crossorigin="anonymous"></script>
    <script src="{{ asset('/sb/js/datatables-simple-demo.js') }} "></script>
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
    <!-- <script src="@@path/vendor/choices.js/public/assets/scripts/choices.min.js"></script> -->
    <!-- <link type="text/css" href="@@path/vendor/choices.js/public/assets/styles/choices.min.css" rel="stylesheet"> -->

    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/choices.js@9.0.1/public/assets/styles/choices.min.css" />
    <script src="https://cdn.jsdelivr.net/npm/choices.js@9.0.1/public/assets/scripts/choices.min.js"></script>

    @if($message = Session::get('success'))
    <script>
        Swal.fire({
            title: "Sukses!!!",
            text: "{{$message}}",
            icon: "success"
        });
    </script>
    @endif

    @if($message = Session::get('error'))
    <script>
        Swal.fire({
            title: "error!!!",
            text: "{{$message}}",
            icon: "error"
        });
    </script>
    @endif

</body>

</html>