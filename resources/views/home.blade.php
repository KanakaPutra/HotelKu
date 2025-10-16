<x-app-layout>
    <div class="py-12 bg-gray-50">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="p-6 lg:p-8">
                <h2 class="text-3xl font-bold text-center text-gray-800 mb-10">
                    Pilih Hotel Impian Anda
                </h2>

                {{-- Panggil komponen Livewire untuk menampilkan hotel di sini --}}
                @livewire('show-hotels')
            </div>
        </div>
    </div>
</x-app-layout>