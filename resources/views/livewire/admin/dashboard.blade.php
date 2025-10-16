@extends('layouts.admin')

@section('title', 'Admin Dashboard')

@section('content')
    {{-- Memanggil komponen Livewire yang akan kita isi logikanya --}}
    @livewire('admin.dashboard')
@endsection