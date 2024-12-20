<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use App\Models\funcionario;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Cache;
use Carbon\Carbon;

class funcionarioController extends Controller
{

    public function showFuncionarioForm()
    {
        $funcionarios = Funcionario::all();
        return view('components.funcionario', compact('funcionarios'));
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


        funcionario::create([
            'nome' => $request->nome,
            'cpf' => $request->cpf,
            'telefone' => $request->telefone,
            'dataNascimento' => $request->dataNascimento,
            'id_funcionario' => $request->id_funcionario,
            'id_administrador' => $request->id_administrador,
            'id_sessao' => $request->id_sessao,
        ]);

        return response()->json(['message' => 'Funcionário criado com sucesso!'], 200);
    }

    public function edit($id)
    {
        $funcionario = Funcionario::find($id);
        return response()->json([
            'Funcionario' => $funcionario
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

        $funcionario = new funcionario();
        $funcionario->nome = $request->nome;
        $funcionario->cpf = $request->cpf;
        $funcionario->telefone = $request->telefone;
        $funcionario->dataNascimento = $request->dataNascimento;
        $funcionario->save();

        return response()->json([
            'message' => 'funcionario cadastrado com sucesso!',
            'funcionario' => $funcionario,
        ]);
    }


    public function update(Request $request, $id)
    {

        $funcionario = Funcionario::find($id);

        if(!$funcionario) {
            return response()->json(['error' => 'funcionario não encontrado'], 404);
        }

        $funcionario->nome = $request->input('nome');
        $funcionario->cpf = $request->input('cpf');
        $funcionario->telefone = $request->input('telefone');

        $funcionario->dataNascimento = Carbon::parse($request->input('dataNascimento'))->format('Y-m-d');  // Formatação
        $funcionario->save();

        return response()->json(['message' => 'funcionario Atualizado com Sucesso!', 'funcionario' => $funcionario]);
    }

    public function destroy($id)
    {

        $funcionario = Funcionario::findOrFail($id);
        $funcionario->delete();

        return response()->json([
            'message' => 'funcionario deletado com sucesso!',
            'funcionario' => $funcionario
        ]);
    }
}


// class FuncionarioController extends Controller
// {
//     public function funcionario()
//     {
//         $funcionarios = Funcionario::all();
//         return view('components.funcionario', compact('funcionarios'));
//     }

//     public function store(Request $request)
//     {
//         $funcionario = Funcionario::create($request->all());
//         return response()->json($funcionario, 201);
//     }

//     public function update(Request $request, $id)
//     {
//         $funcionario = Funcionario::findOrFail($id);
//         $funcionario->update($request->all());
//         return response()->json($funcionario);
//     }

//     public function destroy($id)
//     {
//         $funcionario = Funcionario::findOrFail($id);
//         $funcionario->delete();
//         return response()->json(['message' => 'Funcionário excluído com sucesso!']);
//     }
// }
