<!DOCTYPE html>
<html lang="pt_br">

<head>
    <meta charset="UTF-8">
    <title>Biblioteca IFPR</title>
    <link rel="stylesheet" href="{{ asset('storage/bootstrap/bootstrap.min.css') }}">
    <link rel="stylesheet" href="{{ asset('storage/fontawesome/css/all.min.css') }}">
    <link rel="shortcut icon" href="{{ asset('storage/images/ifpr-icon.png') }}" type="image/png">
</head>

<body>
    @yield('content')

    <script src="{{ asset('storage/bootstrap/bootstrap.bundle.min.js') }}">
    </script>
</body>

</html>
