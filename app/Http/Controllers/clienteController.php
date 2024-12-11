<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Cliente;
use App\Models\Funcionario;
use App\Models\Administrador;
use App\Models\Sessao;

class ClienteController extends Controller
{

    public function showClienteForm()
    {
        $clientes = Cliente::all();
        return view('components.cliente', compact('clientes'));
    }


    public function create(Request $request)
    {

        $request->validate([
            'nome' => 'required|string|max:255',
            'cpf' => 'required|string|cpf',
            'dataNascimento' => 'required|date',
            'id_funcionario' => 'nullable|exists:funcionarios,id',
            'id_administrador' => 'nullable|exists:administradores,id',
            'id_sessao' => 'nullable|exists:sessoes,id',
        ]);


        Cliente::create([
            'nome' => $request->nome,
            'cpf' => $request->cpf,
            'dataNascimento' => $request->dataNascimento,
            'id_funcionario' => $request->id_funcionario,
            'id_administrador' => $request->id_administrador,
            'id_sessao' => $request->id_sessao,
        ]);

        return response()->json(['message' => 'Cliente criado com sucesso!'], 200);
    }

    public function edit($id)
    {
        $cliente = Cliente::findOrFail($id);
        return response()->json([
            'cliente' => [
            'id' => $cliente->id,
            'nome' => $cliente->nome,
            'cpf' => $cliente->cpf,
            'dataNascimento' => $cliente->dataNascimento->format('Y-m-d')
            ]
        ]);
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
        $cliente = Cliente::findOrFail($id);
        $cliente->nome = $request->nome;
        $cliente->cpf = $request->cpf;
        $cliente->dataNascimento = $request->dataNascimento;
        $cliente->save();

        return response()->json([
            'cliente' => $cliente
        ]);
    }


    public function destroy($id)
    {

        $cliente = Cliente::findOrFail($id);
        $cliente->delete();

        return response()->json([
            'message' => 'Cliente deletado com sucesso!',
            'cliente' => $cliente
        ]);
    }
}
