<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <meta name="csrf-token" value="{{ csrf_token() }}" />
    <title>Vue - tailwindcss</title>
    <link href="{{ asset('css/app.css') }}" rel="stylesheet">
    @laravelPWA
</head>

<body class="bg-green-400">
    <div id="app">
        @yield('content')
    </div>
    <script src="https://cdn.tailwindcss.com"></script>
    @vite('resources/js/app.js')
</body>

</html>
