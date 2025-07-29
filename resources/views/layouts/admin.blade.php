<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <meta name="csrf-token" content="{{ csrf_token() }}">

        <title>{{ config('app.name', 'Laravel') }} - Admin Dashboard</title>

        <!-- Fonts -->
        <link rel="preconnect" href="https://fonts.bunny.net">
        <link href="https://fonts.bunny.net/css?family=figtree:400,500,600&display=swap" rel="stylesheet" />

        <!-- Scripts -->
        @vite(['resources/css/app.css', 'resources/js/app.js'])

        <!-- Chart.js -->
        <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>

        <!-- Alpine.js -->
        <script defer src="https://unpkg.com/alpinejs@3.x.x/dist/cdn.min.js"></script>
    </head>
    <body class="font-sans antialiased">
        <script>
            // Auto detect and apply system theme
            (function() {
                function updateTheme() {
                    const isDark = window.matchMedia('(prefers-color-scheme: dark)').matches;
                    document.documentElement.classList.toggle('dark', isDark);
                }

                // Apply theme immediately
                updateTheme();

                // Listen for system theme changes
                window.matchMedia('(prefers-color-scheme: dark)').addEventListener('change', updateTheme);
            })();
        </script>
        <div class="flex min-h-screen bg-gray-100 dark:bg-gray-900" x-data="{ sidebarOpen: false, sidebarMinimized: false }">
            <!-- Sidebar -->
            <div class="fixed inset-y-0 left-0 z-50 transition-all duration-300 ease-in-out transform bg-white shadow-lg dark:bg-gray-800 lg:relative lg:flex lg:flex-col"
                 :class="{
                     'w-64': !sidebarMinimized,
                     'w-16': sidebarMinimized,
                     'translate-x-0': sidebarOpen || window.innerWidth >= 1024,
                     '-translate-x-full': !sidebarOpen && window.innerWidth < 1024
                 }">
                <!-- Sidebar Header -->
                <div class="flex items-center flex-shrink-0 h-16 px-4 text-white bg-blue-600"
                     :class="{'justify-center': sidebarMinimized, 'justify-between': !sidebarMinimized}">
                    <div class="flex items-center">
                        <!-- Coffee Cup Icon -->
                        <svg class="flex-shrink-0 w-8 h-8 mr-3 text-white"
                             :class="{'mr-0': sidebarMinimized, 'mr-3': !sidebarMinimized}"
                             fill="currentColor" viewBox="0 0 24 24">
                            <path fill-rule="evenodd" clip-rule="evenodd" d="M16.5 11.3308C16.5 13.1552 14.7029 15 12 15C9.29713 15 7.5 13.1552 7.5 11.3308V7.5H16.5V11.3308ZM17.9502 12C17.7751 13.1667 17.1485 14.2115 16.2263 15H18V16.5L12 16.5L6 16.5V15H7.77371C6.67832 14.0635 6 12.7654 6 11.3308V6H18C19.6569 6 21 7.34315 21 9C21 10.6569 19.6569 12 18 12H17.9502ZM18 7.5V10.5C18.8284 10.5 19.5 9.82843 19.5 9C19.5 8.17157 18.8284 7.5 18 7.5ZM7.5 18.75L7.5 17.25L16.5 17.25V18.75L7.5 18.75Z"/>
                        </svg>
                        <h2 class="text-xl font-bold transition-all duration-300"
                            :class="{'opacity-0 w-0': sidebarMinimized, 'opacity-100': !sidebarMinimized}"
                            x-show="!sidebarMinimized">Laravel Cafe</h2>
                    </div>

                    <!-- Minimize/Expand Button for Desktop -->
                    <button @click="sidebarMinimized = !sidebarMinimized"
                            class="hidden lg:block p-1.5 rounded-md hover:bg-blue-700 transition-colors"
                            :title="sidebarMinimized ? 'Expand Sidebar' : 'Minimize Sidebar'">
                        <svg class="w-5 h-5 transition-transform duration-300"
                             :class="{'rotate-180': sidebarMinimized}"
                             fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M11 19l-7-7 7-7m8 14l-7-7 7-7"></path>
                        </svg>
                    </button>
                </div>

                <!-- Navigation Menu -->
                <nav class="flex-1 mt-5 overflow-y-auto bg-white dark:bg-gray-800"
                     :class="{'px-2': !sidebarMinimized, 'px-1': sidebarMinimized}">
                    <!-- Dashboard -->
                    <a href="{{ route('admin.dashboard') }}"
                       class="group flex items-center py-2 text-base font-medium rounded-md transition-all duration-200 relative {{ request()->routeIs('admin.dashboard') ? 'bg-blue-100 dark:bg-blue-900 text-blue-900 dark:text-blue-100' : 'text-gray-600 dark:text-gray-300 hover:bg-gray-50 dark:hover:bg-gray-700 hover:text-gray-900 dark:hover:text-gray-100' }}"
                       :class="{'px-2': !sidebarMinimized, 'px-2 justify-center': sidebarMinimized}"
                       :title="sidebarMinimized ? 'Dashboard' : ''">
                        <svg class="flex-shrink-0 w-6 h-6"
                             :class="{'mr-4': !sidebarMinimized, 'mr-0': sidebarMinimized}"
                             viewBox="0 -0.5 25 25" fill="none">
                            <path d="M12.5 11.75C12.9142 11.75 13.25 11.4142 13.25 11C13.25 10.5858 12.9142 10.25 12.5 10.25V11.75ZM5.5 10.25C5.08579 10.25 4.75 10.5858 4.75 11C4.75 11.4142 5.08579 11.75 5.5 11.75V10.25ZM12.5 10.25C12.0858 10.25 11.75 10.5858 11.75 11C11.75 11.4142 12.0858 11.75 12.5 11.75V10.25ZM19.5 11.75C19.9142 11.75 20.25 11.4142 20.25 11C20.25 10.5858 19.9142 10.25 19.5 10.25V11.75ZM11.75 11C11.75 11.4142 12.0858 11.75 12.5 11.75C12.9142 11.75 13.25 11.4142 13.25 11H11.75ZM13.25 5C13.25 4.58579 12.9142 4.25 12.5 4.25C12.0858 4.25 11.75 4.58579 11.75 5H13.25ZM6.25 11C6.25 10.5858 5.91421 10.25 5.5 10.25C5.08579 10.25 4.75 10.5858 4.75 11H6.25ZM20.25 11C20.25 10.5858 19.9142 10.25 19.5 10.25C19.0858 10.25 18.75 10.5858 18.75 11H20.25ZM4.75 11C4.75 11.4142 5.08579 11.75 5.5 11.75C5.91421 11.75 6.25 11.4142 6.25 11H4.75ZM12.5 5.75C12.9142 5.75 13.25 5.41421 13.25 5C13.25 4.58579 12.9142 4.25 12.5 4.25V5.75ZM18.75 11C18.75 11.4142 19.0858 11.75 19.5 11.75C19.9142 11.75 20.25 11.4142 20.25 11H18.75ZM12.5 4.25C12.0858 4.25 11.75 4.58579 11.75 5C11.75 5.41421 12.0858 5.75 12.5 5.75V4.25ZM12.5 10.25H5.5V11.75H12.5V10.25ZM12.5 11.75H19.5V10.25H12.5V11.75ZM13.25 11V5H11.75V11H13.25ZM4.75 11V15H6.25V11H4.75ZM4.75 15C4.75 17.6234 6.87665 19.75 9.5 19.75V18.25C7.70507 18.25 6.25 16.7949 6.25 15H4.75ZM9.5 19.75H15.5V18.25H9.5V19.75ZM15.5 19.75C18.1234 19.75 20.25 17.6234 20.25 15H18.75C18.75 16.7949 17.2949 18.25 15.5 18.25V19.75ZM20.25 15V11H18.75V15H20.25ZM6.25 11V9H4.75V11H6.25ZM6.25 9C6.25 7.20507 7.70507 5.75 9.5 5.75V4.25C6.87665 4.25 4.75 6.37665 4.75 9H6.25ZM9.5 5.75H12.5V4.25H9.5V5.75ZM20.25 11V9H18.75V11H20.25ZM20.25 9C20.25 6.37665 18.1234 4.25 15.5 4.25V5.75C17.2949 5.75 18.75 7.20507 18.75 9H20.25ZM15.5 4.25H12.5V5.75H15.5V4.25Z" fill="currentColor"></path>
                        </svg>
                        <span class="transition-all duration-300"
                              :class="{'opacity-0 w-0': sidebarMinimized, 'opacity-100': !sidebarMinimized}"
                              x-show="!sidebarMinimized">Dashboard</span>
                    </a>

                    <!-- Menu Section Header -->
                    <div class="mt-8" x-show="!sidebarMinimized">
                        <h3 class="px-3 text-xs font-semibold tracking-wider text-gray-500 uppercase dark:text-gray-400">
                            Menu Utama
                        </h3>
                    </div>
                    <!-- Divider for minimized state -->
                    <div class="mt-6 border-t border-gray-200 dark:border-gray-600" x-show="sidebarMinimized"></div>

                    <!-- Kelola Karyawan -->
                    <a href="{{ route('karyawan.index') }}"
                       class="group flex items-center py-2 mt-1 text-base font-medium rounded-md transition-all duration-200 {{ request()->routeIs('karyawan.*') ? 'bg-blue-100 dark:bg-blue-900 text-blue-900 dark:text-blue-100' : 'text-gray-600 dark:text-gray-300 hover:bg-gray-50 dark:hover:bg-gray-700 hover:text-gray-900 dark:hover:text-gray-100' }}"
                       :class="{'px-2': !sidebarMinimized, 'px-2 justify-center': sidebarMinimized}"
                       :title="sidebarMinimized ? 'Kelola Karyawan' : ''">
                        <svg class="flex-shrink-0 w-6 h-6"
                             :class="{'mr-4': !sidebarMinimized, 'mr-0': sidebarMinimized}"
                             fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17 20h5v-2a3 3 0 00-5.356-1.857M17 20H7m10 0v-2c0-.656-.126-1.283-.356-1.857M7 20H2v-2a3 3 0 015.356-1.857M7 20v-2c0-.656.126-1.283.356-1.857m0 0a5.002 5.002 0 019.288 0M15 7a3 3 0 11-6 0 3 3 0 016 0zm6 3a2 2 0 11-4 0 2 2 0 014 0zM7 10a2 2 0 11-4 0 2 2 0 014 0z"></path>
                        </svg>
                        <span class="transition-all duration-300"
                              :class="{'opacity-0 w-0': sidebarMinimized, 'opacity-100': !sidebarMinimized}"
                              x-show="!sidebarMinimized">Kelola Karyawan</span>
                    </a>

                    <!-- Kelola Menu -->
                    <a href="{{ route('menu.index') }}"
                       class="group flex items-center py-2 mt-1 text-base font-medium rounded-md transition-all duration-200 {{ request()->routeIs('menu.*') ? 'bg-blue-100 dark:bg-blue-900 text-blue-900 dark:text-blue-100' : 'text-gray-600 dark:text-gray-300 hover:bg-gray-50 dark:hover:bg-gray-700 hover:text-gray-900 dark:hover:text-gray-100' }}"
                       :class="{'px-2': !sidebarMinimized, 'px-2 justify-center': sidebarMinimized}"
                       :title="sidebarMinimized ? 'Kelola Menu' : ''">
                        <svg class="flex-shrink-0 w-6 h-6"
                             :class="{'mr-4': !sidebarMinimized, 'mr-0': sidebarMinimized}"
                             viewBox="0 0 1024 1024" fill="none">
                            <path fill="currentColor" d="M128 352.576V352a288 288 0 0 1 491.072-204.224 192 192 0 0 1 274.24 204.48 64 64 0 0 1 57.216 74.24C921.6 600.512 850.048 710.656 736 756.992V800a96 96 0 0 1-96 96H384a96 96 0 0 1-96-96v-43.008c-114.048-46.336-185.6-156.48-214.528-330.496A64 64 0 0 1 128 352.64zm64-.576h64a160 160 0 0 1 320 0h64a224 224 0 0 0-448 0zm128 0h192a96 96 0 0 0-192 0zm439.424 0h68.544A128.256 128.256 0 0 0 704 192c-15.36 0-29.952 2.688-43.52 7.616 11.328 18.176 20.672 37.76 27.84 58.304A64.128 64.128 0 0 1 759.424 352zM672 768H352v32a32 32 0 0 0 32 32h256a32 32 0 0 0 32-32v-32zm-342.528-64h365.056c101.504-32.64 165.76-124.928 192.896-288H136.576c27.136 163.072 91.392 255.36 192.896 288z"></path>
                        </svg>
                        <span class="transition-all duration-300"
                              :class="{'opacity-0 w-0': sidebarMinimized, 'opacity-100': !sidebarMinimized}"
                              x-show="!sidebarMinimized">Kelola Menu</span>
                    </a>

                    <!-- Kelola Kehadiran -->
                    <a href="{{ route('kehadiran.index') }}"
                       class="group flex items-center py-2 mt-1 text-base font-medium rounded-md transition-all duration-200 {{ request()->routeIs('kehadiran.*') ? 'bg-blue-100 dark:bg-blue-900 text-blue-900 dark:text-blue-100' : 'text-gray-600 dark:text-gray-300 hover:bg-gray-50 dark:hover:bg-gray-700 hover:text-gray-900 dark:hover:text-gray-100' }}"
                       :class="{'px-2': !sidebarMinimized, 'px-2 justify-center': sidebarMinimized}"
                       :title="sidebarMinimized ? 'Kelola Kehadiran' : ''">
                        <svg class="flex-shrink-0 w-6 h-6"
                             :class="{'mr-4': !sidebarMinimized, 'mr-0': sidebarMinimized}"
                             viewBox="0 0 24 24" fill="none">
                            <path d="M12 21C16.9706 21 21 16.9706 21 12C21 7.02944 16.9706 3 12 3C7.02944 3 3 7.02944 3 12C3 16.9706 7.02944 21 12 21Z" stroke="currentColor" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round"></path>
                            <path d="M12 6V12" stroke="currentColor" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round"></path>
                            <path d="M16.24 16.24L12 12" stroke="currentColor" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round"></path>
                        </svg>
                        <span class="transition-all duration-300"
                              :class="{'opacity-0 w-0': sidebarMinimized, 'opacity-100': !sidebarMinimized}"
                              x-show="!sidebarMinimized">Kelola Kehadiran</span>
                    </a>

                    <!-- Kelola User -->
                    <a href="{{ route('users.index') }}"
                       class="group flex items-center py-2 mt-1 text-base font-medium rounded-md transition-all duration-200 {{ request()->routeIs('users.*') ? 'bg-blue-100 dark:bg-blue-900 text-blue-900 dark:text-blue-100' : 'text-gray-600 dark:text-gray-300 hover:bg-gray-50 dark:hover:bg-gray-700 hover:text-gray-900 dark:hover:text-gray-100' }}"
                       :class="{'px-2': !sidebarMinimized, 'px-2 justify-center': sidebarMinimized}"
                       :title="sidebarMinimized ? 'Kelola User' : ''">
                        <svg class="flex-shrink-0 w-6 h-6"
                             :class="{'mr-4': !sidebarMinimized, 'mr-0': sidebarMinimized}"
                             fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M16 7a4 4 0 11-8 0 4 4 0 018 0zM12 14a7 7 0 00-7 7h14a7 7 0 00-7-7z"></path>
                        </svg>
                        <span class="transition-all duration-300"
                              :class="{'opacity-0 w-0': sidebarMinimized, 'opacity-100': !sidebarMinimized}"
                              x-show="!sidebarMinimized">Kelola User</span>
                    </a>

                    <!-- Kelola Transaksi -->
                    <a href="{{ route('transaksi.index') }}"
                       class="group flex items-center py-2 mt-1 text-base font-medium rounded-md transition-all duration-200 {{ request()->routeIs('transaksi.*') ? 'bg-blue-100 dark:bg-blue-900 text-blue-900 dark:text-blue-100' : 'text-gray-600 dark:text-gray-300 hover:bg-gray-50 dark:hover:bg-gray-700 hover:text-gray-900 dark:hover:text-gray-100' }}"
                       :class="{'px-2': !sidebarMinimized, 'px-2 justify-center': sidebarMinimized}"
                       :title="sidebarMinimized ? 'Kelola Transaksi' : ''">
                        <svg class="flex-shrink-0 w-6 h-6"
                             :class="{'mr-4': !sidebarMinimized, 'mr-0': sidebarMinimized}"
                             viewBox="0 0 24 24" fill="none">
                            <path d="M2 3L2.26491 3.0883C3.58495 3.52832 4.24497 3.74832 4.62248 4.2721C5 4.79587 5 5.49159 5 6.88304V9.5C5 12.3284 5 13.7426 5.87868 14.6213C6.75736 15.5 8.17157 15.5 11 15.5H19" stroke="currentColor" stroke-width="1.5" stroke-linecap="round"></path>
                            <path d="M7.5 18C8.32843 18 9 18.6716 9 19.5C9 20.3284 8.32843 21 7.5 21C6.67157 21 6 20.3284 6 19.5C6 18.6716 6.67157 18 7.5 18Z" stroke="currentColor" stroke-width="1.5"></path>
                            <path d="M16.5 18.0001C17.3284 18.0001 18 18.6716 18 19.5001C18 20.3285 17.3284 21.0001 16.5 21.0001C15.6716 21.0001 15 20.3285 15 19.5001C15 18.6716 15.6716 18.0001 16.5 18.0001Z" stroke="currentColor" stroke-width="1.5"></path>
                            <path d="M5 6H16.4504C18.5054 6 19.5328 6 19.9775 6.67426C20.4221 7.34853 20.0173 8.29294 19.2078 10.1818L18.7792 11.1818C18.4013 12.0636 18.2123 12.5045 17.8366 12.7523C17.4609 13 16.9812 13 16.0218 13H5" stroke="currentColor" stroke-width="1.5"></path>
                        </svg>
                        <span class="transition-all duration-300"
                              :class="{'opacity-0 w-0': sidebarMinimized, 'opacity-100': !sidebarMinimized}"
                              x-show="!sidebarMinimized">Kelola Transaksi</span>
                    </a>

                    <!-- Menu Section Header -->
                    <div class="mt-8" x-show="!sidebarMinimized">
                        <h3 class="px-3 text-xs font-semibold tracking-wider text-gray-500 uppercase dark:text-gray-400">
                            Sistem
                        </h3>
                    </div>
                    <!-- Divider for minimized state -->
                    <div class="mt-6 border-t border-gray-200 dark:border-gray-600" x-show="sidebarMinimized"></div>

                    <!-- Logout -->
                    <form method="POST" action="{{ route('logout') }}" class="mt-1">
                        @csrf
                        <button type="submit"
                                class="flex items-center w-full py-2 text-base font-medium text-red-600 transition-all duration-200 rounded-md group dark:text-red-400 hover:bg-red-50 dark:hover:bg-red-900/20 hover:text-red-700 dark:hover:text-red-300"
                                :class="{'px-2': !sidebarMinimized, 'px-2 justify-center': sidebarMinimized}"
                                :title="sidebarMinimized ? 'Logout' : ''">
                            <svg class="flex-shrink-0 w-6 h-6"
                                 :class="{'mr-4': !sidebarMinimized, 'mr-0': sidebarMinimized}"
                                 fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17 16l4-4m0 0l-4-4m4 4H7m6 4v1a3 3 0 01-3 3H6a3 3 0 01-3-3V7a3 3 0 013-3h4a3 3 0 013 3v1"></path>
                            </svg>
                            <span class="transition-all duration-300"
                                  :class="{'opacity-0 w-0': sidebarMinimized, 'opacity-100': !sidebarMinimized}"
                                  x-show="!sidebarMinimized">Logout</span>
                        </button>
                    </form>
                </nav>
            </div>

            <!-- Sidebar overlay for mobile -->
            <div class="fixed inset-0 z-40 lg:hidden" x-show="sidebarOpen" x-transition:enter="transition-opacity ease-linear duration-300" x-transition:enter-start="opacity-0" x-transition:enter-end="opacity-100" x-transition:leave="transition-opacity ease-linear duration-300" x-transition:leave-start="opacity-100" x-transition:leave-end="opacity-0" style="display: none;">
                <div class="absolute inset-0 bg-gray-600 opacity-75" @click="sidebarOpen = false"></div>
            </div>

            <!-- Main content -->
            <div class="flex flex-col flex-1 min-w-0">
                <!-- Top navigation -->
                <div class="relative z-10 flex flex-shrink-0 h-16 bg-white shadow dark:bg-gray-800">
                    <!-- Mobile menu button -->
                    <button class="px-4 text-gray-500 border-r border-gray-200 dark:border-gray-600 dark:text-gray-400 focus:outline-none focus:ring-2 focus:ring-inset focus:ring-blue-500 lg:hidden"
                            @click="sidebarOpen = true">
                        <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 6h16M4 12h16M4 18h16"></path>
                        </svg>
                    </button>

                    <!-- Top bar content -->
                    <div class="flex justify-between flex-1 px-4">
                        <div class="flex items-center flex-1">
                            <!-- Page title -->
                            @isset($header)
                                <h1 class="text-2xl font-semibold text-gray-900 dark:text-gray-100">
                                    {{ $header }}
                                </h1>
                            @endisset
                        </div>

                        <!-- User info -->
                        <div class="flex items-center ml-4 md:ml-6">
                            <!-- User info -->
                            <div class="text-sm text-gray-700 dark:text-gray-300">
                                <span class="font-medium">{{ Auth::user()->name }}</span>
                                <span class="text-gray-500 dark:text-gray-400">| {{ ucfirst(Auth::user()->role ?? 'No Role') }}</span>
                                @if(Auth::user()->getRoleNames()->isNotEmpty())
                                    <span class="text-gray-400 dark:text-gray-500">({{ Auth::user()->getRoleNames()->first() }})</span>
                                @endif
                            </div>
                        </div>
                    </div>
                </div>

                <!-- Page content -->
                <main class="flex-1 overflow-y-auto">
                    {{ $slot }}
                </main>
            </div>
        </div>
    </body>
</html>
