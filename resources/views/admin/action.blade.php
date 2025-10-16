@extends('layouts.admin')

@section('title', 'Admin Action Panel')

@section('content')
    {{-- File ini hanya memanggil komponen Livewire ActionPanel --}}
    @livewire('admin.action-panel')
@endsection