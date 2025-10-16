@extends('layouts.admin')
@section('title', 'Manage Rooms for ' . $hotel->name)

@section('content')
    @livewire('admin.manage-rooms', ['hotel' => $hotel])
@endsection