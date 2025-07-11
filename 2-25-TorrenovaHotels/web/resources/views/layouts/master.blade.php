<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>@yield('title')</title>
    @vite(['resources/css/main.scss', 'resources/js/app.js'])
</head>

<body >
        <x-header />
    <main>
        @yield('content')
    </main>

</body>

</html>
