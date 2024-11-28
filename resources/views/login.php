<link rel="stylesheet" href="{{asset('asset/css/welcome.css')}}">

<div class="login">
    <div class="login__Titulo">
        <h1>Faça login<h1>
    </div>
        <form action="{{ route('login') }}" method="POST">
            <input type="text" id="cpf" placeholder="Insira seu cpf">
            <input type="password" id="password" placeholder="Insira sua senha">
            <input type="submit" value="Login">
        </form>
</div>

