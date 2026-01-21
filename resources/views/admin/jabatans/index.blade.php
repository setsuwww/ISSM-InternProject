@extends('layouts.admin')

@section('title', 'Jabatan')

@section('content')
  <x-form>
    <div class="flex justify-between items-center mb-8">
      <x-form-header header="Jabatan" paragraph="Daftar jabatan" />
      <a href="{{ route('admin.jabatans.create') }}" class="bg-sky-600 text-white px-4 py-2 rounded-lg hover:bg-sky-700">
        + Add Jabatan
      </a>
    </div>

    @if(session('success'))
      <div class="mb-4 p-3 bg-green-100 text-green-700 rounded">
        {{ session('success') }}
      </div>
    @endif

    <table class="w-full border-collapse">
      <thead>
        <tr class="bg-gray-50 text-left text-sm text-gray-600">
          <th class="p-3">ID</th>
          <th class="p-3">Nama Jabatan</th>
          <th class="p-3">Status</th>
          <th class="p-3 w-40">Action</th>
        </tr>
      </thead>
      <tbody>
        @foreach ($jabatans as $jabatan)
          <tr class="border-t text-sm hover:bg-gray-50 transition">
            <td class="p-4 text-gray-600">{{ $jabatan->id }}</td>

            <td class="p-4 font-semibold text-gray-700">
              {{ $jabatan->jabatan }}
            </td>

            <td class="p-4">
              <span
                class="px-2 py-1 text-xs rounded
                                    {{ $jabatan->is_active ? 'bg-green-100 text-green-700' : 'bg-gray-200 text-gray-600' }}">
                {{ $jabatan->is_active ? 'Active' : 'Inactive' }}
              </span>
            </td>

            <td class="p-4">
              <div class="flex items-center gap-2">
                <a href="{{ route('admin.jabatans.show', $jabatan) }}"
                  class="px-3 py-1.5 text-sm rounded-md border border-sky-200 text-sky-600 hover:bg-sky-50">
                  Detail
                </a>

                <a href="{{ route('admin.jabatans.edit', $jabatan) }}"
                  class="px-3 py-1.5 text-sm rounded-md border border-amber-200 text-amber-600 hover:bg-amber-50">
                  Edit
                </a>

                <form action="{{ route('admin.jabatans.destroy', $jabatan) }}" method="POST"
                  onsubmit="return confirm('Hapus jabatan ini?')">
                  @csrf
                  @method('DELETE')
                  <button class="px-3 py-1.5 text-sm rounded-md border border-red-200 text-red-600 hover:bg-red-50">
                    Hapus
                  </button>
                </form>
              </div>
            </td>
          </tr>
        @endforeach
      </tbody>
    </table>

    <div class="mt-6">
      {{ $jabatans->links() }}
    </div>
  </x-form>
@endsection