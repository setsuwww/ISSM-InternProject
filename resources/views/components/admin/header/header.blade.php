<header class="sticky top-0 z-40 border-b bg-white">
  <div class="mx-auto flex h-16 max-w-7xl items-center justify-between px-6">

    {{-- LEFT --}}
    <div>
      <h1 class="text-lg font-semibold text-gray-900">
        {{ $title ?? 'Dashboard' }}
      </h1>
      <p class="text-sm text-gray-500">
        {{ $subtitle ?? 'Welcome back' }}
      </p>
    </div>

    {{-- RIGHT --}}
    <div class="relative">
      <button x-data="{ open: false }" @click="open = !open" @click.outside="open = false"
        class="flex items-center gap-3 rounded-lg border px-3 py-2 transition hover:bg-gray-50">
        <img src="{{ auth()->user()->avatar ?? 'https://ui-avatars.com/api/?name=' . urlencode(auth()->user()->name) }}"
          alt="Avatar" class="h-8 w-8 rounded-full object-cover" />

        <div class="hidden text-left sm:block">
          <p class="text-sm font-medium text-gray-900">
            {{ auth()->user()->name }}
          </p>
          <p class="text-xs text-gray-500">
            {{ auth()->user()->role->name ?? 'User' }}
          </p>
        </div>

        <svg class="h-4 w-4 text-gray-400" fill="none" viewBox="0 0 24 24" stroke="currentColor">
          <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 9l-7 7-7-7" />
        </svg>

        {{-- DROPDOWN --}}
        <div x-show="open" x-transition class="absolute right-0 top-12 w-48 rounded-xl border bg-white shadow-sm">
          <a href="/edit" class="block px-4 py-2 text-sm text-gray-700 hover:bg-gray-50">
            Profile
          </a>

          <form method="POST" action="/logout">
            @csrf
            <button type="submit" class="w-full text-left px-4 py-2 text-sm text-red-600 hover:bg-gray-50">
              Logout
            </button>
          </form>
        </div>
      </button>
    </div>

  </div>
</header>