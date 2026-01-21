@extends('layouts.admin')

@section('title', 'Detail Fungsi')

@section('content')
  <x-form>
    <x-form-header header="Detail Fungsi" paragraph="Informasi fungsi" />

    <div class="space-y-4 text-sm">
      <div>
        <p class="text-gray-500">Nama Fungsi</p>
        <p class="font-semibold text-gray-700">{{ $fungsis->jabatan }}</p>
      </div>

      <div>
        <p class="text-gray-500">Status</p>
        <p class="font-semibold text-gray-700">
          {{ $fungsis->is_active ? 'Active' : 'Inactive' }}
        </p>
      </div>
    </div>

    <div class="mt-6">
      <a href="{{ route('admin.fungsis.index') }}" class="text-sky-600">
        ← Kembali
      </a>
    </div>
  </x-form>
@endsection