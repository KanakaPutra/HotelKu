<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('My Bookings') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 text-gray-900">

                    @if ($bookings->count() > 0)
                        <table class="min-w-full border border-gray-200 rounded-lg">
                            <thead class="bg-gray-100">
                                <tr>
                                    <th class="px-4 py-2 border">#</th>
                                    <th class="px-4 py-2 border">Hotel</th>
                                    <th class="px-4 py-2 border">Room</th>
                                    <th class="px-4 py-2 border">Check-in</th>
                                    <th class="px-4 py-2 border">Check-out</th>
                                    <th class="px-4 py-2 border">Total</th>
                                    <th class="px-4 py-2 border">Status</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($bookings as $index => $booking)
                                    <tr class="text-center">
                                        <td class="px-4 py-2 border">{{ $index + 1 }}</td>
                                        <td class="px-4 py-2 border">{{ $booking->room->hotel->name ?? '-' }}</td>
                                        <td class="px-4 py-2 border">{{ $booking->room->room_number ?? '-' }}</td>
                                        <td class="px-4 py-2 border">{{ $booking->check_in_date }}</td>
                                        <td class="px-4 py-2 border">{{ $booking->check_out_date }}</td>
                                        <td class="px-4 py-2 border">Rp {{ number_format($booking->total_price, 0, ',', '.') }}</td>
                                        <td class="px-4 py-2 border">
                                            <span class="px-3 py-1 rounded text-white
                                                @if ($booking->status == 'pending') bg-yellow-500 
                                                @elseif($booking->status == 'confirmed') bg-green-600
                                                @else bg-red-600 @endif">
                                                {{ ucfirst($booking->status) }}
                                            </span>
                                        </td>
                                    </tr>
                                @endforeach
                            </tbody>
                        </table>
                    @else
                        <p class="text-center text-gray-600">Anda belum memiliki riwayat booking.</p>
                    @endif

                </div>
            </div>
        </div>
    </div>
</x-app-layout>
