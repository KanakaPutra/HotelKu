<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Hotel;
use Illuminate\Http\Request;

class HotelController extends Controller
{
    /**
     * Menampilkan daftar hotel
     *
     * @return \Illuminate\View\View
     */
    public function index()
    {
        $hotels = Hotel::all();
        return view('admin.hotels.index', compact('hotels'));
    }

    /**
     * Form tambah hotel baru
     *
     * @return \Illuminate\View\View
     */
    public function create()
    {
        return view('admin.hotels.create');
    }

    /**
     * Simpan data hotel baru
     *
     * @param \Illuminate\Http\Request $request
     * @return \Illuminate\Http\RedirectResponse
     */
    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required',
            'location' => 'required',
            'description' => 'nullable',
        ]);

        Hotel::create($request->only('name', 'location', 'description'));

        return redirect()->route('admin.hotels.index')
            ->with('success', 'Hotel berhasil ditambahkan');
    }

    /**
     * Form edit hotel
     *
     * @param \App\Models\Hotel $hotel
     * @return \Illuminate\View\View
     */
    public function edit(Hotel $hotel)
    {
        return view('admin.hotels.edit', compact('hotel'));
    }

    /**
     * Update data hotel
     *
     * @param \Illuminate\Http\Request $request
     * @param \App\Models\Hotel $hotel
     * @return \Illuminate\Http\RedirectResponse
     */
    public function update(Request $request, Hotel $hotel)
    {
        $request->validate([
            'name' => 'required',
            'location' => 'required',
            'description' => 'nullable',
        ]);

        $hotel->update($request->only('name', 'location', 'description'));

        return redirect()->route('admin.hotels.index')
            ->with('success', 'Hotel berhasil diperbarui');
    }

    /**
     * Hapus hotel
     *
     * @param \App\Models\Hotel $hotel
     * @return \Illuminate\Http\RedirectResponse
     */
    public function destroy(Hotel $hotel)
    {
        $hotel->delete();

        return redirect()->route('admin.hotels.index')
            ->with('success', 'Hotel berhasil dihapus');
    }
}
