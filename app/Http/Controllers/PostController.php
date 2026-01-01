<?php

namespace App\Http\Controllers;

use App\Models\Post;
use Illuminate\Http\Request;

class PostController extends Controller
{
    // Página inicial: Lista os posts
    public function index()
    {
        $posts = Post::with('user')
            ->withCount('comments') // <--- ADICIONE ISSO
            ->latest()
            ->paginate(10);

        return view('posts.index', compact('posts'));
    }

    // Página do Post: Mostra conteúdo e comentários
    public function show(Post $post)
    {
        // Aqui está o segredo da performance para a recursividade.
        // Carregamos:
        // 1. Apenas comentários raiz (whereNull parent_id)
        // 2. Trazemos junto as respostas (replies) e as respostas das respostas (replies.replies)
        // Isso carrega 3 níveis de profundidade de uma vez só.

        $comments = $post->comments()
            ->whereNull('parent_id')
            ->with('user', 'replies.user', 'replies.replies.user')
            ->latest()
            ->get();

        return view('posts.show', compact('post', 'comments'));
    }
}
