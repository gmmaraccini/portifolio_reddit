<x-guest-layout>

    <div class="bg-white shadow-sm border-b border-gray-200 mb-6">
        <div class="max-w-4xl mx-auto px-4 py-4 flex justify-between items-center">
            <a href="{{ route('posts.index') }}" class="text-xl font-bold text-red-600">RedditClone</a>

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
                        <a href="{{ route('register') }}" class="text-sm text-gray-700 underline font-bold hover:text-red-600">Criar Conta</a>
                    @endauth
                @endif
            </div>
        </div>
    </div>

    <div class="max-w-4xl mx-auto py-6 px-4">

        <a href="{{ route('posts.index') }}" class="text-blue-600 hover:underline mb-4 inline-block">&larr; Voltar para a lista</a>

        <div class="bg-white p-8 rounded-lg shadow-md mb-8 border border-gray-200">
            <h1 class="text-3xl font-extrabold text-gray-900 mb-2">{{ $post->title }}</h1>
            <div class="text-sm text-gray-500 mb-6">
                Postado por <span class="font-bold">{{ $post->user->name }}</span>
                em {{ $post->created_at->format('d/m/Y H:i') }}
            </div>

            <div class="prose max-w-none text-gray-800 leading-relaxed">
                {!! nl2br(e($post->body)) !!}
            </div>
        </div>

        <div class="bg-white p-6 rounded-lg shadow-sm">
            <h3 class="text-xl font-bold mb-6 border-b pb-2">Comentários ({{ $comments->count() }})</h3>

            <div class="mb-8">
                @auth
                    <form action="{{ route('comments.store') }}" method="POST">
                        @csrf
                        <input type="hidden" name="post_id" value="{{ $post->id }}">

                        <textarea
                            name="body"
                            rows="3"
                            class="w-full rounded-md border-gray-300 shadow-sm focus:border-blue-500 focus:ring-blue-500"
                            placeholder="O que você está pensando?"></textarea>

                        <button type="submit" class="mt-2 bg-blue-600 text-white px-4 py-2 rounded hover:bg-blue-700">
                            Comentar
                        </button>
                    </form>
                @else
                    <div class="bg-yellow-50 p-4 rounded text-yellow-800 border border-yellow-200">
                        Você precisa
                        <a href="{{ route('login') }}" class="underline font-bold hover:text-yellow-900">fazer login</a>
                        ou
                        <a href="{{ route('register') }}" class="underline font-bold hover:text-yellow-900">criar uma conta</a>
                        para participar da discussão.
                    </div>
                @endauth
            </div>

            @if($comments->count() > 0)
                <div class="space-y-4">
                    @foreach($comments as $comment)
                        <x-comment-item :comment="$comment" />
                    @endforeach
                </div>
            @else
                <p class="text-gray-500 italic">Seja o primeiro a comentar!</p>
            @endif
        </div>
    </div>
</x-guest-layout>
