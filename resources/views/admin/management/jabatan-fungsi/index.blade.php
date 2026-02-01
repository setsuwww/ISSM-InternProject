@extends('layouts.admin')

@section('title', 'Jabatan Fungsi')

@section('content')
  <x-form>
    <x-form-header header="Jabatan ↔ Fungsi" paragraph="Mapping fungsi ke jabatan" />

    <table class="w-full text-sm border rounded-xl overflow-hidden">
      <thead class="bg-gray-50">
        <tr>
          <th class="px-4 py-2 text-left">Jabatan</th>
          <th class="px-4 py-2 text-left">Fungsi</th>
          <th class="px-4 py-2 text-right">Action</th>
        </tr>
      </thead>

      <tbody>
        @foreach($jabatans as $jabatan)
          <tr class="border-t">
            <td class="px-4 py-3 font-medium">
              {{ $jabatan->jabatan }}
            </td>

            <td class="px-4 py-3 text-gray-600">
              @forelse($jabatan->fungsis as $fungsi)
                <span class="inline-block bg-gray-100 px-2 py-1 rounded text-xs mr-1 mb-1">
                  {{ $fungsi->fungsi }}
                </span>
              @empty
                <span class="text-gray-400 text-xs">Belum ada fungsi</span>
              @endforelse
            </td>

            <td class="px-4 py-3 text-right">
              <a href="{{ route('admin.management.jabatan-fungsi.edit', $jabatan) }}"
                class="px-4 py-1 bg-black text-white rounded-md text-xs">
                Edit
              </a>
            </td>
          </tr>
        @endforeach
      </tbody>
    </table>
  </x-form>
@endsection