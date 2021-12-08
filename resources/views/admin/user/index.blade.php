@extends('layouts.app')

@section('content')

<h1 class="h3 mb-2 text-gray-800">Manajemen User</h1>
<p class="mb-4">
    Di halaman ini anda dapat membuat User
</p>

@livewire('admin.user.list-user')

@endsection