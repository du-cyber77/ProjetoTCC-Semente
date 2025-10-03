<?php
namespace App\Http\Controllers;

use App\Models\Contato;
use Illuminate\Http\Request;

class ContatosController extends Controller
{
    public function create()
    {
        return view('contato'); // contato.blade.php
    }

    public function store(Request $request)
    {
        // Validação simples
        $request->validate([
            'nome' => 'required|string|max:255',
            'email' => 'required|email|max:255',
            'mensagem' => 'required|string',
        ]);

        // Salva no banco
        Contato::create($request->all());

        return redirect()->back()->with('success', 'Mensagem enviada com sucesso!');
    }
}
