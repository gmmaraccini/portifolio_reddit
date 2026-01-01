<?php
namespace App\Http\Controllers;

use App\Models\Comment;
use Illuminate\Http\Request;

class CommentController extends Controller
{
    public function store(Request $request)
    {
        // 1. Validação
        $request->validate([
            'body' => 'required|string|max:1000',
            'post_id' => 'required|exists:posts,id',
            'parent_id' => 'nullable|exists:comments,id', // Opcional, se for resposta
        ]);

        // 2. Criação
        Comment::create([
            'body' => $request->body,
            'user_id' => auth()->id(), // Pega o ID do usuário logado
            'post_id' => $request->post_id,
            'parent_id' => $request->parent_id,
        ]);

        // 3. Volta para a página anterior
        return back();
    }
}
