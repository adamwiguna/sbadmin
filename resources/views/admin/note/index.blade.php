@extends('layouts.app')

@section('content')

<h1 class="h3 mb-2 text-gray-800">Manajemen Note</h1>
<p class="mb-4">
    Di halaman ini anda dapat melakukan pengelolaan data Note
</p>

@livewire('admin.note.note-index')

@endsection