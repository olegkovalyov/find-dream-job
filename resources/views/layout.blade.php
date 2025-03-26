<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link
        rel="stylesheet"
        href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.2/css/all.min.css"
        integrity="sha512-z3gLpd7yknf1YoNbCzqRKc4qyor8gaKU1qmn+CShxbuBusANI9QpRohGBreCFkKxLhei6S9CQXFEbbKuqLg0DA=="
        crossorigin="anonymous"
        referrerpolicy="no-referrer"
    />
    <script src="//unpkg.com/alpinejs" defer></script>
    @vite('resources/css/app.css')
    @vite('resources/js/top-menu.js')
    @vite('resources/js/alert-notification.js')
    <title>{{ isset($title) ? 'Find Your Dream Job | ' . $title :  'Find Your Dream Job' }}</title>
    <!-- Fonts -->
    <link rel="preconnect" href="https://fonts.bunny.net">
    <link href="https://fonts.bunny.net/css?family=instrument-sans:400,500,600" rel="stylesheet"/>
</head>
    <body class="bg-gray-100">
        <x-header/>
        @if(request()->is('/'))
            <x-home-page-bg />
            <x-home-page-top-banner />
        @endif
        <main class="container mx-auto pr mt-4">
            @if(session('success'))
                <x-alert type="success" message="{{session('success')}}" />
            @endif
            @if(session('error'))
                <x-alert type="error" message="{{session('error')}}" />
            @endif
            {{ $slot }}
        </main>
    </body>
</html>
