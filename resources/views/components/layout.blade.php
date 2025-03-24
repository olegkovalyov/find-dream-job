<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <title>Find Your Dream Job</title>

    <!-- Fonts -->
    <link rel="preconnect" href="https://fonts.bunny.net">
    <link href="https://fonts.bunny.net/css?family=instrument-sans:400,500,600" rel="stylesheet"/>
</head>
    <body class="bg-gray-100">
        <x-header/>
        <h1>Layout Component</h1>
        <main class="container mx-auto pr mt-4">
            {{ $slot }}
        </main>
    </body>
</html>
