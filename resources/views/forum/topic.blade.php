<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ $topic->title }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 bg-white border-b border-gray-200">
                    <h3 class="text-lg font-semibold mb-4">{{ __('Posts') }}</h3>

                    @if ($posts->isEmpty())
                        <p>{{ __('No posts in this topic yet.') }}</p>
                    @else
                        <ul class="space-y-4">
                            @foreach ($posts as $post)
                                <li class="border p-4 rounded">
                                    <p class="mb-2">{{ $post->content }}</p>
                                    <p class="text-gray-500 text-sm">{{ $post->user->name }} - {{ $post->created_at->diffForHumans() }}</p>
                                </li>
                            @endforeach
                        </ul>
                        {{ $posts->links() }}
                    @endif

                    <h3 class="text-lg font-semibold mt-8 mb-4">{{ __('Add a Reply') }}</h3>
                    <form method="POST" action="{{ route('forum.storePost', $topic) }}">
                        @csrf

                        <div>
                            <x-textarea id="content" class="block mt-1 w-full" name="content" rows="3" required placeholder="{{ __('Your reply...') }}"></x-textarea>
                            <x-input-error :messages="$errors->get('content')" class="mt-2" />
                        </div>

                        <div class="flex items-center justify-end mt-4">
                            <x-primary-button>
                                {{ __('Post Reply') }}
                            </x-primary-button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>