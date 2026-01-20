@extends('layouts.admin')

@section('title', 'Edit Employee')

@section('content')
  <x-form>
    <x-form-header header="Edit Employee" paragraph="Form edit employee" />

    <form action="{{ route('admin.employees.update', $employee) }}" method="POST" class="space-y-6">
      @csrf @method('PUT')

      <div>
        <label class="font-semibold text-sm">NIK</label>
        <input name="nik" value="{{ old('nik', $employee->nik) }}" class="w-full mt-2 p-3 border rounded-lg" required>
      </div>

      <div>
        <label class="font-semibold text-sm">Nama</label>
        <input name="nama" value="{{ old('nama', $employee->nama) }}" class="w-full mt-2 p-3 border rounded-lg" required>
      </div>

      <div>
        <label class="font-semibold text-sm">Email</label>
        <input type="email" name="email" value="{{ old('email', $employee->email) }}"
          class="w-full mt-2 p-3 border rounded-lg" required>
      </div>

      <div>
        <label class="font-semibold text-sm">Status</label>
        <select name="is_active" class="w-full mt-2 p-3 border rounded-lg">
          <option value="1" @selected($employee->is_active)>Active</option>
          <option value="0" @selected(!$employee->is_active)>Inactive</option>
        </select>
      </div>

      <div class="flex gap-3 pt-4">
        <button class="bg-sky-600 text-white px-6 py-3 rounded-lg">
          Update
        </button>
        <a href="{{ route('admin.employees.index') }}" class="px-6 py-3 border rounded-lg">
          Kembali
        </a>
      </div>
    </form>
  </x-form>
@endsection