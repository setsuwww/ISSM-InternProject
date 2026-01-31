<aside x-data="{
    openMenu: null,
    init() {
      if (this.isUsers()) this.openMenu = 'users'
      if (this.isEmployees()) this.openMenu = 'employees'
      if (this.isSchedules()) this.openMenu = 'schedules'
      if (this.isShifts()) this.openMenu = 'shifts'
      if (this.isAttendances()) this.openMenu = 'attendances'
    },
    toggle(menu) {
      this.openMenu = this.openMenu === menu ? null : menu
    },
    isUsers() {
      return {{ request()->routeIs('admin.users.*') ? 'true' : 'false' }}
    },
    isEmployees() {
      return {{ request()->routeIs('admin.employees.*') || request()->routeIs('admin.management.*') ? 'true' : 'false' }}
    },
    isSchedules() {
      return {{ request()->routeIs('admin.schedules.*') ? 'true' : 'false' }}
    },
    isShifts() {
      return {{ request()->routeIs('admin.shifts.*') ? 'true' : 'false' }}
    },
    isAttendances() {
      return {{ request()->routeIs('admin.attendances.*') || request()->routeIs('admin.attendance-locations.*') ? 'true' : 'false' }}
    }
  }" class="w-64 min-h-screen border-r bg-white">

  {{-- HEADER --}}
  <div class="px-6 py-4 border-b">
    <h1 class="text-lg font-semibold text-gray-800">Admin Panel</h1>
  </div>

  {{-- NAV --}}
  <nav class="p-4 space-y-2 text-sm">

    {{-- DASHBOARD --}}
    <a href="{{ route('admin.dashboard') }}" @class([
      'block px-4 py-2 rounded hover:bg-gray-100',
      'bg-gray-100 font-semibold text-gray-900' => request()->routeIs('admin.dashboard')
    ])>
      Dashboard
    </a>

    {{-- USERS --}}
    <div>
      <button @click="toggle('users')"
        class="w-full flex items-center justify-between px-4 py-2 rounded hover:bg-gray-100 font-medium"
        :class="openMenu === 'users' ? 'text-gray-900' : 'text-gray-700'">
        <span>Users</span>
        <i data-lucide="chevron-down" class="w-4 h-4 transition-transform"
          :class="openMenu === 'users' ? 'rotate-180' : ''">
        </i>
      </button>

      <div x-show="openMenu === 'users'" x-collapse class="ml-4 mt-1 space-y-1">
        <a href="{{ route('admin.users.index') }}" @class([
          'block px-4 py-2 rounded hover:bg-gray-100',
          'bg-gray-100 font-semibold' => request()->routeIs('admin.users.index')
        ])>
          All Users
        </a>

        <a href="{{ route('admin.users.create') }}" @class([
          'block px-4 py-2 rounded hover:bg-gray-100',
          'bg-gray-100 font-semibold' => request()->routeIs('admin.users.create')
        ])>
          Add User
        </a>
      </div>
    </div>

    {{-- EMPLOYEES --}}
    <div>
      <button @click="toggle('employees')"
        class="w-full flex items-center justify-between px-4 py-2 rounded hover:bg-gray-100 font-medium"
        :class="openMenu === 'employees' ? 'text-gray-900' : 'text-gray-700'">
        <span>Employees</span>
        <i data-lucide="chevron-down" class="w-4 h-4 transition-transform"
          :class="openMenu === 'employees' ? 'rotate-180' : ''">
        </i>
      </button>

      <div x-show="openMenu === 'employees'" x-collapse class="ml-4 mt-1 space-y-1">
        <a href="{{ route('admin.employees.index') }}" @class([
          'block px-4 py-2 rounded hover:bg-gray-100',
          'bg-gray-100 font-semibold' => request()->routeIs('admin.employees.index')
        ])>
          Employees
        </a>

        <a href="{{ route('admin.employee-history.index') }}" @class([
          'block px-4 py-2 rounded hover:bg-gray-100',
          'bg-gray-100 font-semibold' => request()->routeIs('admin.employee-history.*')
        ])>
          Employee History
        </a>

        <a href="{{ route('admin.management.index') }}" @class([
          'block px-4 py-2 rounded hover:bg-gray-100',
          'bg-gray-100 font-semibold' => request()->routeIs('admin.management.*')
        ])>
          Management
        </a>
      </div>
    </div>

    {{-- SCHEDULES --}}
    <div>
      <button @click="toggle('schedules')"
        class="w-full flex items-center justify-between px-4 py-2 rounded hover:bg-gray-100 font-medium"
        :class="openMenu === 'schedules' ? 'text-gray-900' : 'text-gray-700'">
        <span>Schedules</span>
        <i data-lucide="chevron-down" class="w-4 h-4 transition-transform"
          :class="openMenu === 'schedules' ? 'rotate-180' : ''">
        </i>
      </button>

      <div x-show="openMenu === 'schedules'" x-collapse class="ml-4 mt-1 space-y-1">
        <a href="{{ route('admin.schedules.index') }}" @class([
          'block px-4 py-2 rounded hover:bg-gray-100',
          'bg-gray-100 font-semibold' => request()->routeIs('admin.schedules.index')
        ])>
          Manage Schedules
        </a>

        <a href="{{ route('admin.schedules.create') }}" @class([
          'block px-4 py-2 rounded hover:bg-gray-100',
          'bg-gray-100 font-semibold' => request()->routeIs('admin.schedules.create')
        ])>
          Add Schedule
        </a>
      </div>
    </div>

    {{-- SHIFTS --}}
    <div>
      <button @click="toggle('shifts')"
        class="w-full flex items-center justify-between px-4 py-2 rounded hover:bg-gray-100 font-medium"
        :class="openMenu === 'shifts' ? 'text-gray-900' : 'text-gray-700'">
        <span>Shifts</span>
        <i data-lucide="chevron-down" class="w-4 h-4 transition-transform"
          :class="openMenu === 'shifts' ? 'rotate-180' : ''">
        </i>
      </button>

      <div x-show="openMenu === 'shifts'" x-collapse class="ml-4 mt-1 space-y-1">
        <a href="{{ route('admin.shifts.index') }}" @class([
          'block px-4 py-2 rounded hover:bg-gray-100',
          'bg-gray-100 font-semibold' => request()->routeIs('admin.shifts.index')
        ])>
          Manage Shifts
        </a>

        <a href="{{ route('admin.shifts.create') }}" @class([
          'block px-4 py-2 rounded hover:bg-gray-100',
          'bg-gray-100 font-semibold' => request()->routeIs('admin.shifts.create')
        ])>
          Create Shift
        </a>
      </div>
    </div>

    {{-- ATTENDANCES --}}
    <div>
      <button @click="toggle('attendances')"
        class="w-full flex items-center justify-between px-4 py-2 rounded hover:bg-gray-100 font-medium"
        :class="openMenu === 'attendances' ? 'text-gray-900' : 'text-gray-700'">
        <span>Attendances</span>
        <i data-lucide="chevron-down" class="w-4 h-4 transition-transform"
          :class="openMenu === 'attendances' ? 'rotate-180' : ''">
        </i>
      </button>

      <div x-show="openMenu === 'attendances'" x-collapse class="ml-4 mt-1 space-y-1">
        <a href="{{ route('admin.attendances.index') }}" @class([
          'block px-4 py-2 rounded hover:bg-gray-100',
          'bg-gray-100 font-semibold' => request()->routeIs('admin.attendances.index')
        ])>
          Manage Attendances
        </a>

        <a href="{{ route('admin.attendance-locations.create') }}" @class([
          'block px-4 py-2 rounded hover:bg-gray-100',
          'bg-gray-100 font-semibold' => request()->routeIs('admin.attendance-locations.*')
        ])>
          Locations
        </a>
      </div>
    </div>

  </nav>
</aside>