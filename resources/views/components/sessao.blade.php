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
        <button class="btn btn-primary" data-toggle="modal" data-target="#addModal">Adicionar sessão</button>

        <!-- Tabela de funcionários -->
        <table class="table mt-3">
            <thead>
                <tr>
                    <th>#</th>
                    <th>Nome do paciente</th>
                    <th>CPF</th>
                    <th>Sessão com</th>
                    <th>Ações</th>
                </tr>
            </thead>
            <tbody id="clienteTable">
                <!-- Os dados dos funcionários serão carregados aqui -->
            </tbody>
        </table>
    </div>

    <!-- Modal de Adicionar Funcionário -->
    <div class="modal fade" id="addModal" tabindex="-1" role="dialog" aria-labelledby="addModalLabel" aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="addModalLabel">Adicionar Cliente</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <form id="addClienteForm">
                        <div class="form-group">
                            <label for="nome">Nome</label>
                            <input type="text" class="form-control" id="nome" required>
                        </div>
                        <div class="form-group">
                            <label for="cpf">CPF</label>
                            <input type="text" class="form-control" id="cpf" required>
                        </div>
                        <div class="form-group">
                            <label for="roles">Com o profissional</label>
                            <input type="text" class="form-control" id="roles" required>
                        </div>
                        <button type="submit" class="btn btn-primary">Salvar</button>
                    </form>
                </div>
            </div>
        </div>
    </div>

    <!-- Modal de Editar cliente (similar ao de Adicionar) -->
    <div class="modal fade" id="editModal" tabindex="-1" role="dialog" aria-labelledby="editModalLabel" aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="editModalLabel">Editar Cliente</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <form id="editSessaoForm">
                        <div class="form-group">
                            <label for="editNome">Nome</label>
                            <input type="text" class="form-control" id="editNome" required>
                        </div>
                        <div class="form-group">
                            <label for="editCpf">CPF</label>
                            <input type="text" class="form-control" id="editCpf" required>
                        </div>
                        <div class="form-group">
                            <label for="editroles">Data de Nascimento</label>
                            <input type="date" class="form-control" id="editroles" required>
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
        // Exemplo de dados
        const clientes = [
            { id: 1, nome: "João Silva", cpf: "123.456.789-00", roles: "Maria teste", senha: "senha123" },
            { id: 2, nome: "Maria Oliveira", cpf: "987.654.321-00", roles: "José teste", senha: "senha456" }
        ];

        function renderTable() {
            const tableBody = document.getElementById('clienteTable');
            tableBody.innerHTML = '';
            clientes.forEach(cliente => {
                const row = document.createElement('tr');
                row.innerHTML = `
                    <td>${cliente.id}</td>
                    <td>${cliente.nome}</td>
                    <td>${cliente.cpf}</td>
                    <td>${cliente.roles}</td>
                    <td>
                        <button class="btn btn-warning btn-sm" onclick="editSessao(${cliente.id})">Editar</button>
                        <button class="btn btn-danger btn-sm" onclick="deletecliente(${cliente.id})">Deletar</button>
                    </td>
                `;
                tableBody.appendChild(row);
            });
        }

        function editSessao(id) {
            const cliente = clientes.find(f => f.id === id);
            document.getElementById('editSessaoId').value = cliente.id;
            document.getElementById('editNome').value = cliente.nome;
            document.getElementById('editCpf').value = cliente.cpf;
            document.getElementById('editroles').value = cliente.roles;

            $('#editModal').modal('show');
        }

        function deletecliente(id) {
            const index = clientes.findIndex(f => f.id === id);
            if (index > -1) {
                clientes.splice(index, 1);
                renderTable();
            }
        }

        document.getElementById('addClienteForm').addEventListener('submit', function(event) {
            event.preventDefault();
            const nome = document.getElementById('nome').value;
            const cpf = document.getElementById('cpf').value;
            const roles = document.getElementById('roles').value;

            const newCliente = {
                id: clientes.length + 1,
                nome,
                cpf,
                roles,

            };

            clientes.push(newCliente);
            renderTable();
            $('#addModal').modal('hide');
        });

        document.getElementById('editSessaoForm').addEventListener('submit', function(event) {
            event.preventDefault();
            const id = document.getElementById('editSessaoId').value;
            const nome = document.getElementById('editNome').value;
            const cpf = document.getElementById('editCpf').value;
            const roles = document.getElementById('editroles').value;


            const cliente = clientes.find(f => f.id === parseInt(id));
            cliente.nome = nome;
            cliente.cpf = cpf;
            cliente.roles = roles;


            renderTable();
            $('#editModal').modal('hide');
        });

        // Inicializa a tabela
        renderTable();
    </script>

</body>
</html>
