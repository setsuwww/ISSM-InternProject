@extends('layouts.admin')

@section('content')
<div x-data="{ tab: 'role', editJabatan: null }" class="bg-white p-6 rounded-xl">

  {{-- TAB --}}
  <div class="flex gap-6 border-b mb-6 text-sm font-medium">
    <button @click="tab='role'"     :class="tab==='role'?'border-b-2 border-black pb-2':''">Role</button>
    <button @click="tab='jabatan'"  :class="tab==='jabatan'?'border-b-2 border-black pb-2':''">Jabatan</button>
    <button @click="tab='fungsi'"   :class="tab==='fungsi'?'border-b-2 border-black pb-2':''">Fungsi</button>
    <button @click="tab==='location'" :class="tab==='location'?'border-b-2 border-black pb-2':''">Location</button>
    <button @click="tab='assign'"   :class="tab==='assign'?'border-b-2 border-black pb-2':''">Jabatan–Fungsi</button>
  </div>

  {{-- ================= ROLE ================= --}}
  <div x-show="tab==='role'">
    <form method="POST" action="/admin/management/roles" class="flex gap-3 mb-4">
      @csrf
      <input name="role" class="border rounded px-3 py-2 w-64" placeholder="Role">
      <button class="bg-black text-white px-4 rounded">Tambah</button>
    </form>

    <table class="w-full text-sm border rounded">
      <thead class="bg-gray-50">
        <tr>
          <th class="px-4 py-2 text-left">Role</th>
          <th class="px-4 py-2 w-32 text-right">Aksi</th>
        </tr>
      </thead>
      <tbody>
        @foreach($roles as $r)
        <tr class="border-t">
          <td class="px-4 py-2">{{ $r->role }}</td>
          <td class="px-4 py-2 text-right">
            <form method="POST" action="/admin/management/roles/{{ $r->id }}">
              @csrf @method('DELETE')
              <button class="text-red-600">Hapus</button>
            </form>
          </td>
        </tr>
        @endforeach
      </tbody>
    </table>
  </div>

  {{-- ================= JABATAN ================= --}}
  <div x-show="tab==='jabatan'">
    <form method="POST" action="/admin/management/jabatans" class="flex gap-3 mb-4">
      @csrf
      <input name="jabatan" class="border rounded px-3 py-2 w-64" placeholder="Jabatan">
      <button class="bg-black text-white px-4 rounded">Tambah</button>
    </form>

    <table class="w-full text-sm border rounded">
      <thead class="bg-gray-50">
        <tr>
          <th class="px-4 py-2 text-left">Jabatan</th>
          <th class="px-4 py-2 text-right w-32">Aksi</th>
        </tr>
      </thead>
      <tbody>
        @foreach($jabatans as $j)
        <tr class="border-t">
          <td class="px-4 py-2">{{ $j->jabatan }}</td>
          <td class="px-4 py-2 text-right">
            <form method="POST" action="/admin/management/jabatans/{{ $j->id }}">
              @csrf @method('DELETE')
              <button class="text-red-600">Hapus</button>
            </form>
          </td>
        </tr>
        @endforeach
      </tbody>
    </table>
  </div>

  {{-- ================= FUNGSI ================= --}}
  <div x-show="tab==='fungsi'">
    <form method="POST" action="/admin/management/fungsis" class="flex gap-3 mb-4">
      @csrf
      <input name="fungsi" class="border rounded px-3 py-2 w-64" placeholder="Fungsi">
      <button class="bg-black text-white px-4 rounded">Tambah</button>
    </form>

    <table class="w-full text-sm border rounded">
      <thead class="bg-gray-50">
        <tr>
          <th class="px-4 py-2 text-left">Fungsi</th>
          <th class="px-4 py-2 w-32 text-right">Status</th>
        </tr>
      </thead>
      <tbody>
        @foreach($fungsis as $f)
        <tr class="border-t">
          <td class="px-4 py-2">{{ $f->fungsi }}</td>
          <td class="px-4 py-2 text-right">
            @if(in_array($f->id, $usedFungsiIds))
              <span class="text-xs bg-gray-200 px-2 py-1 rounded">Dipakai</span>
            @else
              <span class="text-xs bg-green-100 px-2 py-1 rounded">Bebas</span>
            @endif
          </td>
        </tr>
        @endforeach
      </tbody>
    </table>
  </div>

  {{-- ================= LOCATION ================= --}}
  <div x-show="tab==='location'">
    <form method="POST" action="/admin/management/locations" class="flex gap-3 mb-4">
      @csrf
      <input name="location" class="border rounded px-3 py-2 w-64" placeholder="Location">
      <button class="bg-black text-white px-4 rounded">Tambah</button>
    </form>

    <table class="w-full text-sm border rounded">
      <thead class="bg-gray-50">
        <tr>
          <th class="px-4 py-2 text-left">Location</th>
          <th class="px-4 py-2 w-32 text-right">Aksi</th>
        </tr>
      </thead>
      <tbody>
        @foreach($locations as $l)
        <tr class="border-t">
          <td class="px-4 py-2">{{ $l->location }}</td>
          <td class="px-4 py-2 text-right">
            <form method="POST" action="/admin/management/locations/{{ $l->id }}">
              @csrf @method('DELETE')
              <button class="text-red-600">Hapus</button>
            </form>
          </td>
        </tr>
        @endforeach
      </tbody>
    </table>
  </div>

  {{-- ================= JABATAN – FUNGSI ================= --}}
  <div x-show="tab==='assign'">
    @foreach($jabatans as $j)
      <div class="border rounded p-4 mb-4">
        <div class="flex justify-between items-center mb-2">
          <b>{{ $j->jabatan }}</b>
          <button @click="editJabatan={{ $j->id }}" class="text-sm text-blue-600">
            Edit
          </button>
        </div>

        {{-- BADGE --}}
        <div class="flex flex-wrap gap-2 mb-2">
          @foreach($j->fungsis as $f)
            <span class="flex items-center gap-1 bg-gray-100 px-3 py-1 rounded-full text-xs">
              {{ $f->fungsi }}
              <form method="POST" action="/admin/management/jabatans/{{ $j->id }}/fungsis">
                @csrf
                <input type="hidden" name="fungsi_ids[]" value="">
                <button class="text-red-500">&times;</button>
              </form>
            </span>
          @endforeach
        </div>

        {{-- EDIT MODE --}}
        <div x-show="editJabatan === {{ $j->id }}">
          <form method="POST" action="/admin/management/jabatans/{{ $j->id }}/fungsis" class="grid grid-cols-2 gap-2">
            @csrf
            @foreach($fungsis as $f)
              @php
                $used = in_array($f->id, $usedFungsiIds);
                $checked = $j->fungsis->contains($f->id);
              @endphp

              <label class="text-sm {{ $used && !$checked ? 'opacity-50' : '' }}">
                <input type="checkbox"
                  name="fungsi_ids[]"
                  value="{{ $f->id }}"
                  {{ $checked ? 'checked' : '' }}
                  {{ $used && !$checked ? 'disabled' : '' }}>
                {{ $f->fungsi }}
              </label>
            @endforeach

            <div class="col-span-2 flex gap-3 mt-2">
              <button class="bg-black text-white px-4 py-2 rounded">Simpan</button>
              <button type="button" @click="editJabatan=null">Batal</button>
            </div>
          </form>
        </div>
      </div>
    @endforeach
  </div>

</div>
@endsection
