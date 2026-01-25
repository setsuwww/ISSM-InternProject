@extends('layouts.app')

@section('content')
  <div class="container">
    <h4>Detail Employee Position</h4>

    <table class="table">
      @foreach($employeePosition->getAttributes() as $key => $value)
        <tr>
          <th>{{ $key }}</th>
          <td>{{ $value }}</td>
        </tr>
      @endforeach
    </table>

    <a href="{{ route('admin.employee-history.index') }}" class="btn btn-secondary">Kembali</a>
  </div>
@endsection