@extends('layouts.admin')

@section('title', 'Detail Jabatan')

@section('content')
  <x-form>
    <x-form-header header="Detail Jabatan" paragraph="Informasi jabatan" />

    <div class="space-y-4 text-sm">
      <div>
        <p class="text-gray-500">Nama Jabajatn</p>
        <p class="font-semibold text-gray-700">{{ $jabatans->jabatan }}</p>
      </div>

      <div>
        <p class="text-gray-500">Status</p>
        <p class="font-semibold text-gray-700">
          {{ $jabatans->is_active ? 'Active' : 'Inactive' }}
        </p>
      </div>
    </div>

    <div class="mt-6">
      <a href="{{ route('admin.jabatans.index') }}" class="text-sky-600">
        ← Kembali
      </a>
    </div>
  </x-form>
@endsection