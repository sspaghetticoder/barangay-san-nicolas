<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Document</title>

    <link rel="stylesheet" href="{{ asset('css/css@googlefonts.css') }}">
    <link rel="stylesheet" href="{{ mix('css/app.css') }}">
</head>
<body style="height: 100%; width: 100%">
    @yield('content')
</body>
</html>