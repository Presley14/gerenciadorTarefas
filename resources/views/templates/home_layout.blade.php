<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <link rel="stylesheet" href="{{ asset('styles/desktop/nav.css') }}">
    <link rel="stylesheet" href="{{ asset('styles/desktop/footer.css') }}">
    <link rel="stylesheet" href="{{ asset('styles/desktop/home.css') }}">
    <link rel="stylesheet" href="{{ asset('styles/desktop/nova_tarefa.css') }}">
    <link rel="stylesheet" href="{{ asset('styles/desktop/home_layout.css') }}">
    <link rel="stylesheet" href="{{ asset('styles/desktop/excluir_tarefa.css') }}">

    <link rel="stylesheet" href="{{ asset('styles/tablet/nav.css') }}">
    <link rel="stylesheet" href="{{ asset('styles/tablet/footer.css') }}">
    <link rel="stylesheet" href="{{ asset('styles/tablet/home.css') }}">
    <link rel="stylesheet" href="{{ asset('styles/tablet/nova_tarefa.css') }}">
    <link rel="stylesheet" href="{{ asset('styles/tablet/excluir_tarefa.css') }}">

    <link rel="stylesheet" href="{{ asset('styles/cel/nav.css') }}">
    <link rel="stylesheet" href="{{ asset('styles/cel/footer.css') }}">
    <link rel="stylesheet" href="{{ asset('styles/cel/home.css') }}">
    <link rel="stylesheet" href="{{ asset('styles/cel/nova_tarefa.css') }}">
    <link rel="stylesheet" href="{{ asset('styles/cel/excluir_tarefa.css') }}">

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
