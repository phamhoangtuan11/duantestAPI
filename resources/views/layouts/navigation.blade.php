<nav x-data="{ open: false }" class="bg-white border-b border-gray-100">
    <!-- Primary Navigation Menu -->
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
        <div class="flex justify-between h-16">
            <div class="flex">
                <!-- Logo -->
                <div class="shrink-0 flex items-center">
                    <a href="{{ route('dashboard') }}">
                        <x-application-logo class="block h-9 w-auto fill-current text-gray-800" />
                    </a>
                </div>

                <!-- Navigation Links -->
                <div class="hidden space-x-8 sm:-my-px sm:ms-10 sm:flex">
                    <!-- Sửa đường dẫn route 'dashboard' -->
                    <x-nav-link :href="route('dashboard')" :active="request()->routeIs('dashboard')">
                        {{ __('Dashboard') }}
                    </x-nav-link>
                </div>
            </div>

            <!-- Settings Dropdown -->
<div class="hidden sm:flex sm:items-center sm:ms-6">
    @auth
        <x-dropdown align="right" width="48">

            <x-slot name="trigger">
                <button class="mmo-user-btn">

                    <div class="mmo-avatar">
                        {{ strtoupper(substr(Auth::user()->name, 0, 1)) }}
                    </div>

                    <div class="mmo-user-info">
                        <span>{{ Auth::user()->name }}</span>
                        <small>Thành viên</small>
                    </div>

                    <svg class="mmo-arrow" xmlns="http://www.w3.org/2000/svg"
                         fill="none" viewBox="0 0 24 24"
                         stroke-width="1.5" stroke="currentColor">
                        <path stroke-linecap="round"
                              stroke-linejoin="round"
                              d="m19.5 8.25-7.5 7.5-7.5-7.5"/>
                    </svg>

                </button>
            </x-slot>

            <x-slot name="content">
                <x-dropdown-link :href="route('profile.edit')">
                    👤 Hồ sơ
                </x-dropdown-link>

                <x-dropdown-link :href="url('/')">
                    🏠 Trang chủ
                </x-dropdown-link>

                <form method="POST" action="{{ route('logout') }}">
                    @csrf

                    <x-dropdown-link :href="route('logout')"
                        onclick="event.preventDefault(); this.closest('form').submit();">
                        🚪 Đăng xuất
                    </x-dropdown-link>
                </form>
            </x-slot>

        </x-dropdown>
    @endauth
</div>

            <!-- Hamburger -->
            <div class="-me-2 flex items-center sm:hidden">
                <button @click="open = ! open" class="inline-flex items-center justify-center p-2 rounded-md text-gray-400 hover:text-gray-500 hover:bg-gray-100 focus:outline-none focus:bg-gray-100 focus:text-gray-500 transition duration-150 ease-in-out">
                    <svg class="h-6 w-6" stroke="currentColor" fill="none" viewBox="0 0 24 24">
                        <path :class="{'hidden': open, 'inline-flex': ! open }" class="inline-flex" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 6h16M4 12h16M4 18h16" />
                        <path :class="{'hidden': ! open, 'inline-flex': open }" class="hidden" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12" />
                    </svg>
                </button>
            </div>
        </div>
    </div>

    <!-- Responsive Navigation Menu -->
    <div :class="{'block': open, 'hidden': ! open}" class="hidden sm:hidden">
        <div class="pt-2 pb-3 space-y-1">
            <!-- Sửa đường dẫn 'dashboard' cho mobile -->
            <x-responsive-nav-link :href="route('dashboard')" :active="request()->routeIs('dashboard')">
                {{ __('Dashboard') }}
            </x-responsive-nav-link>
        </div>

        <!-- Responsive Settings Options -->
        <div class="pt-4 pb-1 border-t border-gray-200">
            <div class="px-4">
                <div class="font-medium text-base text-gray-800">{{ Auth::user()->name }}</div>
                <div class="font-medium text-sm text-gray-500">{{ Auth::user()->email }}</div>
            </div>

            <div class="mt-3 space-y-1">
                <!-- Sửa đường dẫn 'profile.edit' cho mobile -->
                <x-responsive-nav-link :href="route('profile.edit')">
                    {{ __('Profile') }}
                </x-responsive-nav-link>

                <!-- Authentication -->
                <form method="POST" action="{{ route('logout') }}">
                    @csrf

                    <!-- Sửa đường dẫn 'logout' cho mobile -->
                    <x-responsive-nav-link :href="route('logout')" onclick="event.preventDefault(); this.closest('form').submit();">
                        {{ __('Log Out') }}
                    </x-responsive-nav-link>
                </form>
            </div>
        </div>
    </div>
</nav>
<style>
    /* MMO USER */
.mmo-user-btn{
    display:flex;
    align-items:center;
    gap:14px;

    background:rgba(15,23,42,.92);

    border:1px solid rgba(255,255,255,.06);

    padding:10px 16px;

    border-radius:18px;

    transition:.25s;

    backdrop-filter:blur(12px);

    box-shadow:
        0 10px 30px rgba(0,0,0,.25);

    color:white;
}

.mmo-user-btn:hover{
    transform:translateY(-2px);

    border-color:#3b82f6;

    box-shadow:
        0 0 25px rgba(59,130,246,.25);
}

/* AVATAR */
.mmo-avatar{
    width:46px;
    height:46px;

    border-radius:16px;

    background:
        linear-gradient(135deg,#3b82f6,#7c3aed);

    display:flex;
    align-items:center;
    justify-content:center;

    font-size:18px;
    font-weight:700;

    color:white;

    box-shadow:
        0 0 20px rgba(59,130,246,.35);
}

/* INFO */
.mmo-user-info{
    display:flex;
    flex-direction:column;
    align-items:flex-start;
}

.mmo-user-info span{
    font-size:15px;
    font-weight:700;
    color:white;
}

.mmo-user-info small{
    color:#94a3b8;
    font-size:12px;
}

/* ARROW */
.mmo-arrow{
    width:18px;
    height:18px;
    color:#94a3b8;
}
</style>