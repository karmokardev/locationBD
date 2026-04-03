<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>@yield('title') | {{ config('app.name') }}</title>

    <link rel="icon" type="image/x-icon" href="{{ asset('assets/bd.png') }}">

    @vite(['resources/css/app.css', 'resources/js/app.js'])
    @include('pwa::header')
</head>

<body class="min-h-screen bg-background">

    <!-- Navbar -->
    <!-- @include('components.navbar') -->

    <main class="">
        @hasSection('breadcrumb')
            @include('components.common.breadcrumb')
        @endif
        @yield('content')
    </main>

    <!-- Footer -->
    <!-- @include('components.footer') -->
</body>

</html>
