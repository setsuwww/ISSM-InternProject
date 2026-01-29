<header class="h-[61px] bg-white border-b flex items-center justify-between px-6">
  <div class="flex items-center gap-4">
    <div class="text-sm text-gray-500">
      Admin Panel
    </div>
  </div>

  {{-- RIGHT --}}
  <div x-data="{ open: false }" class="relative">
    <button @click="open = !open" @click.outside="open = false"
      class="flex items-center gap-3 px-3 py-2 rounded-lg hover:bg-gray-100 transition">
      <div class="w-8 h-8 rounded-full bg-sky-600 text-white flex items-center justify-center text-sm font-semibold">
        {{ strtoupper(substr(auth()->user()->name, 0, 1)) }}
      </div>

      <div class="text-left hidden sm:block">
        <div class="text-sm font-medium">{{ auth()->user()->name }}</div>
        <div class="text-xs text-gray-400">{{ auth()->user()->akses_role }}</div>
      </div>

      <i data-lucide="chevron-down" class="w-4 h-4"></i>
    </button>

    {{-- DROPDOWN --}}
    <div x-show="open" x-transition
      class="absolute right-0 mt-2 w-56 bg-white border rounded-xl shadow-lg overflow-hidden z-50">
      <a href="{{ route('admin.activity-logs.index') }}"
        class="flex items-center gap-3 px-4 py-3 text-sm hover:bg-gray-50">
        <i data-lucide="activity" class="w-4 h-4"></i>
        Activity Logs
      </a>

      <a href="{{ route('admin.security.index') }}" class="flex items-center gap-3 px-4 py-3 text-sm hover:bg-gray-50">
        <i data-lucide="shield" class="w-4 h-4"></i>
        Security
      </a>

      <div class="border-t my-1"></div>

      <form method="POST" action="{{ route('logout') }}">
        @csrf
        <button type="submit" class="w-full flex items-center gap-3 px-4 py-3 text-sm text-red-600 hover:bg-red-50">
          <i data-lucide="log-out" class="w-4 h-4"></i>
          Logout
        </button>
      </form>
    </div>
  </div>
</header>