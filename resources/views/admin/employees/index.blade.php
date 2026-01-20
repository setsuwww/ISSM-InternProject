@extends('layouts.admin')

@section('title', 'Employees')

@section('content')
  <x-form>
    <div class="flex justify-between items-center mb-8">
      <x-form-header header="Employees" paragraph="Tabel daftar employee" />
      <a href="{{ route('admin.employees.create') }}" class="bg-sky-600 text-white px-4 py-2 rounded-lg hover:bg-sky-700">
        + Add Employee
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
          <th class="p-3">NIK</th>
          <th class="p-3">Employee</th>
          <th class="p-3 w-40">Action</th>
        </tr>
      </thead>
      <tbody>
        @foreach ($employees as $employee)
          <tr class="border-t text-sm hover:bg-gray-50 transition">

            <!-- ID -->
            <td class="p-4 font-medium text-gray-600">
              {{ $employee->id }}
            </td>

            <!-- NIK -->
            <td class="p-4 font-medium text-gray-600">
              {{ $employee->nik }}
            </td>

            <!-- Profile -->
            <td class="p-4">
              <div class="flex items-center gap-x-4">
                <!-- Avatar -->
                <div
                  class="flex items-center justify-center w-10 h-10 rounded-full bg-sky-100 text-sky-700 font-semibold uppercase">
                  {{ Str::of($employee->nama)->substr(0, 1) }}
                </div>

                <!-- Identity -->
                <div class="flex flex-col">
                  <span class="font-semibold text-gray-700">
                    {{ $employee->nama }}
                  </span>
                  <span class="text-sm text-gray-400">
                    {{ $employee->email }}
                  </span>
                </div>
              </div>
            </td>

            <!-- Action -->
            <td class="p-4">
              <div class="flex items-center gap-2">
                <a href="{{ route('admin.employees.show', $employee) }}"
                  class="px-3 py-1.5 text-sm rounded-md border border-sky-200 text-sky-600 hover:bg-sky-50">
                  Detail
                </a>

                <a href="{{ route('admin.employees.edit', $employee) }}"
                  class="px-3 py-1.5 text-sm rounded-md border border-amber-200 text-amber-600 hover:bg-amber-50">
                  Edit
                </a>

                <form action="{{ route('admin.employees.destroy', $employee) }}" method="POST"
                  onsubmit="return confirm('Hapus employee ini?')">
                  @csrf
                  @method('DELETE')
                  <button type="submit"
                    class="px-3 py-1.5 text-sm rounded-md border border-red-200 text-red-600 hover:bg-red-50">
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
      {{ $employees->links() }}
    </div>
  </x-form>
@endsection