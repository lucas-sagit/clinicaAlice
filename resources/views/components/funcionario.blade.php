{{-- <!DOCTYPE html> --}}
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <title>Painel de Funcionários</title>
    <!-- Bootstrap CSS -->

    <script src="https://code.jquery.com/jquery-3.5.1.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.5.2/dist/umd/popper.min.js"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.0/js/bootstrap.min.js"></script>
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
                    <th>Telefone</th>
                    <th>Cargo</th>
                    <th>Data de Nascimento</th>
                    <th>Ações</th>
                </tr>
            </thead>
            <tbody id="funcionarioTable">
                @foreach ($funcionarios as $funcionario)
                    <td>{{ $funcionario->id }}</td>
                    <td>{{ $funcionario->nome }}</td>
                    <td>{{ $funcionario->cpf }}</td>
                    <td>{{ $funcionario->telefone }}</td>
                    <td>{{ $funcionario->cargo }}</td>
                    <td>{{ $funcionario->dataNascimento ? \Carbon\Carbon::parse($funcionario->dataNascimento)->format('d/m/Y') : 'Data não informada' }}
                    </td>
                    <td>
                        <button class="btn btn-warning btn-sm" onclick="editFuncionarioForm({{ $funcionario }})">Editar</button>
                        <button class="btn btn-danger btn-sm"
                            onclick="deleteFuncionario({{ $funcionario->id }})">Deletar</button>
                    </td>
                    </tr>
                @endforeach
            </tbody>
        </table>
    </div>

    <!-- Modal de Adicionar Funcionário -->
    <div class="modal fade" id="addModal" tabindex="-1" role="dialog" aria-labelledby="addModalLabel"
        aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="addModalLabel">Adicionar Funcionário</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <form id="addFuncionarioForm" action="{{ route('funcionario.store' )}}" method="POST">
                        @csrf
                        <div class="form-group">
                            <label for="nome">Nome</label>
                            <input type="text" class="form-control" id="nome" required>
                        </div>
                        <div class="form-group">
                            <label for="cpf">CPF</label>
                            <input type="text" class="form-control" id="cpf" required>
                        </div>
                        <div class="form-group">
                            <label for="telef">Telefone</label>
                            <input type="text" class="form-control" id="telef" required>
                        </div>
                        <div class="form-group">
                            <label for="cargo">Cargo</label>
                            <input type="text" class="form-control" id="cargo" required>
                        </div>
                        <div class="form-group">
                            <label for="dataNascimento">Data de Nascimento</label>
                            <input type="date" class="form-control" id="dataNascimento">
                        </div>
                        <button type="submit" class="btn btn-primary">Salvar</button>
                    </form>
                </div>
            </div>
        </div>
    </div>

    <!-- Modal de Editar Funcionário (similar ao de Adicionar) -->
    <div class="modal fade" id="editModal" tabindex="-1" role="dialog" aria-labelledby="editModalLabel"
        aria-hidden="true">
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
                        @csrf
                        @method('PUT')
                        <div class="form-group">
                            <label for="editNome">Nome</label>
                            <input type="text" class="form-control" id="editNome" required>
                        </div>
                        <div class="form-group">
                            <label for="editCpf">CPF</label>
                            <input type="text" class="form-control" id="editCpf" required>
                        </div>
                        <div class="form-group">
                            <label for="editTelef">Telefone</label>
                            <input type="text" class="form-control" id="editTelef" required>
                        </div>
                        <div class="form-group">
                            <label for="editCargo">Cargo</label>
                            <input type="text" class="form-control" id="editCargo" required>
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
    <script src="https://code.jquery.com/jquery-3.5.1.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.5.2/dist/umd/popper.min.js"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.0/js/bootstrap.min.js"></script>
    <link href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.0/css/bootstrap.min.css" rel="stylesheet">


    <script>
        // Funções para a máscara de CPF e telefone
        function applyMask(input, mask) {
            let value = input.value.replace(/\D/g, '');
            let i = 0;
            input.value = mask.replace(/0/g, () => value[i++] || '');
        }

        document.getElementById('cpf').addEventListener('input', function() {
            applyMask(this, '000.000.000-00');
        });

        document.getElementById('telef').addEventListener('input', function() {
            applyMask(this, '(00) 00000-0000');
        });

        document.getElementById('editCpf').addEventListener('input', function() {
            applyMask(this, '000.000.000-00');
        });

        document.getElementById('editTelef').addEventListener('input', function() {
            applyMask(this, '(00) 00000-0000');
        });

        // Adicionar funcionário
        document.getElementById('addFuncionarioForm').addEventListener('submit', function(event) {
            event.preventDefault();
            const nome = document.getElementById('nome').value;
            const cpf = document.getElementById('cpf').value;
            const telefone = document.getElementById('telef').value;
            const cargo = document.getElementById('cargo').value;
            const dataNascimento = document.getElementById('dataNascimento').value;

            console.log(addFuncionarioForm);

            fetch('/funcionario', {
                    method: 'POST',
                    headers: {
                        'Content-Type': 'application/json',
                        'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').getAttribute('content')
                    },
                    body: JSON.stringify({
                        nome,
                        cpf,
                        telefone,
                        cargo,
                        dataNascimento
                    })
                })
                .then(response => response.json())
                .then(data => {
                    location.reload();
                    $('#addModal').modal('hide');
                })
                .catch(error => {
                    alert('não cadastrou:', error);
                });
        });

        function editFuncionarioForm(funcionario) {

            document.getElementById('editNome').value = funcionario.nome;
            document.getElementById('editCpf').value = funcionario.cpf;
            document.getElementById('editTelef').value = funcionario.telefone;
            document.getElementById('editCargo').value = funcionario.cargo;
            document.getElementById('editDataNascimento').value = funcionario.dataNascimento;
            document.getElementById('editFuncionarioId').value = funcionario.id;
            $('#editModal').modal('show');

        }

        document.getElementById('editFuncionarioForm').addEventListener('submit', function(event) {
            event.preventDefault();

            const nome = document.getElementById('editNome').value;
            const cpf = document.getElementById('editCpf').value;
            const telefone = document.getElementById('editTelef').value;
            const cargo = document.getElementById('editCargo').value;
            const dataNascimento = document.getElementById('editDataNascimento').value;
            const id = document.getElementById('editFuncionarioId').value;

            fetch(`/funcionario/${id}`, {
                    method: 'PUT',
                    headers: {
                        'Content-Type': 'application/json',
                        'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').getAttribute(
                            'content')
                    },
                    body: JSON.stringify({
                        nome,
                        cpf,
                        telefone,
                        cargo,
                        dataNascimento,
                    })

                })

                .then(response => response.json())
                .then(data => {
                    location.reload();
                })
                .catch(error => {
                    alert("Erro ao alterar os dados do funcionário");
                });
        })

        function deleteFuncionario(id) {
            if (confirm("Tem certeza que deseja excluir este funcionário?")) {
                fetch(`/funcionario/${id}`, {
                        method: 'DELETE',
                        headers: {
                            'Content-Type': 'application/json',
                            'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').getAttribute('content')
                        }
                    })
                    .then(response => response.json())
                    .then(data => {
                        alert(data.message);
                        location.reload();
                        document.querySelector(`#funcionarioTable tr[data-id="${id}"]`).remove();
                    })
                    .catch(error => {
                        console.log("Erro ao excluir funcionario:\n" + error);
                    });
            }
        }
    </script>

</body>

</html>
