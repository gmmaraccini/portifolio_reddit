<?php
namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Comment extends Model
{
    use HasFactory;

    protected $fillable = ['body', 'user_id', 'post_id', 'parent_id'];

    // Relação: Pertence a um Usuário
    public function user()
    {
        return $this->belongsTo(User::class);
    }

    // Relação: Pertence a um Post
    public function post()
    {
        return $this->belongsTo(Post::class);
    }

    // Relação RECURSIVA: As respostas deste comentário
    // "HasMany" procurando na mesma tabela onde 'parent_id' é igual ao ID deste comentário
    public function replies()
    {
        return $this->hasMany(Comment::class, 'parent_id');
    }

    // Relação RECURSIVA: O "Pai" deste comentário
    public function parent()
    {
        return $this->belongsTo(Comment::class, 'parent_id');
    }
}
