<div>
    {{-- Tombol "Tambah Hotel" dan Area Notifikasi --}}
    <div class="flex justify-between items-center mb-6">
        <h2 class="text-2xl font-bold">Manage Hotels</h2>
        <button wire:click="create()" class="px-4 py-2 bg-blue-500 text-white rounded-md hover:bg-blue-600 focus:outline-none">
            Tambah Hotel Baru
        </button>
    </div>
    
    @if (session()->has('success'))
        <div class="bg-green-100 border border-green-400 text-green-700 px-4 py-3 rounded relative mb-4" role="alert">
            <span class="block sm:inline">{{ session('success') }}</span>
        </div>
    @endif

    {{-- Tabel untuk Menampilkan Data Hotel --}}
    <div class="bg-white shadow-md rounded-lg overflow-x-auto">
        <table class="min-w-full divide-y divide-gray-200">
            <thead class="bg-gray-50">
                <tr>
                    <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase">Gambar</th>
                    <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase">Nama Hotel</th>
                    <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase">Alamat</th>
                    <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase">Aksi</th>
                </tr>
            </thead>
            <tbody class="bg-white divide-y divide-gray-200">
                @forelse($hotels as $hotel)
                <tr>
                    <td class="px-6 py-4">
                        <img src="{{ asset('storage/' . $hotel->image_path) }}" alt="{{ $hotel->name }}" class="w-24 h-16 object-cover rounded">
                    </td>
                    <td class="px-6 py-4 font-medium text-gray-900">{{ $hotel->name }}</td>
                    <td class="px-6 py-4 text-sm text-gray-600">{{ Str::limit($hotel->address, 40) }}</td>
                    <td class="px-6 py-4 text-sm font-medium">
                        <button wire:click="edit({{ $hotel->id }})" class="text-indigo-600 hover:text-indigo-900">Edit</button>
                        <button wire:click="delete({{ $hotel->id }})" wire:confirm="Anda yakin ingin menghapus hotel ini?" class="text-red-600 hover:text-red-900 ml-4">Hapus</button>
                    </td>
                </tr>
                @empty
                <tr>
                    <td colspan="4" class="px-6 py-4 text-center text-gray-500">Tidak ada data hotel ditemukan.</td>
                </tr>
                @endforelse
            </tbody>
        </table>
    </div>
    <div class="mt-4">{{ $hotels->links() }}</div>

    {{-- Modal/Popup untuk Form Tambah/Edit --}}
    @if($showModal)
    <div class="fixed inset-0 bg-black bg-opacity-50 flex items-center justify-center z-50">
        <div class="bg-white p-6 rounded-lg shadow-xl w-full max-w-lg">
            <h3 class="text-lg font-bold mb-4">{{ $isEditMode ? 'Edit Hotel' : 'Tambah Hotel Baru' }}</h3>
            <form wire:submit.prevent="{{ $isEditMode ? 'update' : 'store' }}">
                <div class="space-y-4">
                    <div>
                        <label for="name" class="block text-sm font-medium text-gray-700">Nama Hotel</label>
                        <input type="text" wire:model.lazy="name" id="name" class="mt-1 block w-full border-gray-300 rounded-md shadow-sm">
                        @error('name') <span class="text-red-500 text-xs">{{ $message }}</span> @enderror
                    </div>
                    <div>
                        <label for="description" class="block text-sm font-medium text-gray-700">Deskripsi</label>
                        <textarea wire:model.lazy="description" id="description" rows="4" class="mt-1 block w-full border-gray-300 rounded-md shadow-sm"></textarea>
                        @error('description') <span class="text-red-500 text-xs">{{ $message }}</span> @enderror
                    </div>
                    <div>
                        <label for="address" class="block text-sm font-medium text-gray-700">Alamat</label>
                        <input type="text" wire:model.lazy="address" id="address" class="mt-1 block w-full border-gray-300 rounded-md shadow-sm">
                        @error('address') <span class="text-red-500 text-xs">{{ $message }}</span> @enderror
                    </div>
                    <div>
                        <label for="image" class="block text-sm font-medium text-gray-700">Gambar</label>
                        <input type="file" wire:model="{{ $isEditMode ? 'newImage' : 'image' }}" id="image" class="mt-1 block w-full">
                        <div wire:loading wire:target="{{ $isEditMode ? 'newImage' : 'image' }}" class="text-sm text-gray-500 mt-1">Uploading...</div>
                        
                        {{-- Preview Gambar --}}
                        @if ($isEditMode && $newImage)
                            <img src="{{ $newImage->temporaryUrl() }}" class="mt-2 w-32 h-auto rounded">
                        @elseif (!$isEditMode && $image)
                            <img src="{{ $image->temporaryUrl() }}" class="mt-2 w-32 h-auto rounded">
                        @endif
                        @error($isEditMode ? 'newImage' : 'image') <span class="text-red-500 text-xs">{{ $message }}</span> @enderror
                    </div>
                </div>
                <div class="mt-6 flex justify-end space-x-4">
                    <button type="button" wire:click="closeModal()" class="px-4 py-2 bg-gray-300 text-gray-800 rounded-md hover:bg-gray-400">Batal</button>
                    <button type="submit" class="px-4 py-2 bg-blue-500 text-white rounded-md hover:bg-blue-600">Simpan</button>
                </div>
            </form>
        </div>
    </div>
    @endif
</div>