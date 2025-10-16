<div>
    <div class="mb-6 border-b border-gray-200">
        <nav class="flex space-x-4" aria-label="Tabs">
            <button wire:click="setActiveTab('dashboard')" 
                    class="{{ $activeTab === 'dashboard' ? 'border-blue-500 text-blue-600' : 'border-transparent text-gray-500 hover:text-gray-700 hover:border-gray-300' }} whitespace-nowrap py-4 px-1 border-b-2 font-medium text-sm">
                Dashboard
            </button>
            <button wire:click="setActiveTab('hotels')" 
                    class="{{ $activeTab === 'hotels' ? 'border-blue-500 text-blue-600' : 'border-transparent text-gray-500 hover:text-gray-700 hover:border-gray-300' }} whitespace-nowrap py-4 px-1 border-b-2 font-medium text-sm">
                Manage Hotels
            </button>
        </nav>
    </div>

    <div>
        @if ($activeTab === 'dashboard')
            {{-- Memanggil komponen dashboard dengan lazy loading --}}
            <livewire:admin.dashboard lazy />
        @elseif ($activeTab === 'hotels')
            {{-- Komponen ini tidak perlu lazy karena biasanya cepat --}}
            @livewire('admin.manage-hotels')
        @endif
    </div>
</div>