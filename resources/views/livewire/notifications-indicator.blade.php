<div class="relative">
    <button class="text-white bg-indigo-600 px-4 py-2 rounded-lg">
        Notifications ({{ count($notifications ?? []) }})
    </button>
    <div class="absolute bg-white shadow-lg rounded-lg mt-2 w-64">
        @if (count($notifications ?? []) > 0)
            <ul>
                @foreach ($notifications as $notification)
                    <li class="p-2 border-b">
                        <p class="text-sm">{{ $notification['message'] }}</p>
                        <p class="text-xs text-gray-500">{{ $notification['time'] }}</p>
                    </li>
                @endforeach
            </ul>
        @else
            <p class="p-2 text-sm text-gray-500">Aucune notification</p>
        @endif
    </div>
</div>