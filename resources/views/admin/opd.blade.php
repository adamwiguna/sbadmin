@extends('layouts.app')

@section('content')

<h1 class="h3 mb-2 text-gray-800">Organisasi Perangkat Daerah</h1>
<p class="mb-4">
    Di halaman ini anda dapat membuat OPD 
</p>

@livewire('admin.opd.list-opd')

@endsection