@php
  $tab = request('tab', 'roles');
@endphp

@extends('layouts.admin')

@section('title', 'Manajemen')

@section('content')
<div class="bg-white rounded-xl p-6">

  {{-- TAB HEADER --}}
  <div class="flex gap-6 border-b mb-6 text-sm font-medium">
    <a href="{{ route('admin.management.index', ['tab' => 'role']) }}"
       class="pb-2 {{ $tab === 'roles' ? 'border-b-2 border-black' : 'text-gray-400' }}">
      Roles
    </a>

    <a href="{{ route('admin.management.index', ['tab' => 'jabatan']) }}"
       class="pb-2 {{ $tab === 'jabatans' ? 'border-b-2 border-black' : 'text-gray-400' }}">
      Jabatans
    </a>

    <a href="{{ route('admin.management.index', ['tab' => 'fungsi']) }}"
       class="pb-2 {{ $tab === 'fungsis' ? 'border-b-2 border-black' : 'text-gray-400' }}">
      Fungsis
    </a>

    <a href="{{ route('admin.management.index', ['tab' => 'location']) }}"
       class="pb-2 {{ $tab === 'locations' ? 'border-b-2 border-black' : 'text-gray-400' }}">
      Locations
    </a>
  </div>

  {{-- TAB CONTENT --}}
  @switch($tab)
    @case('role')
      @include('admin.management.tabs.role')
      @break

    @case('jabatan')
      @include('admin.management.tabs.jabatan')
      @break

    @case('fungsi')
      @include('admin.management.tabs.fungsi')
      @break

    @case('location')
      @include('admin.management.tabs.location')
      @break
  @endswitch

</div>
@endsection
