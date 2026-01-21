<aside x-data="{
        openMenu: null,
        toggle(menu) {
            this.openMenu = this.openMenu === menu ? null : menu
        }
    }" class="w-64 min-h-screen border-r bg-white">
  <!-- Header -->
  <div class="px-6 py-4 border-b">
    <h1 class="text-lg font-semibold text-gray-800">Admin Panel</h1>
  </div>

  <!-- Navigation -->
  <nav class="p-4 space-y-2 text-sm">

    <!-- Dashboard -->
    <a href="{{ route('admin.dashboard') }}"
      class="block px-4 py-2 rounded hover:bg-gray-100 text-gray-700 font-medium">
      Dashboard
    </a>

    <!-- Users -->
    <div>
      <button @click="toggle('users')"
        class="w-full flex items-center justify-between px-4 py-2 rounded hover:bg-gray-100 text-gray-700 font-medium">
        <span>Users</span>
        <i data-lucide="chevron-down" :class="openMenu === 'users' ? 'rotate-180' : ''"
          class="w-4 h-4 transition-transform">
        </i>
      </button>

      <div x-show="openMenu === 'users'" class="ml-4 mt-1 space-y-1">
        <a href="{{ route('admin.users.index') }}" class="block px-4 py-2 rounded hover:bg-gray-100">
          All Users
        </a>
        <a href="{{ route('admin.users.create') }}" class="block px-4 py-2 rounded hover:bg-gray-100">
          Add User
        </a>
      </div>
    </div>

    <!-- Employees -->
    <div>
      <button @click="toggle('employees')"
        class="w-full flex items-center justify-between px-4 py-2 rounded hover:bg-gray-100 text-gray-700 font-medium">
        <span>Employees</span>
        <i data-lucide="chevron-down" :class="openMenu === 'employees' ? 'rotate-180' : ''"
          class="w-4 h-4 transition-transform">
        </i>
      </button>

      <div x-show="openMenu === 'employees'" class="ml-4 mt-1 space-y-1">
        <a href="{{ route('admin.employees.index') }}" class="block px-4 py-2 rounded hover:bg-gray-100">
          All Employees
        </a>
        <a href="{{ route('admin.employees.create') }}" class="block px-4 py-2 rounded hover:bg-gray-100">
          Add Employee
        </a>
        <a href="{{ route('admin.fungsis.index') }}" class="block px-4 py-2 rounded hover:bg-gray-100">
          Fungsis
        </a>
        <a href="{{ route('admin.fungsis.index') }}" class="block px-4 py-2 rounded hover:bg-gray-100">
          Jabatans
        </a>
        <a href="{{ route('admin.fungsis.index') }}" class="block px-4 py-2 rounded hover:bg-gray-100">
          Roles
        </a>
      </div>
    </div>

    <!-- Schedules -->
    <div>
      <button @click="toggle('schedules')"
        class="w-full flex items-center justify-between px-4 py-2 rounded hover:bg-gray-100 text-gray-700 font-medium">
        <span>Schedules</span>
        <i data-lucide="chevron-down" :class="openMenu === 'schedules' ? 'rotate-180' : ''"
          class="w-4 h-4 transition-transform">
        </i>
      </button>

      <div x-show="openMenu === 'schedules'" class="ml-4 mt-1 space-y-1">
        <a href="{{ route('admin.schedules.index') }}" class="block px-4 py-2 rounded hover:bg-gray-100">
          Manage Schedules
        </a>
        <a href="{{ route('admin.schedules.create') }}" class="block px-4 py-2 rounded hover:bg-gray-100">
          Add Schedule
        </a>
      </div>
    </div>

    <!-- Shifts -->
    <div>
      <button @click="toggle('shifts')"
        class="w-full flex items-center justify-between px-4 py-2 rounded hover:bg-gray-100 text-gray-700 font-medium">
        <span>Shifts</span>
        <i data-lucide="chevron-down" :class="openMenu === 'shifts' ? 'rotate-180' : ''"
          class="w-4 h-4 transition-transform">
        </i>
      </button>

      <div x-show="openMenu === 'shifts'" class="ml-4 mt-1 space-y-1">
        <a href="{{ route('admin.shifts.index') }}" class="block px-4 py-2 rounded hover:bg-gray-100">
          Manage Shifts
        </a>
        <a href="{{ route('admin.shifts.create') }}" class="block px-4 py-2 rounded hover:bg-gray-100">
          Create Shift
        </a>
      </div>
    </div>

    <!-- Attendances -->
    <div>
      <button @click="toggle('attendances')"
        class="w-full flex items-center justify-between px-4 py-2 rounded hover:bg-gray-100 text-gray-700 font-medium">
        <span>Attendances</span>
        <i data-lucide="chevron-down" :class="openMenu === 'attendances' ? 'rotate-180' : ''"
          class="w-4 h-4 transition-transform">
        </i>
      </button>

      <div x-show="openMenu === 'attendances'" class="ml-4 mt-1 space-y-1">
        <a href="{{ route('admin.attendances.index') }}" class="block px-4 py-2 rounded hover:bg-gray-100">
          Manage Attendances
        </a>
        <a href="{{ route('admin.attendace-locations.create') }}" class="block px-4 py-2 rounded hover:bg-gray-100">
          Locations
        </a>
      </div>
    </div>

  </nav>
</aside>