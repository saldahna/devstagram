<div>

    @if ($posts->count())
            
        <div class="grid md:grid-cols-2 lg:grid-cols-3 xl:grid-cols-6 gap-6">
            @foreach ($posts as $post)
                <div>
                    <a href="{{ route('posts.show', ['post' => $post, 'user' => $post->user]) }}">
                        <img src="{{ asset('uploads').'/'.$post->imagen }}" height="200" alt="Imagen del post {{ $post->titulo }}">
                    </a>
                </div>
            @endforeach
        </div>

        <div class="my-10">
            {{ $posts->links('pagination::tailwind') }}
        </div>

    @else
        <p class="text-gray-600 uppercase text-sm text-center font-bold"> No hay post, sigue a alguien para ver sus publicaciones </p>
    @endif

    {{-- <h1>
        {{ $slot }}
    </h1> --}}

</div>