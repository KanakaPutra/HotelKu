@extends('layouts.admin')

@section('title', 'Manage Hotels')

@section('content')
    <div class="container mx-auto px-4 sm:px-6 lg:px-8 py-8">
        {{-- Baris ini yang memanggil semua kode yang baru saja kita buat --}}
        @livewire('admin.manage-hotels')
    </div>
@endsection