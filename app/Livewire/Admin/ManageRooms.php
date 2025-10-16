<?php

namespace App\Livewire\Admin;

use App\Models\Hotel;
use App\Models\Room;
use Livewire\Component;
use Livewire\WithPagination;

class ManageRooms extends Component
{
    use WithPagination;

    public Hotel $hotel;
    public $type, $description, $price_per_night;
    public $roomId;
    public $showModal = false;
    public $isEditMode = false;

    protected $rules = [
        'type' => 'required|string|max:255',
        'description' => 'required|string',
        'price_per_night' => 'required|numeric|min:0',
    ];

    public function mount(Hotel $hotel)
    {
        $this->hotel = $hotel;
    }

    public function render()
    {
        return view('livewire.admin.manage-rooms', [
            'rooms' => $this->hotel->rooms()->latest()->paginate(5)
        ]);
    }

    public function create()
    {
        $this->resetInputFields();
        $this->isEditMode = false;
        $this->showModal = true;
    }

    public function store()
    {
        $this->validate();

        $this->hotel->rooms()->create([
            'type' => $this->type,
            'description' => $this->description,
            'price_per_night' => $this->price_per_night,
        ]);

        session()->flash('success', 'Kamar berhasil ditambahkan.');
        $this->closeModal();
    }

    public function edit(Room $room)
    {
        $this->roomId = $room->id;
        $this->type = $room->type;
        $this->description = $room->description;
        $this->price_per_night = $room->price_per_night;
        $this->isEditMode = true;
        $this->showModal = true;
    }

    public function update()
    {
        $this->validate();
        $room = Room::find($this->roomId);
        $room->update([
            'type' => $this->type,
            'description' => $this->description,
            'price_per_night' => $this->price_per_night,
        ]);
        session()->flash('success', 'Kamar berhasil diperbarui.');
        $this->closeModal();
    }

    public function delete(Room $room)
    {
        $room->delete();
        session()->flash('success', 'Kamar berhasil dihapus.');
    }

    public function closeModal()
    {
        $this->showModal = false;
        $this->resetInputFields();
    }

    private function resetInputFields()
    {
        $this->type = '';
        $this->description = '';
        $this->price_per_night = '';
        $this->roomId = null;
    }
}