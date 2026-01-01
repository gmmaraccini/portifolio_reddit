<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    use WithoutModelEvents;

    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        // 1. Cria o SEU usuário para testar login
        $me = \App\Models\User::factory()->create([
            'name' => 'Gabriel',
            'email' => 'gabriel@teste.com',
            'password' => bcrypt('password'), // senha simples
        ]);

        // 2. Cria mais 10 usuários aleatórios para "conversar" com você
        $users = \App\Models\User::factory(10)->create();

        // Adiciona você na lista de usuários possíveis
        $users->push($me);

        // 3. Cria 10 Posts, escolhendo aleatoriamente um autor da lista acima
        $posts = \App\Models\Post::factory(10)
            ->recycle($users) // Usa os usuários existentes em vez de criar novos
            ->create();

        // 4. Para cada Post, cria comentários e respostas (Recursão)
        foreach ($posts as $post) {

            // A. Cria 3 a 5 comentários "Raiz" (Nível 1)
            $rootComments = \App\Models\Comment::factory(rand(3, 5))->create([
                'post_id' => $post->id,
                'user_id' => $users->random()->id,
                'parent_id' => null,
            ]);

            // B. Para cada comentário Raiz, cria respostas (Nível 2)
            foreach ($rootComments as $root) {
                $replies = \App\Models\Comment::factory(rand(1, 3))->create([
                    'post_id' => $post->id,
                    'user_id' => $users->random()->id,
                    'parent_id' => $root->id, // Aqui liga ao pai!
                ]);

                // C. (Opcional) Cria respostas das respostas (Nível 3 - Hardcore)
                foreach ($replies as $reply) {
                    if (rand(0, 1)) { // 50% de chance de ter resposta
                        \App\Models\Comment::factory()->create([
                            'post_id' => $post->id,
                            'user_id' => $users->random()->id,
                            'parent_id' => $reply->id,
                        ]);
                    }
                }
            }
        }
    }
}
