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

                    <!-- Kelola Gaji -->
                    <a href="{{ route('gaji.index') }}"
                       class="group flex items-center py-2 mt-1 text-base font-medium rounded-md transition-all duration-200 {{ request()->routeIs('gaji.*') ? 'bg-blue-100 dark:bg-blue-900 text-blue-900 dark:text-blue-100' : 'text-gray-600 dark:text-gray-300 hover:bg-gray-50 dark:hover:bg-gray-700 hover:text-gray-900 dark:hover:text-gray-100' }}"
                       :class="{'px-2': !sidebarMinimized, 'px-2 justify-center': sidebarMinimized}"
                       :title="sidebarMinimized ? 'Kelola Gaji' : ''">
                        <svg class="flex-shrink-0 w-6 h-6"
                             :class="{'mr-4': !sidebarMinimized, 'mr-0': sidebarMinimized}"
                             viewBox="0 0 24 24" fill="none">
                            <path d="M11.7255 17.1019C11.6265 16.8844 11.4215 16.7257 11.1734 16.6975C10.9633 16.6735 10.7576 16.6285 10.562 16.5636C10.4743 16.5341 10.392 16.5019 10.3158 16.4674L10.4424 16.1223C10.5318 16.1622 10.6239 16.1987 10.7182 16.2317L10.7221 16.2331L10.7261 16.2344C11.0287 16.3344 11.3265 16.3851 11.611 16.3851C11.8967 16.3851 12.1038 16.3468 12.2629 16.2647L12.2724 16.2598L12.2817 16.2544C12.5227 16.1161 12.661 15.8784 12.661 15.6021C12.661 15.2955 12.4956 15.041 12.2071 14.9035C12.062 14.8329 11.8559 14.7655 11.559 14.6917C11.2545 14.6147 10.9987 14.533 10.8003 14.4493C10.6553 14.3837 10.5295 14.279 10.4161 14.1293C10.3185 13.9957 10.2691 13.7948 10.2691 13.5319C10.2691 13.2147 10.3584 12.9529 10.5422 12.7315C10.7058 12.5375 10.9381 12.4057 11.2499 12.3318C11.4812 12.277 11.6616 12.1119 11.7427 11.8987C11.8344 12.1148 12.0295 12.2755 12.2723 12.3142C12.4751 12.3465 12.6613 12.398 12.8287 12.4677L12.7122 12.8059C12.3961 12.679 12.085 12.6149 11.7841 12.6149C10.7848 12.6149 10.7342 13.3043 10.7342 13.4425C10.7342 13.7421 10.896 13.9933 11.1781 14.1318L11.186 14.1357L11.194 14.1393C11.3365 14.2029 11.5387 14.2642 11.8305 14.3322C12.1322 14.4004 12.3838 14.4785 12.5815 14.5651L12.5856 14.5669L12.5897 14.5686C12.7365 14.6297 12.8624 14.7317 12.9746 14.8805L12.9764 14.8828L12.9782 14.8852C13.0763 15.012 13.1261 15.2081 13.1261 15.4681C13.1261 15.7682 13.0392 16.0222 12.8604 16.2447C12.7053 16.4377 12.4888 16.5713 12.1983 16.6531C11.974 16.7163 11.8 16.8878 11.7255 17.1019Z" fill="currentColor"></path>
                            <path d="M11.9785 18H11.497C11.3893 18 11.302 17.9105 11.302 17.8V17.3985C11.302 17.2929 11.2219 17.2061 11.1195 17.1944C10.8757 17.1667 10.6399 17.115 10.412 17.0394C10.1906 16.9648 9.99879 16.8764 9.83657 16.7739C9.76202 16.7268 9.7349 16.6312 9.76572 16.5472L10.096 15.6466C10.1405 15.5254 10.284 15.479 10.3945 15.5417C10.5437 15.6262 10.7041 15.6985 10.8755 15.7585C11.131 15.8429 11.3762 15.8851 11.611 15.8851C11.8129 15.8851 11.9572 15.8628 12.0437 15.8181C12.1302 15.7684 12.1735 15.6964 12.1735 15.6021C12.1735 15.4929 12.1158 15.411 12.0004 15.3564C11.8892 15.3018 11.7037 15.2422 11.4442 15.1777C11.1104 15.0933 10.8323 15.0039 10.6098 14.9096C10.3873 14.8103 10.1936 14.6514 10.0288 14.433C9.86396 14.2096 9.78156 13.9092 9.78156 13.5319C9.78156 13.095 9.91136 12.7202 10.1709 12.4074C10.4049 12.13 10.7279 11.9424 11.1401 11.8447C11.2329 11.8227 11.302 11.7401 11.302 11.6425V11.2C11.302 11.0895 11.3893 11 11.497 11H11.9785C12.0862 11 12.1735 11.0895 12.1735 11.2V11.6172C12.1735 11.7194 12.2487 11.8045 12.3471 11.8202C12.7082 11.8777 13.0255 11.9866 13.2989 12.1469C13.3765 12.1924 13.4073 12.2892 13.3775 12.3756L13.0684 13.2725C13.0275 13.3914 12.891 13.4417 12.7812 13.3849C12.433 13.2049 12.1007 13.1149 11.7841 13.1149C11.4091 13.1149 11.2216 13.2241 11.2216 13.4425C11.2216 13.5468 11.2773 13.6262 11.3885 13.6809C11.4998 13.7305 11.6831 13.7851 11.9386 13.8447C12.2682 13.9192 12.5464 14.006 12.773 14.1053C12.9996 14.1996 13.1953 14.356 13.3602 14.5745C13.5291 14.7929 13.6136 15.0908 13.6136 15.4681C13.6136 15.8851 13.4879 16.25 13.2365 16.5628C13.0176 16.8354 12.7145 17.0262 12.3274 17.1353C12.2384 17.1604 12.1735 17.2412 12.1735 17.3358V17.8C12.1735 17.9105 12.0862 18 11.9785 18Z" fill="currentColor"></path>
                            <path fill-rule="evenodd" clip-rule="evenodd" d="M9.59235 5H13.8141C14.8954 5 14.3016 6.664 13.8638 7.679L13.3656 8.843L13.2983 9C13.7702 8.97651 14.2369 9.11054 14.6282 9.382C16.0921 10.7558 17.2802 12.4098 18.1256 14.251C18.455 14.9318 18.5857 15.6958 18.5019 16.451C18.4013 18.3759 16.8956 19.9098 15.0182 20H8.38823C6.51033 19.9125 5.0024 18.3802 4.89968 16.455C4.81587 15.6998 4.94656 14.9358 5.27603 14.255C6.12242 12.412 7.31216 10.7565 8.77823 9.382C9.1696 9.11054 9.63622 8.97651 10.1081 9L10.0301 8.819L9.54263 7.679C9.1068 6.664 8.5101 5 9.59235 5Z" stroke="currentColor" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round"></path>
                            <path d="M13.2983 9.75C13.7125 9.75 14.0483 9.41421 14.0483 9C14.0483 8.58579 13.7125 8.25 13.2983 8.25V9.75ZM10.1081 8.25C9.69391 8.25 9.35812 8.58579 9.35812 9C9.35812 9.41421 9.69391 9.75 10.1081 9.75V8.25ZM15.9776 8.64988C16.3365 8.44312 16.4599 7.98455 16.2531 7.62563C16.0463 7.26671 15.5878 7.14336 15.2289 7.35012L15.9776 8.64988ZM13.3656 8.843L13.5103 9.57891L13.5125 9.57848L13.3656 8.843ZM10.0301 8.819L10.1854 8.08521L10.1786 8.08383L10.0301 8.819ZM8.166 7.34357C7.80346 7.14322 7.34715 7.27469 7.1468 7.63722C6.94644 7.99976 7.07791 8.45607 7.44045 8.65643L8.166 7.34357ZM13.2983 8.25H10.1081V9.75H13.2983V8.25ZM15.2289 7.35012C14.6019 7.71128 13.9233 7.96683 13.2187 8.10752L13.5125 9.57848C14.3778 9.40568 15.2101 9.09203 15.9776 8.64988L15.2289 7.35012ZM13.2209 8.10709C12.2175 8.30441 11.1861 8.29699 10.1854 8.08525L9.87486 9.55275C11.0732 9.80631 12.3086 9.81521 13.5103 9.57891L13.2209 8.10709ZM10.1786 8.08383C9.47587 7.94196 8.79745 7.69255 8.166 7.34357L7.44045 8.65643C8.20526 9.0791 9.02818 9.38184 9.88169 9.55417L10.1786 8.08383Z" fill="currentColor"></path>
                        </svg>
                        <span class="transition-all duration-300"
                              :class="{'opacity-0 w-0': sidebarMinimized, 'opacity-100': !sidebarMinimized}"
                              x-show="!sidebarMinimized">Kelola Gaji</span>
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
