<x-app-layout>
    {{-- HEADER DENGAN NAVIGASI TERINTEGRASI --}}
    <x-slot name="header">
        <div class="flex justify-between items-center">
            
            {{-- Judul Halaman --}}
            <h2 class="font-semibold text-xl text-gray-800 dark:text-gray-200 leading-tight">
                {{ __('Admin Dashboard') }}
            </h2>

            {{-- Navigasi Tab --}}
            <nav class="flex space-x-2 sm:space-x-4">
                {{-- Link ke Dashboard --}}
                <a href="{{ route('admin.dashboard') }}" 
                   class="px-3 py-2 text-sm font-medium rounded-md transition-colors
                          {{ request()->routeIs('admin.dashboard') 
                             ? 'bg-indigo-600 text-white shadow-sm' 
                             : 'text-gray-500 hover:text-gray-700 hover:bg-gray-100 dark:text-gray-400 dark:hover:bg-gray-700 dark:hover:text-gray-200' }}">
                    Dashboard
                </a>

                {{-- Link ke Manage Hotels --}}
                <a href="{{ route('admin.hotels.index') }}"
                   class="px-3 py-2 text-sm font-medium rounded-md transition-colors
                          {{ request()->routeIs('admin.hotels.index') || request()->routeIs('admin.hotels.*')
                             ? 'bg-indigo-600 text-white shadow-sm' 
                             : 'text-gray-500 hover:text-gray-700 hover:bg-gray-100 dark:text-gray-400 dark:hover:bg-gray-700 dark:hover:text-gray-200' }}">
                    Manage Hotels
                </a>
            </nav>

        </div>
    </x-slot>

    {{-- KONTEN UTAMA HALAMAN --}}
    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            
            {{-- KARTU STATISTIK --}}
            <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-4 gap-6 mb-8">
                
                {{-- Card 1: Total Revenue --}}
                <div class="bg-white dark:bg-gray-800 overflow-hidden shadow-lg rounded-xl p-6 flex items-start justify-between">
                    <div>
                        <h3 class="text-base font-medium text-gray-500 dark:text-gray-400">Total Revenue</h3>
                        <p class="text-3xl font-bold text-gray-900 dark:text-gray-100 mt-2">
                            {{-- Ganti dengan data asli, contoh: Rp {{ number_format($totalRevenue) }} --}}
                            Rp 125.7M
                        </p>
                    </div>
                    <div class="bg-indigo-100 dark:bg-indigo-900 p-3 rounded-full">
                         <svg class="w-6 h-6 text-indigo-600 dark:text-indigo-300" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" d="M12 8c-1.657 0-3 .895-3 2s1.343 2 3 2 3 .895 3 2-1.343 2-3 2m0-8c1.11 0 2.08.402 2.599 1M12 8V7m0 1v.01"></path><path stroke-linecap="round" stroke-linejoin="round" d="M7 16h5m5 0h2M4.5 16H3m19.5 0h-1.5M12 21a9 9 0 110-18 9 9 0 010 18z"></path></svg>
                    </div>
                </div>

                {{-- Card 2: Total Bookings --}}
                <div class="bg-white dark:bg-gray-800 overflow-hidden shadow-lg rounded-xl p-6 flex items-start justify-between">
                    <div>
                        <h3 class="text-base font-medium text-gray-500 dark:text-gray-400">Total Bookings</h3>
                        <p class="text-3xl font-bold text-gray-900 dark:text-gray-100 mt-2">
                             {{-- Ganti dengan data asli, contoh: {{ $totalBookings }} --}}
                            1,840
                        </p>
                    </div>
                     <div class="bg-emerald-100 dark:bg-emerald-900 p-3 rounded-full">
                         <svg class="w-6 h-6 text-emerald-600 dark:text-emerald-300" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" d="M9 5H7a2 2 0 00-2 2v12a2 2 0 002 2h10a2 2 0 002-2V7a2 2 0 00-2-2h-2M9 5a2 2 0 002 2h2a2 2 0 002-2M9 5a2 2 0 012-2h2a2 2 0 012 2m-3 7h3m-3 4h3m-6-4h.01M9 16h.01"></path></svg>
                    </div>
                </div>

                {{-- Card 3: New Guests --}}
                <div class="bg-white dark:bg-gray-800 overflow-hidden shadow-lg rounded-xl p-6 flex items-start justify-between">
                    <div>
                        <h3 class="text-base font-medium text-gray-500 dark:text-gray-400">New Guests</h3>
                        <p class="text-3xl font-bold text-gray-900 dark:text-gray-100 mt-2">
                            {{-- Ganti dengan data asli, contoh: {{ $newGuests }} --}}
                            215
                        </p>
                    </div>
                    <div class="bg-sky-100 dark:bg-sky-900 p-3 rounded-full">
                        <svg class="w-6 h-6 text-sky-600 dark:text-sky-300" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" d="M17 20h5v-2a3 3 0 00-5.356-1.857M17 20H7m10 0v-2c0-.656-.126-1.283-.356-1.857M7 20H2v-2a3 3 0 015.356-1.857M7 20v-2c0-.656.126-1.283.356-1.857m0 0a5.002 5.002 0 019.288 0M15 7a3 3 0 11-6 0 3 3 0 016 0zm6 3a2 2 0 11-4 0 2 2 0 014 0zM7 10a2 2 0 11-4 0 2 2 0 014 0z"></path></svg>
                    </div>
                </div>

                {{-- Card 4: Occupancy Rate --}}
                <div class="bg-white dark:bg-gray-800 overflow-hidden shadow-lg rounded-xl p-6 flex items-start justify-between">
                    <div>
                        <h3 class="text-base font-medium text-gray-500 dark:text-gray-400">Occupancy Rate</h3>
                        <p class="text-3xl font-bold text-gray-900 dark:text-gray-100 mt-2">
                             {{-- Ganti dengan data asli, contoh: {{ $occupancyRate }}% --}}
                            85.3%
                        </p>
                    </div>
                    <div class="bg-amber-100 dark:bg-amber-900 p-3 rounded-full">
                        <svg class="w-6 h-6 text-amber-600 dark:text-amber-300" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" d="M13 7h8m0 0v8m0-8l-8 8-4-4-6 6"></path></svg>
                    </div>
                </div>
            </div>

            {{-- AREA KONTEN UTAMA (TABEL/GRAFIK) --}}
            <div class="bg-white dark:bg-gray-800 overflow-hidden shadow-lg sm:rounded-xl">
                <div class="p-6 text-gray-900 dark:text-gray-100">
                    <h3 class="text-xl font-semibold mb-4">Recent Bookings</h3>
                    
                    {{-- Di sini Anda bisa menempatkan tabel atau komponen Livewire --}}
                    <div class="overflow-x-auto">
                        <table class="min-w-full divide-y divide-gray-200 dark:divide-gray-700">
                            <thead class="bg-gray-50 dark:bg-gray-700">
                                <tr>
                                    <th scope="col" class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Guest Name</th>
                                    <th scope="col" class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Hotel</th>
                                    <th scope="col" class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Check-in</th>
                                    <th scope="col" class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Status</th>
                                </tr>
                            </thead>
                            <tbody class="bg-white dark:bg-gray-800 divide-y divide-gray-200 dark:divide-gray-700">
                                {{-- Loop data asli di sini --}}
                                <tr>
                                    <td class="px-6 py-4 whitespace-nowrap text-sm font-medium text-gray-900 dark:text-white">Ahmad Subarjo</td>
                                    <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-500 dark:text-gray-400">Hotel Bintang Lima</td>
                                    <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-500 dark:text-gray-400">18 Oct 2025</td>
                                    <td class="px-6 py-4 whitespace-nowrap text-sm">
                                        <span class="px-2 inline-flex text-xs leading-5 font-semibold rounded-full bg-green-100 text-green-800">
                                            Confirmed
                                        </span>
                                    </td>
                                </tr>
                                <tr>
                                    <td class="px-6 py-4 whitespace-nowrap text-sm font-medium text-gray-900 dark:text-white">Siti Nurhaliza</td>
                                    <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-500 dark:text-gray-400">Grand Hotel Jaya</td>
                                    <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-500 dark:text-gray-400">17 Oct 2025</td>
                                    <td class="px-6 py-4 whitespace-nowrap text-sm">
                                        <span class="px-2 inline-flex text-xs leading-5 font-semibold rounded-full bg-yellow-100 text-yellow-800">
                                            Pending
                                        </span>
                                    </td>
                                </tr>
                                {{-- Akhir Loop --}}
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>
