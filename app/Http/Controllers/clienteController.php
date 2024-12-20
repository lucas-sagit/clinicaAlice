<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Cliente;
use App\Models\Funcionario;
use App\Models\Administrador;
use App\Models\Sessao;
use Carbon\Carbon;

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
            'telefone' => 'required|string|telefone',
            'dataNascimento' => 'required|date',
            'id_funcionario' => 'nullable|exists:funcionarios,id',
            'id_administrador' => 'nullable|exists:administradores,id',
            'id_sessao' => 'nullable|exists:sessoes,id',
        ]);


        Cliente::create([
            'nome' => $request->nome,
            'cpf' => $request->cpf,
            'telefone' => $request->telefone,
            'dataNascimento' => $request->dataNascimento,
            'id_funcionario' => $request->id_funcionario,
            'id_administrador' => $request->id_administrador,
            'id_sessao' => $request->id_sessao,
        ]);

        return response()->json(['message' => 'Cliente criado com sucesso!'], 200);
    }

    public function edit($id)
    {
        $cliente = Cliente::find($id);
        return response()->json([
            'cliente' => $cliente
        ]);
    }

    public function store(Request $request)
    {
        $request->validate([
            'nome' => 'required|string|max:255',
            'cpf' => 'required|string|cpf',
            'telefone' => 'required|string',
            'dataNascimento' => 'required|date_format:Y-m-d',
        ]);

        $cliente = new Cliente();
        $cliente->nome = $request->nome;
        $cliente->cpf = $request->cpf;
        $cliente->telefone = $request->telefone;
        $cliente->data_nascimento = $request->dataNascimento;
        $cliente->save();

        return response()->json([
            'message' => 'Cliente cadastrado com sucesso!',
            'cliente' => $cliente,
        ]);
    }


    public function update(Request $request, $id)
    {

        $cliente = Cliente::find($id);

        if(!$cliente) {
            return response()->json(['error' => 'Cliente não encontrado'], 404);
        }

        $cliente->nome = $request->input('nome');
        $cliente->cpf = $request->input('cpf');
        $cliente->telefone = $request->input('telefone');

        $cliente->data_nascimento = Carbon::parse($request->input('dataNascimento'))->format('Y-m-d');  // Formatação
        $cliente->save();

        return response()->json(['message' => 'Cliente Atualizado com Sucesso!', 'cliente' => $cliente]);
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
