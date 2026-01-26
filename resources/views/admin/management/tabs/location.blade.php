<x-form>
  <x-form-header header="Location" paragraph="Tabel Location" />

  {{-- CREATE --}}
  <form method="POST" action="{{ route('admin.management.locations.store') }}" class="flex gap-2 mb-6">
    @csrf
    <input name="location" required class="input px-3 py-2 w-64" placeholder="Location name">
    <button
      class="px-4 py-2 bg-gradient-to-b from-sky-500 to-sky-600 ring ring-sky-500 border-t border-sky-300 rounded-md text-white hover:from-sky-500 hover:to-sky-600 cursor-pointer">
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
          <th class="px-4 py-2 text-gray-600 text-left">Name</th>
          <th class="px-4 py-2 text-gray-600 text-left">Created & Updated</th>
          <th class="px-4 py-2 text-gray-600 text-left">Action</th>
        </tr>
      </thead>

      <tbody>
        @foreach($locations as $location)
          <tr class="border-t border-gray-200/60">
            <td class="p-4">
              <div class="flex items-center gap-2">
                <span class="font-semibold text-gray-400">Edit :</span>

                <input name="locations[{{ $location->id }}][location]" value="{{ $location->location }}"
                  @input="dirty = true" class="input px-2 py-1 w-40">
              </div>
            </td>

            <td class="p-4">
              <span class="flex flex-col space-y-0.5">
                <span class="text-gray-600 text-sm font-medium">{{ $location->created_at->format('d F Y, H:i') }}</span>
                <span class="text-gray-400 text-xs">{{ $location->updated_at->format('d F Y, H:i') }}</span>
              </span>
            </td>

            <td>
              <div class="p-4 flex items-center gap-3">
                <form method="POST" action="{{ route('admin.management.locations.update', $location) }}">
                  @csrf
                  @method('PUT')

                  <input type="hidden" name="location" value="{{ $location->location }}">

                  <button class="bg-blue-50 text-blue-600 px-4 py-1 rounded-md">
                    Save
                  </button>
                </form>

                {{-- DELETE --}}
                <form method="POST" action="{{ route('admin.management.locations.destroy', $location) }}">
                  @csrf
                  @method('DELETE')
                  <button class="bg-red-50 text-red-600 px-4 py-1 rounded-md">
                    Delete
                  </button>
                </form>
              </div>

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