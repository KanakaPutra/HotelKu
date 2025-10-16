<?php

namespace App\Livewire\Admin;

use Livewire\Component;
use App\Models\Hotel;
use Livewire\WithPagination;    // Untuk membuat halaman (1, 2, 3, dst.)
use Livewire\WithFileUploads;  // Untuk menangani upload gambar
use Illuminate\Support\Facades\Storage;

class ManageHotels extends Component
{
    use WithPagination;
    use WithFileUploads;

    // Properti ini akan terhubung ke form input (dikenal sebagai data binding)
    public $name, $description, $address;
    
    // Properti untuk menangani file gambar dan ID hotel saat diedit
    public $image;
    public $hotelId;
    public $newImage; // Untuk menampung gambar baru saat proses edit

    // Properti untuk mengontrol tampilan, seperti menampilkan modal/popup
    public $showModal = false;
    public $isEditMode = false;
    
    // Aturan validasi untuk form
    protected $rules = [
        'name' => 'required|string|min:5',
        'description' => 'required|string',
        'address' => 'required|string|max:255',
    ];

    // Fungsi utama yang dipanggil untuk menampilkan view komponen
    public function render()
    {
        // Mengambil data hotel dari database, diurutkan dari yang terbaru, dan dibagi per 5 data per halaman
        $hotels = Hotel::latest()->paginate(5);
        
        // Mengirim data 'hotels' ke view
        return view('livewire.admin.manage-hotels', [
            'hotels' => $hotels
        ]);
    }

    // --- FUNGSI UNTUK MEMBUKA DAN MENUTUP MODAL/POPUP ---
    
    public function create()
    {
        $this->resetInputFields(); // Bersihkan form
        $this->isEditMode = false; // Set mode ke "Tambah Data"
        $this->showModal = true;   // Tampilkan modal
    }

    public function closeModal()
    {
        $this->showModal = false;
        $this->resetInputFields();
    }

    // --- FUNGSI-FUNGSI CRUD (CREATE, READ, UPDATE, DELETE) ---

    public function store()
    {
        // Validasi input, termasuk gambar yang wajib diisi saat membuat data baru
        $this->validate(array_merge($this->rules, [
            'image' => 'required|image|mimes:jpg,jpeg,png|max:2048' // max 2MB
        ]));

        // Simpan gambar ke storage/app/public/hotels
        $imagePath = $this->image->store('hotels', 'public');

        // Buat data hotel baru di database
        Hotel::create([
            'name' => $this->name,
            'description' => $this->description,
            'address' => $this->address,
            'image_path' => $imagePath
        ]);

        session()->flash('success', 'Hotel berhasil ditambahkan.'); // Buat notifikasi sukses
        $this->closeModal(); // Tutup modal
    }

    public function edit($id)
    {
        $hotel = Hotel::findOrFail($id); // Cari hotel berdasarkan ID
        $this->hotelId = $id;
        $this->name = $hotel->name;
        $this->description = $hotel->description;
        $this->address = $hotel->address;
        
        $this->isEditMode = true; // Set mode ke "Edit Data"
        $this->showModal = true;  // Tampilkan modal
    }

    public function update()
    {
        $this->validate($this->rules); // Validasi data teks
        
        $hotel = Hotel::find($this->hotelId);
        $imagePath = $hotel->image_path;
        
        // Cek apakah admin mengupload gambar baru
        if ($this->newImage) {
            $this->validate(['newImage' => 'image|mimes:jpg,jpeg,png|max:2048']);
            
            // Hapus gambar lama dari storage jika ada
            if($hotel->image_path) {
                Storage::disk('public')->delete($hotel->image_path);
            }
            
            // Simpan gambar baru
            $imagePath = $this->newImage->store('hotels', 'public');
        }

        // Update data hotel di database
        $hotel->update([
            'name' => $this->name,
            'description' => $this->description,
            'address' => $this->address,
            'image_path' => $imagePath,
        ]);

        session()->flash('success', 'Hotel berhasil diperbarui.');
        $this->closeModal();
    }
    
    public function delete($id)
    {
        $hotel = Hotel::findOrFail($id);
        // Hapus gambar dari storage
        if($hotel->image_path) {
            Storage::disk('public')->delete($hotel->image_path);
        }
        // Hapus data dari database
        $hotel->delete();
        session()->flash('success', 'Hotel berhasil dihapus.');
    }
    
    // --- FUNGSI BANTUAN ---

    private function resetInputFields()
    {
        $this->name = '';
        $this->description = '';
        $this->address = '';
        $this->image = null;
        $this->newImage = null;
        $this->hotelId = null;
        $this->isEditMode = false;
    }
}