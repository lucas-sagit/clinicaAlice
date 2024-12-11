<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Painel de Funcionários</title>
    <!-- Bootstrap CSS -->
    <link href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.0/css/bootstrap.min.css" rel="stylesheet">
</head>
<body>

    <div class="container mt-5">
        <h1>Painel de Funcionários</h1>

        <!-- Botões para ações -->
        <button class="btn btn-primary" data-toggle="modal" data-target="#addModal">Adicionar Funcionário</button>

        <!-- Tabela de funcionários -->
        <table class="table mt-3">
            <thead>
                <tr>
                    <th>#</th>
                    <th>Nome</th>
                    <th>CPF</th>
                    <th>Data de Nascimento</th>
                    <th>Ações</th>
                </tr>
            </thead>
            <tbody id="funcionarioTable">
                <!-- Os dados dos funcionários serão carregados aqui -->
            </tbody>
        </table>
    </div>

    <!-- Modal de Adicionar Funcionário -->
    <div class="modal fade" id="addModal" tabindex="-1" role="dialog" aria-labelledby="addModalLabel" aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="addModalLabel">Adicionar Funcionário</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <form id="addFuncionarioForm">
                        <div class="form-group">
                            <label for="nome">Nome</label>
                            <input type="text" class="form-control" id="nome" required>
                        </div>
                        <div class="form-group">
                            <label for="cpf">CPF</label>
                            <input type="text" class="form-control" id="cpf" required>
                        </div>
                        <div class="form-group">
                            <label for="dataNascimento">Data de Nascimento</label>
                            <input type="date" class="form-control" id="dataNascimento" required>
                        </div>
                        <button type="submit" class="btn btn-primary">Salvar</button>
                    </form>
                </div>
            </div>
        </div>
    </div>

    <!-- Modal de Editar Funcionário (similar ao de Adicionar) -->
    <div class="modal fade" id="editModal" tabindex="-1" role="dialog" aria-labelledby="editModalLabel" aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="editModalLabel">Editar Funcionário</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <form id="editFuncionarioForm">
                        <div class="form-group">
                            <label for="editNome">Nome</label>
                            <input type="text" class="form-control" id="editNome" required>
                        </div>
                        <div class="form-group">
                            <label for="editCpf">CPF</label>
                            <input type="text" class="form-control" id="editCpf" required>
                        </div>
                        <div class="form-group">
                            <label for="editDataNascimento">Data de Nascimento</label>
                            <input type="date" class="form-control" id="editDataNascimento" required>
                        </div>
                        <input type="hidden" id="editFuncionarioId">
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
        // Exemplo de dados
        const funcionarios = [
            { id: 1, nome: "João Silva", cpf: "123.456.789-00", dataNascimento: "1990-01-01", senha: "senha123" },
            { id: 2, nome: "Maria Oliveira", cpf: "987.654.321-00", dataNascimento: "1985-05-15", senha: "senha456" }
        ];

        function renderTable() {
            const tableBody = document.getElementById('funcionarioTable');
            tableBody.innerHTML = '';
            funcionarios.forEach(funcionario => {
                const row = document.createElement('tr');
                row.innerHTML = `
                    <td>${funcionario.id}</td>
                    <td>${funcionario.nome}</td>
                    <td>${funcionario.cpf}</td>
                    <td>${funcionario.dataNascimento}</td>
                    <td>
                        <button class="btn btn-warning btn-sm" onclick="editFuncionario(${funcionario.id})">Editar</button>
                        <button class="btn btn-danger btn-sm" onclick="deleteFuncionario(${funcionario.id})">Deletar</button>
                    </td>
                `;
                tableBody.appendChild(row);
            });
        }

        function editFuncionario(id) {
            const funcionario = funcionarios.find(f => f.id === id);
            document.getElementById('editFuncionarioId').value = funcionario.id;
            document.getElementById('editNome').value = funcionario.nome;
            document.getElementById('editCpf').value = funcionario.cpf;
            document.getElementById('editDataNascimento').value = funcionario.dataNascimento;

            $('#editModal').modal('show');
        }

        function deleteFuncionario(id) {
            const index = funcionarios.findIndex(f => f.id === id);
            if (index > -1) {
                funcionarios.splice(index, 1);
                renderTable();
            }
        }

        document.getElementById('addFuncionarioForm').addEventListener('submit', function(event) {
            event.preventDefault();
            const nome = document.getElementById('nome').value;
            const cpf = document.getElementById('cpf').value;
            const dataNascimento = document.getElementById('dataNascimento').value;

            const newFuncionario = {
                id: funcionarios.length + 1,
                nome,
                cpf,
                dataNascimento,

            };

            funcionarios.push(newFuncionario);
            renderTable();
            $('#addModal').modal('hide');
        });

        document.getElementById('editFuncionarioForm').addEventListener('submit', function(event) {
            event.preventDefault();
            const id = document.getElementById('editFuncionarioId').value;
            const nome = document.getElementById('editNome').value;
            const cpf = document.getElementById('editCpf').value;
            const dataNascimento = document.getElementById('editDataNascimento').value;


            const funcionario = funcionarios.find(f => f.id === parseInt(id));
            funcionario.nome = nome;
            funcionario.cpf = cpf;
            funcionario.dataNascimento = dataNascimento;


            renderTable();
            $('#editModal').modal('hide');
        });

        // Inicializa a tabela
        renderTable();
    </script>

</body>
</html>
