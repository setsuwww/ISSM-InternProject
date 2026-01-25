@extends('layouts.app')

@section('content')
  <div class="container">
    <h4>{{ isset($employeePosition) ? 'Edit' : 'Tambah' }} Employee Position</h4>

    <form method="POST" action="{{ isset($employeePosition)
    ? route('admin.employee-history.update', $employeePosition)
    : route('admin.employee-history.store') }}">

      @csrf
      @isset($employeePosition) @method('PUT') @endisset

      @foreach ([
          'employee_nik' => 'NIK',
          'roles_id' => 'Role',
          'locations_id' => 'Lokasi',
          'jabatans_id' => 'Jabatan',
          'fungsis_id' => 'Fungsi',
          'tanggal_mulai_efektif' => 'Tanggal Mulai',
          'tanggal_akhir_efektif' => 'Tanggal Akhir',
        ] as $field => $label)
          <div class="mb-3">
              <label class="form-label">{{ $label }}</label>
            <input type="text" name="{{ $field }}" class="form-control"
                value="{{ old($field, $employeePosition->$field ?? '') }}">
          </div>
      @endforeach

      <div class="mb-3">
          <label class="form-label">Status Aktif</label>
            <select name="current_flag" class="form-select">
                  <option value="1" @selected(old('current_flag', $employeePosition->current_flag ?? 1) == 1)>Ya</option>
                  <option value="0" @selected(old('current_flag', $employeePosition->current_flag ?? 1) == 0)>Tidak</option>
              </select>
          </div>

          <button class="btn btn-primary">Simpan</button>
          <a href="{{ route('admin.employee-history.index') }}" class="btn btn-secondary">Kembali</a>
      </form>
  </div>
@endsection
