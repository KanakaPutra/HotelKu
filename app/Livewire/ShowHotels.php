<?php

namespace App\Livewire;

use Livewire\Component;
use App\Models\Hotel;
use Livewire\WithPagination;

class ShowHotels extends Component
{
    use WithPagination;

    public function render()
    {
        return view('livewire.show-hotels', [
            'hotels' => Hotel::latest()->paginate(9)
        ]);
    }
}