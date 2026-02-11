@extends('layouts.app')

@section('content')
<div class="container mx-auto px-4 py-8">
    <h1 class="text-3xl font-bold mb-8">Your Travel Dashboard</h1>
    
    <!-- Stats Cards -->
    <div class="grid grid-cols-1 md:grid-cols-4 gap-6 mb-8">
        @foreach([
            'total_reservations' => 'Total Reservations',
            'upcoming_trips' => 'Upcoming Trips',
            'activities' => 'Activities Booked',
            'flights' => 'Flights Taken'
        ] as $key => $title)
        <div class="bg-white rounded-lg shadow p-6">
            <h3 class="text-gray-500 text-sm font-medium">{{ $title }}</h3>
            <p class="text-2xl font-bold">{{ $stats[$key] }}</p>
        </div>
        @endforeach
    </div>

    <!-- Recent Bookings -->
    <div class="bg-white rounded-lg shadow p-6 mb-8">
        <h2 class="text-xl font-bold mb-4">Recent Bookings</h2>
        <div class="overflow-x-auto">
            <table class="min-w-full">
                <thead>
                    <tr class="border-b">
                        <th class="text-left py-2">Service</th>
                        <th class="text-left py-2">Date</th>
                        <th class="text-left py-2">Status</th>
                    </tr>
                </thead>
                <tbody>
                    @forelse($stats['recent_bookings'] as $booking)
                    <tr class="border-b">
                        <td class="py-2">{{ class_basename($booking->bookable_type) }}</td>
                        <td class="py-2">{{ $booking->created_at->format('M d, Y') }}</td>
                        <td class="py-2 capitalize">{{ $booking->status }}</td>
                    </tr>
                    @empty
                    <tr>
                        <td colspan="3" class="py-4 text-center">No bookings yet</td>
                    </tr>
                    @endforelse
                </tbody>
            </table>
        </div>
    </div>

    <!-- Quick Actions -->
    <div class="bg-white rounded-lg shadow p-6">
        <h2 class="text-xl font-bold mb-4">Quick Actions</h2>
        <div class="flex flex-wrap gap-4">
            @foreach([
                'flights.index' => 'Book Flight',
                'hotels.index' => 'Find Hotel',
                'activities.index' => 'Explore Activities',
                'cruises.index' => 'Discover Cruises'
            ] as $route => $text)
            <a href="{{ route($route) }}" class="px-4 py-2 bg-blue-600 text-white rounded hover:bg-blue-700">
                {{ $text }}
            </a>
            @endforeach
        </div>
    </div>
</div>
@endsection