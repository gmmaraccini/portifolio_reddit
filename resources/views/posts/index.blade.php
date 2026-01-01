<x-guest-layout>
    <div class="bg-white shadow-sm border-b border-gray-200 mb-6">
        <div class="max-w-4xl mx-auto px-4 py-4 flex justify-between items-center">
            <span class="text-xl font-bold text-red-600">RedditClone</span>

            <div class="flex items-center gap-4">
                @if (Route::has('login'))
                    @auth
                        <div class="flex items-center gap-4">
                            <span class="text-gray-600 text-sm">Olá, {{ Auth::user()->name }}</span>

                            <form method="POST" action="{{ route('logout') }}">
                                @csrf
                                <button type="submit" class="text-sm text-red-600 hover:text-red-800 font-bold underline">
                                    Sair
                                </button>
                            </form>
                        </div>
                    @else
                        <a href="{{ route('login') }}" class="text-sm text-gray-700 underline font-bold hover:text-red-600">Entrar</a>

                        @if (Route::has('register'))
                            <a href="{{ route('register') }}" class="text-sm text-gray-700 underline font-bold hover:text-red-600">Criar Conta</a>
                        @endif
                    @endauth
                @endif
            </div>
        </div>
    </div>

    <div class="max-w-4xl mx-auto py-6 px-4">
        <h1 class="text-3xl font-bold mb-6 text-gray-800">Discussões Recentes</h1>

        @foreach ($posts as $post)
            <div class="bg-white p-6 rounded-lg shadow-md mb-4 hover:shadow-lg transition border border-gray-100">
                <div class="text-sm text-gray-500 mb-1">
                    Postado por <span class="font-bold">{{ $post->user->name }}</span>
                    • {{ $post->created_at->diffForHumans() }}
                </div>

                <h2 class="text-xl font-bold text-blue-600 hover:underline">
                    <a href="{{ route('posts.show', $post) }}">
                        {{ $post->title }}
                    </a>
                </h2>

                <p class="text-gray-700 mt-2 truncate">
                    {{ Str::limit($post->body, 150) }}
                </p>

                <div class="mt-4 text-sm text-gray-500 font-medium">
                    💬 {{ $post->comments_count }} comentários
                </div>
            </div>
        @endforeach

        <div class="mt-4">
            {{ $posts->links() }}
        </div>
    </div>
</x-guest-layout>
