@extends('layouts.app')

@section('content')
  <div class="container">
    <div class="d-flex justify-content-between mb-3">
      <h4>Employee Positions</h4>
      <a href="{{ route('admin.employee-history.create') }}" class="btn btn-primary">Tambah</a>
    </div>

    @if(session('success'))
      <div class="alert alert-success">{{ session('success') }}</div>
    @endif

    <table class="table table-bordered align-middle">
      <thead>
        <tr>
          <th>NIK</th>
          <th>Role</th>
          <th>Lokasi</th>
          <th>Jabatan</th>
          <th>Aktif</th>
          <th width="160">Aksi</th>
        </tr>
      </thead>
      <tbody>
        @foreach($items as $item)
          <tr>
            <td>{{ $item->employee_nik }}</td>
            <td>{{ $item->roles_id }}</td>
            <td>{{ $item->locations_id }}</td>
            <td>{{ $item->jabatans_id }}</td>
            <td>{{ $item->current_flag ? 'Ya' : 'Tidak' }}</td>
            <td>
              <a href="{{ route('admin.employee-history.show', $item) }}" class="btn btn-sm btn-secondary">View</a>
              <a href="{{ route('admin.employee-history.edit', $item) }}" class="btn btn-sm btn-warning">Edit</a>
              <form action="{{ route('admin.employee-history.destroy', $item) }}" method="POST" class="d-inline">
                @csrf @method('DELETE')
                <button onclick="return confirm('Hapus data?')" class="btn btn-sm btn-danger">Hapus</button>
              </form>
            </td>
          </tr>
        @endforeach
      </tbody>
    </table>

    {{ $items->links() }}
  </div>
@endsection