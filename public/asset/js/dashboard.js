// scripts.js

// Dados de exemplo
const data = {
    funcionarios: 150,
    clientes: 250,
    sessoes: 1200,
    sessoesPorFuncionario: [200, 300, 400, 300, 100, 200],
    sessoesPorCliente: [50, 80, 100, 70, 150],
  };

  // Atualizando os valores no HTML
  document.getElementById('funcionarios-count').textContent = data.funcionarios;
  document.getElementById('clientes-count').textContent = data.clientes;
  document.getElementById('sessao-count').textContent = data.sessoes;

  // Gráfico de sessões
  const ctxSessions = document.getElementById('sessionsChart').getContext('2d');
  const sessionsChart = new Chart(ctxSessions, {
    type: 'bar',
    data: {
      labels: ['Jan', 'Fev', 'Mar', 'Abr', 'Mai', 'Jun'],
      datasets: [{
        label: 'Sessões por Mês',
        data: data.sessoesPorFuncionario,
        backgroundColor: '#4e73df',
        borderColor: '#4e73df',
        borderWidth: 1
      }]
    },
    options: {
      responsive: true,
      scales: {
        x: {
          beginAtZero: true
        },
        y: {
          beginAtZero: true
        }
      }
    }
  });

  // Gráfico de sessões por cliente
  const ctxEmployees = document.getElementById('employeesChart').getContext('2d');
  const employeesChart = new Chart(ctxEmployees, {
    type: 'pie',
    data: {
      labels: ['Cliente 1', 'Cliente 2', 'Cliente 3', 'Cliente 4', 'Cliente 5'],
      datasets: [{
        label: 'Sessões por Cliente',
        data: data.sessoesPorCliente,
        backgroundColor: ['#1cc88a', '#36b9cc', '#f6c23e', '#e74a3b', '#858796'],
        borderWidth: 0
      }]
    }
  });
