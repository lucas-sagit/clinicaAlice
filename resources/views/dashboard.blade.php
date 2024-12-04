<!DOCTYPE html>
<html lang="pt-br">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Dashboard</title>
  <link rel="stylesheet" href="{{ asset('asset/css/dashboard.css') }}">
  <link rel="stylesheet" href="{{ asset('asset/css/model.css') }}">
  <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
</head>
<body>
  <div class="dashboard">
    <header>
      <h1>Dashboard</h1>
    </header>

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

    <!-- Modal -->
    <div id="myModal" class="modal">
      <div class="modal-content">
        <span class="close" onclick="closeModal()">&times;</span>
        <h2 id="modal-title">Título do Modal</h2>
        <p id="modal-content">Conteúdo do modal...</p>
      </div>
    </div>

  </div>
  {{-- <script src="{{ asset('js/bootstrap.bundle.min.js') }}"></script> --}}
  <script>
    // Função para abrir o modal
    function openModal(attribute) {
      var modal = document.getElementById("myModal");
      var title = document.getElementById("modal-title");
      var content = document.getElementById("modal-content");

      title.textContent = attribute;  // Atualiza o título com o nome do atributo
      content.textContent = "Aqui você pode mostrar informações sobre " + attribute + ".";  // Conteúdo dinâmico do modal

      modal.style.display = "block";  // Torna o modal visível
    }

    // Função para fechar o modal
    function closeModal() {
      var modal = document.getElementById("myModal");
      modal.style.display = "none";  // Torna o modal invisível
    }

    // Fechar o modal clicando fora da área de conteúdo
    window.onclick = function(event) {
      var modal = document.getElementById("myModal");
      if (event.target == modal) {
        modal.style.display = "none";
      }
    }
  </script>
</body>
</html>
