<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Painel de Clientes</title>
    <!-- Bootstrap JS -->
    <script src="https://code.jquery.com/jquery-3.5.1.min.js"></script> <!-- Versão completa do jQuery -->
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.5.2/dist/umd/popper.min.js"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.0/js/bootstrap.min.js"></script>

    <link href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.0/css/bootstrap.min.css" rel="stylesheet">

    <!-- Adicionando jQuery Mask Plugin -->
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery.mask/1.14.16/jquery.mask.min.js"></script>
</head>

<body>
    <div class="container mt-5">
        <h1>Painel de Clientes</h1>
        <button class="btn btn-primary" data-toggle="modal" data-target="#addModal">Adicionar Cliente</button>
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
            <tbody id="clienteTable">
                @foreach ($clientes as $cliente)
                    <tr>
                        <td>{{ $cliente->id }}</td>
                        <td>{{ $cliente->nome }}</td>
                        <td>{{ $cliente->cpf }}</td>
                        <td>{{ \Carbon\Carbon::parse($cliente->dataNascimento)->format('d/m/Y') }}</td>
                        <td>
                            <button class="btn btn-warning btn-sm"
                                onclick="editClient({{ $cliente->id }})">Editar</button>
                            <button class="btn btn-danger btn-sm"
                                onclick="deleteClient({{ $cliente->id }})">Deletar</button>
                        </td>
                    </tr>
                @endforeach
            </tbody>
        </table>
    </div>

    <!-- Modal de Adicionar clientes -->
    <div class="modal fade" id="addModal" tabindex="-1" role="dialog" aria-labelledby="addModalLabel"
        aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="addModalLabel">Adicionar Cliente</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <form id="addClienteForm" action="{{ route('cliente.store') }}" method="POST">
                        <div class="form-group">
                            <label for="nome">Nome</label>
                            <input type="text" class="form-control" id="nome" required>
                        </div>
                        <div class="form-group">
                            <label for="cpf">CPF</label>
                            <input type="text" class="form-control" id="cpf" required>
                        </div>
                        <div class="form-group">
                            <label for="editTelef">Telefone</label>
                            <input type="text" class="form-control" id="editTelef" required>
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

    <div class="modal fade" id="editModal" tabindex="-1" role="dialog" aria-labelledby="editModalLabel"
        aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="editModalLabel">Editar Cliente</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <form id="editClientForm" action="{{ route('cliente.store') }}" method="POST">
                        @csrf
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
                            <label for="editDataNascimento">Data de Nascimento</label>
                            <input type="date" class="form-control" id="editDataNascimento" required>
                        </div>
                        <input type="hidden" id="editClientId">
                        <button type="submit" class="btn btn-primary">Salvar Alterações</button>
                    </form>
                </div>
            </div>
        </div>
    </div>

    <script>
        $(document).ready(function(){
            $('#cpf').mask('000.000.000-00');
            $('#editCpf').mask('000.000.000-00');
        });

        $('#addClienteForm').submit(function(event) {
            event.preventDefault();

            const nome = $('#nome').val();
            const telefone = $('#telefone').val();
            const cpf = $('#cpf').val();
            const dataNascimento = $('#dataNascimento').val();

            $.ajax({
                url: '{{ route('cliente.store') }}',
                type: 'POST',
                data: {
                    nome: nome,
                    cpf: cpf,
                    telefone: telefone,
                    dataNascimento: dataNascimento,
                    _token: '{{ csrf_token() }}'
                },
                success: function(response) {
                    alert(response.message);
                    location.reload();
                    $('#addModal').modal('hide');
                    $('#clienteTable').append(`
                        <tr>
                            <td>${response.cliente.id}</td>
                            <td>${response.cliente.nome}</td>
                            <td>${response.cliente.cpf}</td>
                            <td>${response.cliente.telefone}</td>
                            <td>${response.cliente.dataNascimento}</td>
                            <td>
                                <button class="btn btn-warning btn-sm" onclick="editClient(${response.cliente.id})">Editar</button>
                                <button class="btn btn-danger btn-sm" onclick="deleteClient(${response.cliente.id})">Deletar</button>
                            </td>
                        </tr>
                    `);
                },
                error: function(xhr, status, error) {
                    alert("Erro ao adicionar cliente");
                }
            });
        });

        function editClient(id) {
            $.ajax({
                url: `/cliente/${id}/edit`,
                type: 'PUT',
                success: function(response) {
                    $('#editNome').val(response.cliente.nome);
                    $('#editCpf').val(response.cliente.cpf);
                    $('#editTelef').val(response.cliente.telefone);
                    $('#editDataNascimento').val(response.cliente.dataNascimento);
                    $('#editClientId').val(response.cliente.id);
                    $('#editModal').modal('show');
                },
                error: function(xhr, status, error) {
                    alert("Erro ao carregar os dados do cliente");
                }
            });
        }

        function deleteClient(id) {
            if (confirm("Tem certeza que deseja excluir este cliente?")) {
                $.ajax({
                    url: `/cliente/${id}`,
                    type: 'DELETE',
                    data: {
                        _token: '{{ csrf_token() }}'
                    },
                    success: function(response) {
                        alert(response.message);
                        $(`#clienteTable tr[data-id="${id}"]`).remove();
                        location.reload();
                    },
                    error: function(xhr, status, error) {
                        alert("Erro ao deletar cliente");
                    }
                });
            }
        }
    </script>

</body>

</html>
