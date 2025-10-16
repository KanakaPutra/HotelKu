<x-app-layout>
    {{-- HEADER BARU YANG TERINTEGRASI --}}
    <x-slot name="header">
        <div class="flex justify-between items-center">
            
            {{-- Judul Halaman --}}
            <h2 class="font-semibold text-xl text-gray-800 dark:text-gray-200 leading-tight">
                {{ __('Dashboard') }}
                {{-- Ganti judul ini secara dinamis sesuai halaman, misal: 'Manage Hotels' --}}
            </h2>

            {{-- Navigasi Tab yang Baru --}}
            <nav class="flex space-x-4">
                {{-- Link ke Dashboard --}}
                <a href="{{ route('admin.dashboard') }}" 
                   class="px-3 py-2 text-sm font-medium rounded-md
                          {{ request()->routeIs('admin.dashboard') 
                             ? 'bg-indigo-600 text-white shadow-sm' 
                             : 'text-gray-500 hover:text-gray-700 hover:bg-gray-100 dark:text-gray-400 dark:hover:bg-gray-700 dark:hover:text-gray-200' }}">
                    Dashboard
                </a>

                {{-- Link ke Manage Hotels --}}
                <a href="{{ route('admin.hotels.index') }}"
                   class="px-3 py-2 text-sm font-medium rounded-md
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
            <div class="bg-white dark:bg-gray-800 overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 text-gray-900 dark:text-gray-100">
                    
                    {{-- KONTEN ANDA (STATISTIK, TABEL, DSB.) MASUK DI SINI --}}
                    
                    <div class="grid grid-cols-1 sm:grid-cols-2 md:grid-cols-4 gap-6 mb-8">
                        <div class="bg-gray-100 dark:bg-gray-700 p-6 rounded-lg">
                            <h3 class="text-lg font-medium text-gray-500 dark:text-gray-400">Total Bookings</h3>
                            <p class="text-3xl font-bold mt-2">1,250</p>
                        </div>
                        <div class="bg-gray-100 dark:bg-gray-700 p-6 rounded-lg">
                            <h3 class="text-lg font-medium text-gray-500 dark:text-gray-400">Revenue</h3>
                            <p class="text-3xl font-bold mt-2">$84,500</p>
                        </div>
                        <div class="bg-gray-100 dark:bg-gray-700 p-6 rounded-lg">
                            <h3 class="text-lg font-medium text-gray-500 dark:text-gray-400">Available Rooms</h3>
                            <p class="text-3xl font-bold mt-2">78</p>
                        </div>
                        <div class="bg-gray-100 dark:bg-gray-700 p-6 rounded-lg">
                            <h3 class="text-lg font-medium text-gray-500 dark:text-gray-400">New Guests</h3>
                            <p class="text-3xl font-bold mt-2">42</p>
                        </div>
                    </div>

                    <div>
                         <h3 class="text-xl font-semibold mb-4">Recent Bookings</h3>
                         <div class="bg-gray-100 dark:bg-gray-700 p-6 rounded-lg h-64">
                            {{-- Tempat untuk tabel data Anda --}}
                            <p class="text-gray-500">Tabel data pemesanan akan muncul di sini.</p>
                         </div>
                    </div>

                </div>
            </div>
        </div>
    </div>
</x-app-layout>