<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Cliente;
use App\Models\Funcionario;
use App\Models\Administrador;
use App\Models\Sessao;

class ClienteController extends Controller
{
    // Método para mostrar o formulário de criação de cliente
    public function showClienteForm()
    {
        $clientes = Cliente::all();
        return view('components.cliente', compact('clientes')); // Retorna a view com o formulário, se necessário
    }

    // Método para criar um novo cliente
    public function create(Request $request)
    {
        // Validação dos dados recebidos
        $request->validate([
            'nome' => 'required|string|max:255',
            'cpf' => 'required|string|cpf', // Adicionar validação de CPF
            'dataNascimento' => 'required|date',
            'id_funcionario' => 'nullable|exists:funcionarios,id',
            'id_administrador' => 'nullable|exists:administradores,id',
            'id_sessao' => 'nullable|exists:sessoes,id',
        ]);

        // Criação de um novo cliente
        Cliente::create([
            'nome' => $request->nome,
            'cpf' => $request->cpf,
            'dataNascimento' => $request->dataNascimento,
            'id_funcionario' => $request->id_funcionario,
            'id_administrador' => $request->id_administrador,
            'id_sessao' => $request->id_sessao,
        ]);

        return response()->json(['message' => 'Cliente criado com sucesso!'], 201);
    }

    public function edit($id)
    {
        $cliente = Cliente::findOrFail($id);
        return response()->json($cliente);
    }

    public function store(Request $request)
    {

        $validated = $request->validate([
            'nome' => 'required|string|max:255',
            'cpf' => 'required|string|max:14',
            'dataNascimento' => 'required|date',
        ]);

        $cliente = new Cliente();
        $cliente->nome = $validated['nome'];
        $cliente->cpf = $validated['cpf'];
        $cliente->data_nascimento = $validated['dataNascimento'];
        $cliente->save();

        return response()->json([
            'message' => 'Cliente adicionado com sucesso',
            'cliente' => $cliente
        ]);
    }

    public function update(Request $request, $id)
    {

        $request->validate([
            'nome' => 'required|string|max:255',
            'cpf' => 'required|string|cpf',
            'dataNascimento' => 'required|date',
            'id_funcionario' => 'nullable|exists:funcionarios,id',
            'id_administrador' => 'nullable|exists:administradores,id',
            'id_sessao' => 'nullable|exists:sessoes,id',
        ]);

        // Encontra o cliente e atualiza os dados
        $cliente = Cliente::findOrFail($id);
        $cliente->update([
            'nome' => $request->nome,
            'cpf' => $request->cpf,
            'dataNascimento' => $request->dataNascimento,
            'id_funcionario' => $request->id_funcionario,
            'id_administrador' => $request->id_administrador,
            'id_sessao' => $request->id_sessao,
        ]);

        return response()->json(['message' => 'Cliente atualizado com sucesso!'], 200);
    }

    public function destroy($id)
    {

        $cliente = Cliente::findOrFail($id);
        $cliente->delete();

        return response()->json([
            'message' => 'Cliente deletado com sucesso!',
            'delete' => $cliente
        ]);
    }
}
