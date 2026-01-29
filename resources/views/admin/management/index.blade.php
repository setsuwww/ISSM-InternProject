@php
  $tab = request()->get('tab', 'role');

  $tabs = [
    'role'     => 'Roles',
    'jabatan'  => 'Jabatans',
    'fungsi'   => 'Fungsis',
    'location' => 'Locations',
  ];
@endphp

@extends('layouts.admin')

@section('title', 'Manajemen')

@section('content')
<div class="bg-white rounded-xl p-6">

  {{-- TAB HEADER --}}
  <div class="flex gap-6 border-b mb-6 text-sm font-medium">
    @foreach ($tabs as $key => $label)
      <a
        href="{{ route('admin.management.index', ['tab' => $key]) }}"
        class="pb-2 transition-all
          {{ $tab === $key
              ? 'border-b-2 border-black text-black'
              : 'text-gray-400 hover:text-black hover:border-b-2 hover:border-gray-300'
          }}">
        {{ $label }}
      </a>
    @endforeach
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

    @default
      @include('admin.management.tabs.role')
  @endswitch

</div>
@endsection
