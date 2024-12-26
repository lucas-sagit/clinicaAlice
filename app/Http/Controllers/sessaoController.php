<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use App\Models\sessao;
use Illuminate\Http\Request;

class sessaoController extends Controller
{
    public function showSessaoForm() {
        $sessoes = Sessao::all();
        return view('components.sessao', compact('sessao'));
    }

    public function store(Request $request) {
        $sessao = new Sessao();
        $sessao->quantidadePaga = $request->quantidadePaga;
        $sessao->quantidadeFalta = $request->quantidadeFalta;
        $sessao->id_cliente = $request->id_cliente;
        $sessao->save();

        return response()->json(['success' => true]);
    }

    public function update (Request $request, $id) {
        $sessao = Sessao::find($id);
        $sessao->quantidadePaga = $request->quantidadePaga;
        $sessao->quantidadeFalta = $request->quantidadeFalta;
        $sessao->id_cliente = $request->id_cliente;
        $sessao->save();

        return response()->json(['success' => true]);
    }
}
