@props(['comment'])

<div class="mt-4 bg-gray-50 border border-gray-200 rounded p-4" x-data="{ open: false }">

    <div class="flex justify-between items-center mb-2">
        <div class="flex items-center gap-2">
            <span class="font-bold text-sm text-gray-800">{{ $comment->user->name }}</span>
            <span class="text-xs text-gray-500">{{ $comment->created_at->diffForHumans() }}</span>
        </div>
    </div>

    <p class="text-gray-700 text-sm mb-2">
        {{ $comment->body }}
    </p>

    <div class="flex gap-4 text-xs text-gray-500 font-bold">
        <button @click="open = !open" class="hover:text-blue-600">Responder</button>
        <button class="hover:text-red-600">Denunciar</button>
    </div>

    <div x-show="open" class="mt-4" style="display: none;">
        @auth
            <form action="{{ route('comments.store') }}" method="POST">
                @csrf
                <input type="hidden" name="post_id" value="{{ $comment->post_id }}">

                <input type="hidden" name="parent_id" value="{{ $comment->id }}">

                <textarea
                    name="body"
                    rows="2"
                    class="w-full text-sm rounded-md border-gray-300 shadow-sm focus:border-blue-500 focus:ring-blue-500"
                    placeholder="Escreva sua resposta..."></textarea>

                <button type="submit" class="mt-2 text-xs bg-gray-800 text-white px-3 py-1 rounded hover:bg-gray-700">
                    Enviar Resposta
                </button>
            </form>
        @else
            <p class="text-xs text-red-500 mt-2 bg-red-50 p-2 rounded">
                Você precisa fazer login para responder.
            </p>
        @endauth
    </div>

    @if($comment->replies->isNotEmpty())
        <div class="ml-6 border-l-2 border-gray-300 pl-4 mt-2">
            @foreach($comment->replies as $reply)
                <x-comment-item :comment="$reply" />
            @endforeach
        </div>
    @endif
</div>
