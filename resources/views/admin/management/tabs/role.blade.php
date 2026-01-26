<x-form>
  <x-form-header header="Role" paragraph="Tabel Role" />

  {{-- CREATE --}}
  <form method="POST" action="{{ route('admin.management.roles.store') }}" class="flex gap-2 mb-6">
    @csrf
    <input name="role" required class="input px-3 py-2 w-64" placeholder="Role name">
    <button
      class="px-4 py-2 bg-gradient-to-b from-sky-500 to-sky-600 ring ring-sky-500 border-t border-sky-300 rounded-md text-white hover:from-sky-500 hover:to-sky-600 cursor-pointer">
      Tambah
    </button>
  </form>

  {{-- BULK UPDATE --}}
  <form method="POST" action="{{ route('admin.management.roles.bulkUpdate') }}" x-data="{ dirty: false }">
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
        @foreach($roles as $role)
          <tr class="border-t border-gray-200/60">
            <td class="p-4">
              <div class="flex items-center gap-2">
                <span class="font-semibold text-gray-400">Edit :</span>

                <input name="roles[{{ $role->id }}][role]" value="{{ $role->role }}" @input="dirty = true"
                  class="input px-2 py-1 w-40">
              </div>
            </td>

            <td class="p-4">
              <span class="flex flex-col space-y-0.5">
                <span class="text-gray-600 text-sm font-medium">{{ $role->created_at->format('d F Y, H:i') }}</span>
                <span class="text-gray-400 text-xs">{{ $role->updated_at->format('d F Y, H:i') }}</span>
              </span>
            </td>

            <td>
              <div class="p-4 flex items-center gap-3">
                <form method="POST" action="{{ route('admin.management.roles.update', $role) }}">
                  @csrf
                  @method('PUT')

                  <input type="hidden" name="role" value="{{ $role->role }}">

                  <button class="bg-blue-50 text-blue-600 px-4 py-1 rounded-md">
                    Save
                  </button>
                </form>

                {{-- DELETE --}}
                <form method="POST" action="{{ route('admin.management.roles.destroy', $role) }}">
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