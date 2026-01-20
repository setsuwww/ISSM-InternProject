@extends('layouts.admin')

@section('title', 'Detail Employee')

@section('content')
  <div class="m-4 bg-white p-6 rounded-2xl shadow border max-w-2xl">
    <h1 class="text-2xl font-semibold text-gray-700 mb-6">Detail Employee</h1>

    <div class="space-y-4 text-sm">
      <div>
        <p class="text-gray-500">NIK</p>
        <p class="font-medium">{{ $employee->nik }}</p>
      </div>
      <div>
        <p class="text-gray-500">Nama</p>
        <p class="font-medium">{{ $employee->nama }}</p>
      </div>
      <div>
        <p class="text-gray-500">Email</p>
        <p class="font-medium">{{ $employee->email }}</p>
      </div>
      <div>
        <p class="text-gray-500">Status</p>
        <p class="font-medium">{{ $employee->is_active ? 'Active' : 'Inactive' }}</p>
      </div>
    </div>

    <div class="mt-6">
      <a href="{{ route('admin.employees.index') }}" class="text-sky-600">
        ← Kembali
      </a>
    </div>
  </div>
@endsection