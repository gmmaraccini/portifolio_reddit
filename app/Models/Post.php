<?php
namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Post extends Model
{
    use HasFactory;

    protected $fillable = ['title', 'slug', 'body', 'user_id'];

    // Relação: O post pertence a um Usuário
    public function user()
    {
        return $this->belongsTo(User::class);
    }

    // Relação: O post tem muitos Comentários
    public function comments()
    {
        return $this->hasMany(Comment::class);
    }

    // Helper para gerar URL amigável automaticamente (Opcional mas recomendado)
    // Isso faz com que a rota use o 'slug' em vez do ID na URL (ex: /posts/meu-primeiro-post)
    public function getRouteKeyName()
    {
        return 'slug';
    }
}
