{{-- resources/views/layouts/app.blade.php --}}
<!doctype html>
<html lang="id">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>@yield('title', 'App')</title>
    @yield('head')
    <link href="{{ asset('css/detailCafe.css') }}" rel="stylesheet" />
    <style>
        .object-fit-cover {
            object-fit: cover;
        }
    </style>
</head>

<body>
    @yield('content')
    @stack('scripts')
    @yield('scripts')
</body>

</html>
