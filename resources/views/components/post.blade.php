@props(['post' => $post])

<div class="mb-4">
    <a href="{{ route('users.posts', $post->user) }}" class="font-bold">{{ $post->user->name }}</a>
    <span class="text-gray-600 text-sm">{{ $post->created_at->diffForHumans() }}</span>

    <p class="mb-2">{{ $post->body }}</p>

    <div class="flex items-center">
        @auth
            @if(!$post->likedBy(auth()->user()))
            <form action="{{ route('posts.likes', $post) }}" method="POST" class="mr-1">
                @csrf
                <button type="submit" class="text-blue-500"><i class="fas fa-thumbs-up"></i></button>
            </form>
            @else
            <form action="{{ route('posts.likes', $post) }}" method="POSt" class="mr-1">
                @csrf
                @method('DELETE')
                <button type="submit" class="text-blue-500"><i class="fas fa-thumbs-down"></i></button>
            </form>
            @endif
            
        @endauth
        
        @can('delete', $post)
            <form action="{{ route('posts.destroy', $post) }}" method="POST">
                @csrf
                @method('DELETE')
                <button type="submit" class="text-red-500"><i class="fas fa-trash"></i></button>
            </form>
        @endcan
            
        <span>{{ $post->likes->count() }} {{ Str::plural('like', $post->likes->count()) }}</span>
    </div>
</div>