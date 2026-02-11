@extends('layouts.admin')

@section('content')
<div class="container mx-auto px-4 py-8">
    <h1 class="text-3xl font-bold mb-8">Admin Dashboard</h1>
    
    <!-- Stats Overview -->
    <div class="grid grid-cols-1 md:grid-cols-4 gap-6 mb-8">
        @foreach([
            'total_users' => 'Total Users',
            'new_users' => 'New Users (7d)',
            'active_reservations' => 'Active Reservations',
            'revenue' => 'Total Revenue'
        ] as $key => $title)
        <div class="bg-white rounded-lg shadow p-6">
            <h3 class="text-gray-500 text-sm font-medium">{{ $title }}</h3>
            <p class="text-2xl font-bold">
                @if($key === 'revenue')
                ${{ number_format($stats[$key], 2) }}
                @else
                {{ $stats[$key] }}
                @endif
            </p>
        </div>
        @endforeach
    </div>

    <!-- Popular Services -->
    <div class="bg-white rounded-lg shadow p-6 mb-8">
        <h2 class="text-xl font-bold mb-4">Popular Services</h2>
        <div class="grid grid-cols-1 md:grid-cols-3 gap-6">
            @foreach(['hotels', 'activities', 'flights'] as $service)
            <div>
                <h3 class="font-bold mb-2">{{ ucfirst($service) }}</h3>
                <ul class="space-y-2">
                    @foreach($stats['popular_services'][$service] as $item)
                    <li class="flex justify-between">
                        <span>{{ $item->name }}</span>
                        <span>{{ $item->reservations_count }} bookings</span>
                    </li>
                    @endforeach
                </ul>
            </div>
            @endforeach
        </div>
    </div>

    <!-- Recent Bookings -->
    <div class="bg-white rounded-lg shadow p-6">
        <h2 class="text-xl font-bold mb-4">Recent Bookings</h2>
        <div class="overflow-x-auto">
            <table class="min-w-full">
                <thead>
                    <tr class="border-b">
                        <th class="text-left py-2">User</th>
                        <th class="text-left py-2">Service</th>
                        <th class="text-left py-2">Date</th>
                        <th class="text-left py-2">Amount</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach($stats['recent_bookings'] as $booking)
                    <tr class="border-b">
                        <td class="py-2">{{ $booking->user->name }}</td>
                        <td class="py-2">{{ class_basename($booking->bookable_type) }}</td>
                        <td class="py-2">{{ $booking->created_at->format('M d, Y') }}</td>
                        <td class="py-2">${{ number_format($booking->total_price, 2) }}</td>
                    </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
    </div>
</div>
@endsection