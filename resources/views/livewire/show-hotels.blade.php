<div>
    <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-8">
        @forelse($hotels as $hotel)
            <div class="bg-white rounded-lg shadow-md overflow-hidden transform hover:-translate-y-2 transition-transform duration-300">
                <img class="w-full h-48 object-cover" src="{{ asset('storage/' . $hotel->image_path) }}" alt="Gambar {{ $hotel->name }}">
                <div class="p-6">
                    <h3 class="font-bold text-xl mb-2">{{ $hotel->name }}</h3>
                    <p class="text-gray-600 text-sm mb-4">{{ $hotel->address }}</p>
                    <a href="{{ route('hotels.show', $hotel) }}" wire:navigate class="w-full text-center block bg-blue-500 text-white font-bold py-2 px-4 rounded hover:bg-blue-600">
                        Lihat Detail
                    </a>
                </div>
            </div>
        @empty
            <p class="col-span-3 text-center text-gray-500">Belum ada hotel yang tersedia saat ini.</p>
        @endforelse
    </div>
    <div class="mt-8">
        {{ $hotels->links() }}
    </div>
</div>