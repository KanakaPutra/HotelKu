<x-app-layout>
    <div class="py-12 bg-gray-50">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            {{-- Memanggil komponen Livewire dan mengirimkan ID hotel dari URL --}}
            @livewire('hotel-details', ['hotelId' => $hotelId])
        </div>
    </div>
</x-app-layout>