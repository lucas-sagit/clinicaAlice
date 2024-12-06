<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;

class LoginController extends Controller
{
    public function showLoginForm()
    {
        return view('login'); // Certifique-se de que a view 'auth.login' exista.
    }

    /**
     * Lida com uma tentativa de autenticação.
     */
    public function authenticate(Request $request)
    {
        // Validação dos dados

        $credentials = $request->validate([
            'cpf' => ['required', 'string'], // 'cpf' pode ser validado como 'string', mas adicione validações extras se necessário
            'senha' => ['required', 'string'],
        ]);
        // dd($request->senha);

        // Tentativa de autenticação
        $user = User::where("cpf", $request->cpf)->first();
        if ($user && Hash::check($request->senha, $user->senha)) {
            $request->session()->regenerate();
            return redirect()->intended('dashboard'); // Altere para o caminho correto do seu dashboard
        }

        // Se falhar na autenticação
        return back()->withErrors([
            'cpf' => 'As credenciais fornecidas não correspondem aos nossos registros.',
            ])->onlyInput('cpf');

    }

    /**
     * Realiza o logout do usuário.
     */
    public function destroy(Request $request)
    {
        Auth::logout();
        return redirect('login'); // Ou redirecione para a página inicial
    }
}
