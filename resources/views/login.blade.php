<!DOCTYPE html>
<html lang="pt-br">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="{{ asset('asset/css/login.css') }}">

    <title>login</title>
</head>


<body>
    <div class="login">
        <div class="login__Titulo">
            <h1>Faça login</h1>
        </div>
        <form action="{{ route('login') }}" method="POST">
            @csrf
            <input type="text" name="cpf" id="cpf" value="{{old("cpf")}}" placeholder="Insira seu cpf">
            <input type="password" name="senha" id="senha" placeholder="Insira sua senha">
            <input type="submit" value="Login">
        </form>
    </div>
</body>

</html>
