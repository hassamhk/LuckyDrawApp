<!DOCTYPE html>
<html>

<head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <link rel="icon" type="image/x-icon" href="{{ asset('favicon.ico') }}">

    <!-- External CSS Files -->
    <link rel="stylesheet" href="{{ asset('css/swiper.min.css') }}" />
    <link rel="stylesheet" href="{{ asset('css/tabler-icons.min.css') }}" />
    <link rel="stylesheet" href="{{ asset('css/style.css') }}" />
    <link rel="stylesheet" type="text/css"
        href="https://cdn.jsdelivr.net/npm/@phosphor-icons/web@2.1.1/src/regular/style.css" />
    <link rel="stylesheet" type="text/css"
        href="https://cdn.jsdelivr.net/npm/@phosphor-icons/web@2.1.1/src/fill/style.css" />
    <title>LuckyDraw - @yield('title')</title>
    <!-- Tailwind CSS CDN -->
    <script src="https://cdn.jsdelivr.net/npm/@tailwindcss/browser@4"></script>
</head>

<body class="bg-stone-100">
    <div class="flex h-screen">
        @include('backend.inc.sidebar')

        <!-- Main Content Section -->
        @yield('content')
    </div>

    <!-- External JavaScript Files -->
    <script src="{{ asset('js/jquery.js') }}"></script>
    <script src="{{ asset('js/swiper.min.js') }}"></script>
    {{-- <script src="{{asset('js/phosphor-icons.js')}}"></script> --}}
    <script src="{{ asset('js/script.js') }}"></script>
</body>

</html>
