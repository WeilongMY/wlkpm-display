<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <title>Laravel</title>

    <!-- Fonts -->
    <link href="https://fonts.googleapis.com/css2?family=Nunito:wght@400;600;700&display=swap" rel="stylesheet">

    <link href="/css/app.css" rel="stylesheet">
    @livewireStyles
</head>
<body class="antialiased" style="background: url('/img/skin/background.png')">
    {{ $slot }}
    @livewireScripts
</body>
</html>