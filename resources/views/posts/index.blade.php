@extends('layouts.app')

@section('content')
    <div class="flex justify-center">
        <div class="w-8/12 bg-white p-6 rounded-lg">
            <form action="{{ route('posts') }}" method="post" class="mb-4">
                @csrf
                <div class="mb-4">
                    <label for="body" class="sr-only">Body</label>
                    <textarea name="body" id="body" cols="30" rows="4" 
                    class="bg-gray-100 border-2 w-full p-4 rounded-lg @error('body')
                        border-red-500
                    @enderror" placeholder="Make a Post!"></textarea>

                    @error('body')
                        <div class="text-red-500 mt-2 text-sm">
                            {{ $message }}
                        </div>
                    @enderror
                </div>

                <div>
                    <button type="submit" 
                    class="bg-blue-500 text-white px-4 py-2 rounded font-medium"
                    >Post</button>
                </div>
            </form>

            @if ($posts->count())
                @foreach ($posts as $post)
                    <div class="mb-4">
                        <a href="" class="font-bold">{{ $post->user->name }}</a>
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
                            @if($post->ownedBy(auth()->user()))
                            <form action="{{ route('posts.destroy', $post) }}" method="POST">
                                @csrf
                                @method('DELETE')
                                <button type="submit" class="text-red-500"><i class="fas fa-trash"></i></button>
                            </form>
                        @endif
                            <span>{{ $post->likes->count() }} {{ Str::plural('like', $post->likes->count()) }}</span>
                        </div>
                    </div>
                @endforeach

                {{ $posts->links() }}
            @else
                There are no posts
            @endif

        </div>
    </div>
@endsection