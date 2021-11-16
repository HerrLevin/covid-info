<?php
$risks = ['bg-green-500', 'bg-yellow-500', 'bg-red-600', 'bg-red-900', 'bg-black'];

$bodyClass = $risks[$risk];

?>
<!DOCTYPE html>
<html lang="{{ $page->language ?? 'en' }}">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <link rel="canonical" href="{{ $page->getUrl() }}">
        <meta name="description" content="{{ $page->description }}">
        <title>{{ $page->title }}</title>
        <link rel="stylesheet" href="{{ mix('css/main.css', 'assets/build') }}">
        <script defer src="{{ mix('js/main.js', 'assets/build') }}"></script>
    </head>
    <body class="text-white font-sans antialiased {{$bodyClass}}">
    <div class="p-8">
        <section class="text-9xl"><i class="@yield('icon')"></i></section>
        <h2 class="text-7xl">@yield('smallHeading')</h2>
        <h1 class="text-9xl">@yield('heading') <strong class="font-mono">@yield('number')</strong></h1>
        <span class="text-3xl">@yield('info')</span>
    </div>
    </body>
</html>
