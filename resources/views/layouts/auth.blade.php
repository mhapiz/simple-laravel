<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="{{ asset('assets/css/style.css') }}">
    <link href='https://unpkg.com/boxicons@2.0.7/css/boxicons.min.css' rel='stylesheet'>
    @stack('tambahStyle')
    <title>
        @yield('title')
    </title>
</head>

<body>

    @yield('content')

    <script src="{{ asset('assets/js/script.js') }}"></script>
    @stack('tambahScript')
</body>

</html>
