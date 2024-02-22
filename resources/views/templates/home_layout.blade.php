<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <link rel="stylesheet" href="{{ asset('styles/nav.css') }}">
    <link rel="stylesheet" href="{{ asset('styles/footer.css') }}">
    <link rel="stylesheet" href="{{ asset('styles/home.css') }}">
    <link rel="stylesheet" href="{{ asset('styles/nova_tarefa.css') }}">
    <link rel="stylesheet" href="{{ asset('styles/home_layout.css') }}">
    <title>{{ $title }}</title>
    
    @if(!empty($datatables))
        <link rel="stylesheet" href="{{ asset('assets/datatables/datatables.min.css') }}">
        <script src="{{ asset('assets/datatables/jquery/jquery.min.js') }}"></script>
    @endif

</head>
<body>
    @include('nav')
    @yield('content')
    @include('footer')

    @if(!empty($datatables))
        <script src="{{ asset('assets/datatables/datatables.min.js') }}"></script>
    @endif
</body>
</html>
