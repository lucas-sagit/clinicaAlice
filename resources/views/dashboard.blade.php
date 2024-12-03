<!DOCTYPE html>
<html lang="pt-br">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Dashboard</title>
  <link rel="stylesheet" href="{{ asset('asset/css/dashboard.css') }}">
  <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
</head>
<body>
  <div class="dashboard">
    <header>
      <h1>Dashboard de Desempenho</h1>
    </header>

    <section class="stats">
      <div class="card">
        <h2>Funcionários</h2>
        <p id="funcionarios-count">150</p>
      </div>
      <div class="card">
        <h2>Clientes</h2>
        <p id="clientes-count">250</p>
      </div>
      <div class="card">
        <h2>Sessões</h2>
        <p id="sessao-count">1200</p>
      </div>
    </section>

    <section class="charts">
      <canvas id="sessionsChart"></canvas>
      <canvas id="employeesChart"></canvas>
    </section>
  </div>

  <script></script>
  </body>
</html>
