<!DOCTYPE html>
<html lang="pt-br">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Dashboard</title>
    <link rel="stylesheet" href="{{ asset('asset/css/dashboard.css') }}">
    <link rel="stylesheet" href="{{ asset('asset/css/model.css') }}">
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
</head>

<body>
    <div class="dashboard">
        <header>
            <h1>Dashboard</h1>
        </header>
        <div class="button-logout">
            <a href="">
                <form action="{{ route('logout') }}" method="POST">
                    @csrf
                    <button type="submit" class="btn tbn-danger"> </button>
                </form>
            </a>
        </div>

        <section class="body">
            <div class="body__Atributos">
                <ol>
                    <li onclick="openModal('Clientes')">Clientes</li>
                    <li onclick="openModal('Funcionários')">Funcionários</li>
                    <li onclick="openModal('Pagamentos')">Pagamentos</li>
                    <li onclick="openModal('Sessões')">Sessões</li>
                </ol>
            </div>
        </section>



</body>

</html>
