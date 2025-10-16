<div>
    {{-- Tombol dan Notifikasi --}}
    <div class="flex justify-between items-center mb-6">
        <h2 class="text-2xl font-bold">Kamar untuk: <span class="text-blue-600">{{ $hotel->name }}</span></h2>
        <button wire:click="create()" class="px-4 py-2 bg-blue-500 text-white rounded-md hover:bg-blue-600">Tambah Kamar</button>
    </div>
    @if (session()->has('success'))
        <div class="bg-green-100 border border-green-400 text-green-700 px-4 py-3 rounded relative mb-4">
            {{ session('success') }}
        </div>
    @endif

    {{-- Tabel Kamar --}}
    <div class="bg-white shadow-md rounded-lg overflow-x-auto">
        <table class="min-w-full divide-y divide-gray-200">
            <thead class="bg-gray-50">
                <tr>
                    <th class="px-6 py-3 text-left">Tipe Kamar</th>
                    <th class="px-6 py-3 text-left">Harga / Malam</th>
                    <th class="px-6 py-3 text-left">Aksi</th>
                </tr>
            </thead>
            <tbody class="bg-white divide-y divide-gray-200">
                @forelse($rooms as $room)
                <tr>
                    <td class="px-6 py-4">{{ $room->type }}</td>
                    <td class="px-6 py-4">Rp {{ number_format($room->price_per_night, 0, ',', '.') }}</td>
                    <td class="px-6 py-4">
                        <button wire:click="edit({{ $room->id }})" class="text-indigo-600 hover:text-indigo-900">Edit</button>
                        <button wire:click="delete({{ $room->id }})" wire:confirm="Yakin hapus kamar ini?" class="text-red-600 hover:text-red-900 ml-4">Hapus</button>
                    </td>
                </tr>
                @empty
                <tr><td colspan="3" class="text-center py-4">Belum ada kamar untuk hotel ini.</td></tr>
                @endforelse
            </tbody>
        </table>
    </div>
    <div class="mt-4">{{ $rooms->links() }}</div>

    {{-- Modal Form --}}
    @if($showModal)
    <div class="fixed inset-0 bg-black bg-opacity-50 flex items-center justify-center z-50">
        <div class="bg-white p-6 rounded-lg shadow-xl w-full max-w-lg">
            <h3 class="text-lg font-bold mb-4">{{ $isEditMode ? 'Edit Kamar' : 'Tambah Kamar Baru' }}</h3>
            <form wire:submit.prevent="{{ $isEditMode ? 'update' : 'store' }}">
                <div class="space-y-4">
                    <div>
                        <label>Tipe Kamar</label>
                        <input type="text" wire:model.lazy="type" class="w-full border-gray-300 rounded-md">
                        @error('type') <span class="text-red-500 text-xs">{{ $message }}</span> @enderror
                    </div>
                    <div>
                        <label>Deskripsi</label>
                        <textarea wire:model.lazy="description" rows="3" class="w-full border-gray-300 rounded-md"></textarea>
                        @error('description') <span class="text-red-500 text-xs">{{ $message }}</span> @enderror
                    </div>
                    <div>
                        <label>Harga / Malam</label>
                        <input type="number" wire:model.lazy="price_per_night" class="w-full border-gray-300 rounded-md">
                        @error('price_per_night') <span class="text-red-500 text-xs">{{ $message }}</span> @enderror
                    </div>
                </div>
                <div class="mt-6 flex justify-end">
                    <button type="button" wire:click="closeModal()" class="px-4 py-2 bg-gray-300 rounded-md mr-2">Batal</button>
                    <button type="submit" class="px-4 py-2 bg-blue-500 text-white rounded-md">Simpan</button>
                </div>
            </form>
        </div>
    </div>
    @endif
</div>