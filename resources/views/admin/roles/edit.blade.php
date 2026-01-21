@extends('layouts.admin')

@section('title', 'Edit Role')

@section('content')
  <x-form>
    <x-form-header header="Edit Role" paragraph="Perbarui data fungsi" />

    <form action="{{ route('admin.roles.update', $roles) }}" method="POST" class="space-y-6">
      @csrf
      @method('PUT')

      <div>
        <label class="font-semibold text-sm">Nama Role</label>
        <input name="role" value="{{ old('role', $roles->role) }}" class="w-full mt-2 p-3 border rounded-lg" required>
      </div>

      <div>
        <label class="font-semibold text-sm">Status</label>
        <select name="is_active" class="w-full mt-2 p-3 border rounded-lg">
          <option value="1" @selected($roles->is_active)>Active</option>
          <option value="0" @selected(!$roles->is_active)>Inactive</option>
        </select>
      </div>

      <div class="flex gap-3 pt-4">
        <button class="bg-sky-600 text-white px-6 py-3 rounded-lg">
          Update
        </button>
        <a href="{{ route('admin.roles.index') }}" class="px-6 py-3 rounded-lg border">
          Kembali
        </a>
      </div>
    </form>
  </x-form>
@endsection