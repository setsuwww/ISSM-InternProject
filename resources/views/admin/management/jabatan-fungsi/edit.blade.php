@extends('layouts.admin')

@section('title', 'Edit mapping')

@section('content')
  <x-form>
    <x-form-header header="Edit Mapping" paragraph="Jabatan: {{ $jabatan->jabatan }}" />

    <form method="POST" action="{{ route('admin.management.jabatan-fungsi.update', $jabatan) }}">
      @csrf
      @method('PUT')

      <div class="border rounded-xl overflow-hidden mb-8">

        <table class="w-full text-sm">
          <thead class="bg-gray-50">
            <tr>
              <th class="px-4 py-3 text-left">Pilih</th>
              <th class="px-4 py-3 text-left">Nama Fungsi</th>
              <th class="px-4 py-3 text-left">Status</th>
            </tr>
          </thead>

          <tbody>
            @foreach ($allFungsis as $fungsi)
              @php
                $assigned = in_array($fungsi->id, $assignedFungsiIds);
                $locked = in_array($fungsi->id, $lockedFungsiIds);
              @endphp

              <tr class="border-t {{ $locked ? 'bg-gray-50 text-gray-400' : '' }}">
                <td class="px-4 py-3">
                  <input type="checkbox" name="fungsi_ids[]" value="{{ $fungsi->id }}" @checked($assigned)
                    @disabled($locked) class="rounded border-gray-300 text-black focus:ring-black">
                </td>

                <td class="px-4 py-3">
                  {{ $fungsi->fungsi }}
                </td>

                <td class="px-4 py-3 text-xs">
                  @if($locked)
                    Digunakan jabatan lain
                  @elseif($assigned)
                    Aktif
                  @else
                    Tersedia
                  @endif
                </td>
              </tr>
            @endforeach
          </tbody>
        </table>

      </div>

      <div class="flex justify-end gap-3">
        <a href="{{ route('admin.management.jabatan-fungsi.index') }}"
          class="px-4 py-2 border rounded-lg text-gray-700 hover:bg-gray-50">
          Batal
        </a>

        <button class="px-6 py-2 bg-black text-white rounded-lg hover:bg-gray-800">
          Simpan Mapping
        </button>
      </div>

    </form>
  </x-form>
@endsection