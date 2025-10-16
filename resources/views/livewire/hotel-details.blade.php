<div class="bg-white rounded-lg shadow-xl overflow-hidden">
    
    {{-- TAHAP 1: PEMILIHAN KAMAR (Tampilan Awal) --}}
    @if ($step == 1)
        <div>
            <img class="w-full h-96 object-cover" src="{{ $hotel->image_path ? asset('storage/' . $hotel->image_path) : 'https://placehold.co/1200x400/EBF4FF/7F9CF5?text=Hotel+Image' }}" alt="Gambar {{ $hotel->name }}">
            <div class="p-8">
                <h1 class="text-4xl font-bold text-gray-800">{{ $hotel->name }}</h1>
                <p class="text-lg text-gray-600 mt-2">{{ $hotel->address }}</p>
                <p class="mt-6 text-gray-700 leading-relaxed">{{ $hotel->description }}</p>
            </div>
        </div>

        <hr>

        <div class="p-8">
            <h2 class="text-2xl font-bold text-gray-800 mb-6">Pilih Kamar Anda</h2>

            <div class="space-y-6">
                @forelse($hotel->rooms as $room)
                    <div class="border rounded-lg p-4 flex flex-col md:flex-row justify-between items-center gap-4">
                        <div class="flex-1 w-full md:w-auto">
                            <h3 class="font-bold text-lg">{{ $room->type }}</h3>
                            <p class="text-sm text-gray-600">{{ $room->description }}</p>
                            <p class="font-bold text-xl text-blue-600 mt-2">Rp {{ number_format($room->price_per_night, 0, ',', '.') }} / malam</p>
                        </div>

                        <div class="w-full md:w-auto">
                            <div class="flex flex-col sm:flex-row items-end space-y-2 sm:space-y-0 sm:space-x-2">
                                <div>
                                    <label for="checkin-{{$room->id}}" class="block text-sm font-medium text-gray-700">Check-in</label>
                                    <input type="date" id="checkin-{{$room->id}}" wire:model.lazy="checkInDate" required class="mt-1 block w-full rounded-md border-gray-300 shadow-sm text-sm">
                                </div>
                                <div>
                                    <label for="checkout-{{$room->id}}" class="block text-sm font-medium text-gray-700">Check-out</label>
                                    <input type="date" id="checkout-{{$room->id}}" wire:model.lazy="checkOutDate" required class="mt-1 block w-full rounded-md border-gray-300 shadow-sm text-sm">
                                </div>
                                <button wire:click="bookRoom({{ $room->id }})" wire:loading.attr="disabled" class="bg-green-500 text-white px-4 py-2 rounded-md hover:bg-green-600 w-full sm:w-auto">
                                    Pesan
                                </button>
                            </div>
                              @error('checkInDate') <span class="text-red-500 text-xs mt-1">{{ $message }}</span> @enderror
                              @error('checkOutDate') <span class="text-red-500 text-xs mt-1">{{ $message }}</span> @enderror
                        </div>
                    </div>
                @empty
                    <p class="text-center text-gray-500">Saat ini belum ada kamar yang tersedia untuk hotel ini.</p>
                @endforelse
            </div>
        </div>

    {{-- TAHAP 2: KONFIRMASI & PEMBAYARAN (Tampilan Baru) --}}
    @elseif ($step == 2)
        <div class="p-8">
            <div wire:loading class="text-center p-4 text-gray-600">
                <p>Memproses pesanan Anda...</p>
            </div>
            <div wire:loading.remove>
                <h1 class="text-3xl font-bold text-gray-800">Konfirmasi Pesanan Anda</h1>
                <p class="text-gray-600 mt-2">Satu langkah lagi untuk mengamankan kamar impian Anda.</p>

                {{-- Ringkasan Pesanan --}}
                <div class="mt-8 border rounded-lg p-6 bg-gray-50">
                    <h2 class="text-xl font-semibold mb-4">Ringkasan Pesanan</h2>
                    <div class="space-y-3">
                        <div class="flex justify-between">
                            <span class="text-gray-600">Hotel:</span>
                            <span class="font-medium text-gray-900">{{ $hotel->name }}</span>
                        </div>
                        <div class="flex justify-between">
                            <span class="text-gray-600">Tipe Kamar:</span>
                            <span class="font-medium text-gray-900">{{ $selectedRoom->type }}</span>
                        </div>
                        <hr class="my-3">
                        <div class="flex justify-between">
                            <span class="text-gray-600">Check-in:</span>
                            <span class="font-medium text-gray-900">{{ \Carbon\Carbon::parse($checkInDate)->format('d F Y') }}</span>
                        </div>
                        <div class="flex justify-between">
                            <span class="text-gray-600">Check-out:</span>
                            <span class="font-medium text-gray-900">{{ \Carbon\Carbon::parse($checkOutDate)->format('d F Y') }}</span>
                        </div>
                        <div class="flex justify-between">
                            <span class="text-gray-600">Total Malam:</span>
                            <span class="font-medium text-gray-900">{{ $totalNights }} Malam</span>
                        </div>
                        <hr class="my-3">
                        <div class="flex justify-between text-2xl font-bold">
                            <span class="text-gray-800">Total Harga:</span>
                            <span class="text-blue-600">Rp {{ number_format($totalPrice, 0, ',', '.') }}</span>
                        </div>
                    </div>
                </div>

                {{-- Pilihan Metode Pembayaran --}}
                <div class="mt-8">
                    <h2 class="text-xl font-semibold mb-4">Pilih Metode Pembayaran</h2>
                    <div class="space-y-3">
                        <label class="flex items-center p-4 border rounded-lg cursor-pointer hover:bg-gray-100 has-[:checked]:bg-indigo-50 has-[:checked]:border-indigo-400">
                            <input type="radio" name="payment_method" value="bank_transfer" wire:model="selectedPaymentMethod" class="h-4 w-4 text-indigo-600 border-gray-300 focus:ring-indigo-500">
                            <span class="ml-3 font-medium text-gray-800">Transfer Bank (BCA, Mandiri, BRI)</span>
                        </label>
                        <label class="flex items-center p-4 border rounded-lg cursor-pointer hover:bg-gray-100 has-[:checked]:bg-indigo-50 has-[:checked]:border-indigo-400">
                            <input type="radio" name="payment_method" value="credit_card" wire:model="selectedPaymentMethod" class="h-4 w-4 text-indigo-600 border-gray-300 focus:ring-indigo-500">
                            <span class="ml-3 font-medium text-gray-800">Kartu Kredit/Debit</span>
                        </label>
                         <label class="flex items-center p-4 border rounded-lg cursor-pointer hover:bg-gray-100 has-[:checked]:bg-indigo-50 has-[:checked]:border-indigo-400">
                            <input type="radio" name="payment_method" value="gopay" wire:model="selectedPaymentMethod" class="h-4 w-4 text-indigo-600 border-gray-300 focus:ring-indigo-500">
                            <span class="ml-3 font-medium text-gray-800">GoPay / E-Wallet Lainnya</span>
                        </label>
                    </div>
                </div>
                
                {{-- Tombol Aksi --}}
                <div class="mt-8 flex flex-col sm:flex-row-reverse sm:justify-between sm:items-center gap-4">
                    <button wire:click="confirmBooking" wire:loading.attr="disabled" class="w-full sm:w-auto bg-blue-600 text-white font-bold py-3 px-8 rounded-lg hover:bg-blue-700 text-lg transition-colors">
                        <span wire:loading.remove wire:target="confirmBooking">Konfirmasi & Bayar</span>
                        <span wire:loading wire:target="confirmBooking">Memproses...</span>
                    </button>
                    <button wire:click="$set('step', 1)" class="w-full sm:w-auto text-gray-600 font-medium hover:underline text-center sm:text-left">
                        &larr; Kembali Pilih Kamar
                    </button>
                </div>
            </div>
        </div>
    @endif
</div>  

<script>
    document.addEventListener('livewire:init', () => {
        Livewire.on('showPaymentSuccess', () => {
            Swal.fire({
                icon: 'success',
                title: 'Pembayaran Berhasil!',
                text: 'Pemesanan Anda telah dikonfirmasi.',
                showConfirmButton: false,
                timer: 1500
            });
        });
    });
</script>
