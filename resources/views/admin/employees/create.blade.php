@extends('layouts.admin')

@section('title', 'Tambah Employee')

@section('content')
  <x-form>
    <x-form-header header="Tambah employee" paragraph="Form tambah user" />

    <form action="{{ route('admin.employees.store') }}" method="POST" class="space-y-6">
      @csrf

      <div>
        <label class="font-semibold text-sm">NIK</label>
        <input name="nik" value="{{ old('nik') }}" class="w-full mt-2 p-3 border rounded-lg focus:border-sky-500"
          required>
        @error('nik') <p class="text-red-500 text-xs">{{ $message }}</p> @enderror
      </div>

      <div>
        <label class="font-semibold text-sm">Nama</label>
        <input name="nama" value="{{ old('nama') }}" class="w-full mt-2 p-3 border rounded-lg focus:border-sky-500"
          required>
      </div>

      <div>
        <label class="font-semibold text-sm">Email</label>
        <input type="email" name="email" value="{{ old('email') }}"
          class="w-full mt-2 p-3 border rounded-lg focus:border-sky-500" required>
      </div>

      <div class="flex gap-3 pt-4">
        <button class="bg-sky-600 text-white px-6 py-3 rounded-lg hover:bg-sky-700">
          Simpan
        </button>
        <a href="{{ route('admin.employees.index') }}" class="px-6 py-3 rounded-lg border">
          Batal
        </a>
      </div>
    </form>
  </x-form>
@endsection