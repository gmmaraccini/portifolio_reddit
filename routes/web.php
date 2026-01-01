<?php

use App\Http\Controllers\PostController;
use App\Http\Controllers\CommentController;
use Illuminate\Support\Facades\Route;

// 1. Rota Principal
Route::get('/', [PostController::class, 'index'])->name('posts.index');

// 2. Rota Dashboard (ESSA É A QUE ESTAVA FALTANDO OU COM ERRO)
Route::get('/dashboard', function () {
    return view('dashboard');
})->middleware(['auth', 'verified'])->name('dashboard');

// 3. Rota de Perfil (Opcional, mas o Breeze cria por padrão)
Route::middleware('auth')->group(function () {
    Route::get('/profile', [App\Http\Controllers\ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [App\Http\Controllers\ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [App\Http\Controllers\ProfileController::class, 'destroy'])->name('profile.destroy');
});

// 4. Ver Post
Route::get('/posts/{post}', [PostController::class, 'show'])->name('posts.show');

// 5. Salvar Comentário
Route::post('/comments', [CommentController::class, 'store'])
    ->middleware('auth')
    ->name('comments.store');

// 6. Login/Registro
require __DIR__.'/auth.php';
