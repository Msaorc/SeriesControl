<!DOCTYPE html>
<html lang="pt-BR">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>@yield('titulo')</title>
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.4.1/css/bootstrap.min.css" integrity="sha384-Vkoo8x4CGsO3+Hhxv8T/Q5PaXtkKtu6ug5TOeNV6gBiFeWPGFN9MuhOf23Q9Ifjh" crossorigin="anonymous">
    <script src="https://kit.fontawesome.com/a2d2c532cb.js" crossorigin="anonymous"></script>
</head>
<body>
    <nav class="navbar navbar-expand-lg navbar-light bg-light mb-2 d-flex justify-content-between">
        <a class="navbar-brand" href="{{ route('listar_series') }}">Home</a>
        @auth
            <a href="/sair" class="text-danger">Sair</a>            
        @endauth

        @guest
            <a href="/entrar">Entrar</a>
        @endguest
    </nav>

    <div class="container">
        <div class="jumbotron" style="background: #00BFFF">
            <h1 style="color:#808080">@yield('cabecalho')</h1>
        </div>

        @yield('conteudo')
    </div>    
</body>
</html>