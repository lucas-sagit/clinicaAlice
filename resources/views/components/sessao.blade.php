<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Painel de Sessão</title>
    <!-- Bootstrap CSS -->
    <link href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.0/css/bootstrap.min.css" rel="stylesheet">
</head>
<body>

    <div class="container mt-5">
        <h1>Painel de Sessão</h1>

        <!-- Botões para ações -->
        <button class="btn btn-primary" data-toggle="modal" data-target="#addModal">Adicionar Sessão</button>

        <!-- Tabela de sessões -->
        <table class="table mt-3">
            <thead>
                <tr>
                    <th>#</th>
                    <th>Nome do paciente</th>
                    <th>CPF</th>
                    <th>Sessões Pagas</th>
                    <th>Sessões Faltas</th>
                    <th>Ações</th>
                </tr>
            </thead>
            <tbody id="sassaoTable">
                <!-- Dados da sessão serão carregados aqui -->
            </tbody>
        </table>
    </div>

    <!-- Modal de Adicionar Sessão -->
    <div class="modal fade" id="addModal" tabindex="-1" role="dialog" aria-labelledby="addModalLabel" aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="addModalLabel">Adicionar Sessão</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <form id="addSessaoForm" action="{{ route('sessao.store') }}"  method="POST">
                        @csrf
                        <div class="form-group">
                            <label for="nome">Nome do Paciente</label>
                            <input type="text" class="form-control" id="nome" required>
                        </div>
                        <div class="form-group">
                            <label for="cpf">CPF</label>
                            <input type="text" class="form-control" id="cpf" required>
                        </div>
                        <div class="form-group">
                            <label for="sessaoPaga">Sessões Pagas</label>
                            <input type="number" class="form-control" id="sessaoPaga" required>
                        </div>
                        <div class="form-group">
                            <label for="sessaoFalta">Sessões Faltas</label>
                            <input type="number" class="form-controlmodel" id="sessaoFalta" required>
                        </div>
                        <button type="submit" class="btn btn-primary">Salvar</button>
                    </form>
                </div>
            </div>
        </div>
    </div>

    <!-- Modal de Editar Sessão -->
    <div class="modal fade" id="editModal" tabindex="-1" role="dialog" aria-labelledby="editModalLabel" aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="editModalLabel">Editar Sessão</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <form id="editSessaoForm">
                        <div class="form-group">
                            <label for="editNome">Nome do Paciente</label>
                            <input type="text" class="form-control" id="editNome" required>
                        </div>
                        <div class="form-group">
                            <label for="editCpf">CPF</label>
                            <input type="text" class="form-control" id="editCpf" required>
                        </div>
                        <div class="form-group">
                            <label for="editSessaoPaga">Sessões Pagas</label>
                            <input type="number" class="form-control" id="editSessaoPaga" required>
                        </div>
                        <div class="form-group">
                            <label for="editSessaoFalta">Sessões Faltas</label>
                            <input type="number" class="form-control" id="editSessaoFalta" required>
                        </div>
                        <input type="hidden" id="editSessaoId">
                        <button type="submit" class="btn btn-primary">Salvar Alterações</button>
                    </form>
                </div>
            </div>
        </div>
    </div>

    <!-- Bootstrap JS -->
    <script src="https://code.jquery.com/jquery-3.5.1.slim.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.5.2/dist/umd/popper.min.js"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.0/js/bootstrap.min.js"></script>

    <script>
        // Exemplo de dados (simulando sessões)
        function applyMask(input, mask) {
            let value = input.value.replace(/\D/g, '');
            let i = 0;
            input.value = mask.replace(/0/g, () => value[i++] || '');
        }

        document.getElementById('cpf').addEventListener('input', function() {
            applyMask(this, '000.000.000-00');
        });

        document.getElementById('editCpf').addEventListener('input', function() {
            applyMask(this, '000.000.000-00');
        });

        function renderTable() {
            const tableBody = document.getElementById('sassaoTable');
            tableBody.innerHTML = '';
            sessao.forEach(sessao => {
                const row = document.createElement('tr');
                row.innerHTML = `
                    <td>${sessao.id}</td>
                    <td>${sessao.nome}</td>
                    <td>${sessao.cpf}</td>
                    <td>${sessao.sessaoPaga}</td>
                    <td>${sessao.sessaoFalta}</td>
                    <td>
                        <button class="btn btn-warning btn-sm" onclick="editSessao(${sessao.id})">Editar</button>
                        <button class="btn btn-danger btn-sm" onclick="deleteSessao(${sessao.id})">Deletar</button>
                    </td>
                `;
                tableBody.appendChild(row);
            });
        }

        function editSessao(id) {
            const sessao = sessoes.find(f => f.id === id);
            document.getElementById('editSessaoId').value = sessao.id;
            document.getElementById('editNome').value = sessao.nome;
            document.getElementById('editCpf').value = sessao.cpf;
            document.getElementById('editSessaoPaga').value = sessao.sessaoPaga;
            document.getElementById('editSessaoFalta').value = sessao.sessaoFalta;

            $('#editModal').modal('show');
        }

        function deleteSessao(id) {
            const index = sessoes.findIndex(f => f.id === id);
            if (index > -1) {
                sessoes.splice(index, 1);
                renderTable();
            }
        }

        document.getElementById('addSessaoForm').addEventListener('submit', function(event) {
            event.preventDefault();
            const nome = document.getElementById('nome').value;
            const cpf = document.getElementById('cpf').value;
            const sessaoPaga = document.getElementById('sessaoPaga').value;
            const sessaoFalta = document.getElementById('sessaoFalta').value;

            const new sessao = {
                id: sessoes.length + 1,
                nome,
                cpf,
                sessaoPaga,
                sessaoFalta,
            };

            sessoes.push(new sessao);
            renderTable();
            $('#addModal').modal('hide');
        });

        document.getElementById('editSessaoForm').addEventListener('submit', function(event) {
            event.preventDefault();
            const id = document.getElementById('editSessaoId').value;
            const nome = document.getElementById('editNome').value;
            const cpf = document.getElementById('editCpf').value;
            const sessaoPaga = document.getElementById('editSessaoPaga').value;
            const sessaoFalta = document.getElementById('editSessaoFalta').value;

            const sessao = sessoes.find(f => f.id === parseInt(id));
            sessao.nome = nome;
            sessao.cpf = cpf;
            sessao.sessaoPaga = sessaoPaga;
            sessao.sessaoFalta = sessaoFalta;

            renderTable();
            $('#editModal').modal('hide');
        });

        // Inicializa a tabela
        renderTable();
    </script>

</body>
</html>
