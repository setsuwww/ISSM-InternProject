<x-form>
  <x-form-header header="Location" paragraph="Tabel Location" />

  {{-- CREATE --}}
  <form method="POST" action="{{ route('admin.management.locations.store') }}" class="flex gap-2 mb-6">
    @csrf
    <input name="location" required class="input px-3 py-2 w-64" placeholder="Location name">
    <button class="px-4 py-2 bg-sky-600 rounded-md text-white">
      Tambah
    </button>
  </form>

  {{-- BULK UPDATE --}}
  <form method="POST" action="{{ route('admin.management.locations.bulkUpdate') }}" x-data="{ dirty: false }">
    @csrf
    @method('PUT')

    <table class="w-full text-sm rounded-lg">
      <thead class="bg-gray-50">
        <tr>
          <th class="px-4 py-2 text-left">Name</th>
          <th class="px-4 py-2 text-left">Created & Updated</th>
          <th class="px-4 py-2 text-left">Action</th>
        </tr>
      </thead>

      <tbody>
        @foreach($locations as $location)
          <tr class="border-t">
            {{-- EDIT --}}
            <td class="p-4">
              <input name="locations[{{ $location->id }}][location]" value="{{ $location->location }}"
                @input="dirty = true" class="input px-2 py-1 w-48">
            </td>

            {{-- DATE --}}
            <td class="p-4 text-sm">
              <div>{{ $location->created_at->format('d F Y, H:i') }}</div>
              <div class="text-gray-400 text-xs">
                {{ $location->updated_at->format('d F Y, H:i') }}
              </div>
            </td>

            {{-- ACTION --}}
            <td class="p-4">
              {{-- DELETE (FORM TERPISAH, TIDAK NESTED) --}}
              <form method="POST" action="{{ route('admin.management.locations.destroy', $location) }}"
                onsubmit="return confirm('Delete location ini?')">
                @csrf
                @method('DELETE')
                <button class="bg-red-50 text-red-600 px-4 py-1 rounded-md">
                  Delete
                </button>
              </form>
            </td>
          </tr>
        @endforeach
      </tbody>
    </table>

    {{-- CONFIRM --}}
    <div class="flex justify-end mt-4">
      <button type="submit" :disabled="!dirty" class="bg-black text-white px-6 py-2 rounded-lg disabled:opacity-40">
        Confirm Changes
      </button>
    </div>
  </form>
</x-form>