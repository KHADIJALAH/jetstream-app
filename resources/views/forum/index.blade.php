<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Forum') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 bg-white border-b border-gray-200">
                    <h3 class="text-lg font-semibold mb-4">{{ __('Recent Forum Topics') }}</h3>

                    @if ($topics->isEmpty())
                        <p>{{ __('No topics yet. Be the first to create one!') }}</p>
                    @else
                        <ul class="space-y-2">
                            @foreach ($topics as $topic)
                                <li>
                                    <a href="{{ route('forum.topic', $topic) }}" class="text-blue-500 hover:underline">{{ $topic->title }}</a>
                                    <span class="text-gray-500 text-sm">({{ $topic->user->name }} - {{ $topic->created_at->diffForHumans() }})</span>
                                </li>
                            @endforeach
                        </ul>
                        {{ $topics->links() }}
                    @endif

                    <h3 class="text-lg font-semibold mt-8 mb-4">{{ __('Create New Topic') }}</h3>
                    <form method="POST" action="{{ route('forum.storeTopic') }}">
                        @csrf

                        <div>
                            <x-input-label for="title" :value="__('Title')" />
                            <x-text-input id="title" class="block mt-1 w-full" type="text" name="title" required autofocus />
                            <x-input-error :messages="$errors->get('title')" class="mt-2" />
                        </div>

                        <div class="mt-4">
                            <x-input-label for="content" :value="__('Content')" />
                            <x-textarea id="content" class="block mt-1 w-full" name="content" rows="5" required></x-textarea>
                            <x-input-error :messages="$errors->get('content')" class="mt-2" />
                        </div>

                        <div class="flex items-center justify-end mt-4">
                            <x-primary-button>
                                {{ __('Create Topic') }}
                            </x-primary-button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>