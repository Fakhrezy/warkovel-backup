<x-guest-layout>
    <!-- Icon Informasi - Positioned outside form -->
    <div class="absolute z-50 top-4 right-4 group">
        <div class="p-2 transition-all bg-white border border-gray-200 rounded-full shadow-md cursor-help dark:bg-gray-800 dark:border-gray-600 hover:shadow-lg">
            <svg class="w-5 h-5 text-gray-400 hover:text-gray-600 dark:text-gray-500 dark:hover:text-gray-300" fill="currentColor" viewBox="0 0 20 20" xmlns="http://www.w3.org/2000/svg">
                <path fill-rule="evenodd" d="M18 10a8 8 0 11-16 0 8 8 0 0116 0zm-7-4a1 1 0 11-2 0 1 1 0 012 0zM9 9a1 1 0 000 2v3a1 1 0 001 1h1a1 1 0 100-2v-3a1 1 0 00-1-1H9z" clip-rule="evenodd"></path>
            </svg>
        </div>

        <!-- Tooltip Informasi Akun -->
        <div class="absolute right-0 z-50 invisible p-4 transition-all duration-300 bg-white border border-gray-200 rounded-lg shadow-xl opacity-0 top-12 w-80 dark:bg-gray-800 dark:border-gray-700 group-hover:opacity-100 group-hover:visible">
            <div class="mb-4 text-center">
                <div class="flex items-center justify-center gap-2 mb-2">
                    <svg class="w-4 h-4 text-blue-500" fill="currentColor" viewBox="0 0 20 20" xmlns="http://www.w3.org/2000/svg">
                        <path fill-rule="evenodd" d="M18 8a6 6 0 01-7.743 5.743L10 14l-0.257-0.257A6 6 0 0118 8zM2 8a6 6 0 017.743 5.743L10 14l0.257-0.257A6 6 0 012 8zm8-2a2 2 0 100 4 2 2 0 000-4z" clip-rule="evenodd"></path>
                    </svg>
                    <h3 class="text-sm font-bold text-gray-900 dark:text-gray-100">Akun Testing</h3>
                </div>
            </div>

            <div class="space-y-2">
                <!-- Admin -->
                <div class="p-3 transition-all border border-transparent rounded-lg cursor-pointer group/item hover:bg-blue-50 dark:hover:bg-blue-900/20 hover:border-blue-200 dark:hover:border-blue-700" data-email="admin@cafe.com" data-password="password">
                    <div class="flex items-center justify-between mb-2">
                        <span class="flex items-center gap-1 px-2 py-1 text-xs font-semibold text-blue-600 bg-blue-100 rounded-full dark:text-blue-400 dark:bg-blue-900/50">
                            <svg class="w-3 h-3" fill="currentColor" viewBox="0 0 20 20" xmlns="http://www.w3.org/2000/svg">
                                <path fill-rule="evenodd" d="M6 6V5a3 3 0 013-3h2a3 3 0 013 3v1h2a2 2 0 012 2v3.57A22.952 22.952 0 0110 13a22.95 22.95 0 01-8-1.43V8a2 2 0 012-2h2zm2-1a1 1 0 011-1h2a1 1 0 011 1v1H8V5zm1 5a1 1 0 011-1h.01a1 1 0 110 2H10a1 1 0 01-1-1z" clip-rule="evenodd"></path>
                                <path d="M2 13.692V16a2 2 0 002 2h12a2 2 0 002-2v-2.308A24.974 24.974 0 0110 15c-2.796 0-5.487-.46-8-1.308z"></path>
                            </svg>
                            Admin
                        </span>
                        <div class="text-xs text-gray-400 transition-opacity opacity-0 group-hover/item:opacity-100">isi otomatis</div>
                    </div>
                    <div class="space-y-1 text-xs">
                        <div class="flex items-center text-gray-700 dark:text-gray-300">
                            <svg class="w-4 h-4 text-gray-400" fill="currentColor" viewBox="0 0 20 20" xmlns="http://www.w3.org/2000/svg">
                                <path d="M2.003 5.884L10 9.882l7.997-3.998A2 2 0 0016 4H4a2 2 0 00-1.997 1.884z"></path>
                                <path d="M18 8.118l-8 4-8-4V14a2 2 0 002 2h12a2 2 0 002-2V8.118z"></path>
                            </svg>
                            <span class="ml-1 font-mono">admin@cafe.com</span>
                        </div>
                        <div class="flex items-center text-gray-700 dark:text-gray-300">
                            <svg class="w-4 h-4 text-gray-400" fill="currentColor" viewBox="0 0 20 20" xmlns="http://www.w3.org/2000/svg">
                                <path fill-rule="evenodd" d="M5 9V7a5 5 0 0110 0v2a2 2 0 012 2v5a2 2 0 01-2 2H5a2 2 0 01-2-2v-5a2 2 0 012-2zm8-2v2H7V7a3 3 0 016 0z" clip-rule="evenodd"></path>
                            </svg>
                            <span class="ml-1 font-mono">password</span>
                        </div>
                    </div>
                </div>

                <!-- Absen -->
                <div class="p-3 transition-all border border-transparent rounded-lg cursor-pointer group/item hover:bg-green-50 dark:hover:bg-green-900/20 hover:border-green-200 dark:hover:border-green-700" data-email="deden@cafe.com" data-password="deden123">
                    <div class="flex items-center justify-between mb-2">
                        <span class="flex items-center gap-1 px-2 py-1 text-xs font-semibold text-green-600 bg-green-100 rounded-full dark:text-green-400 dark:bg-green-900/50">
                            <svg class="w-3 h-3" fill="currentColor" viewBox="0 0 20 20" xmlns="http://www.w3.org/2000/svg">
                                <path fill-rule="evenodd" d="M6.267 3.455a3.066 3.066 0 001.745-.723 3.066 3.066 0 013.976 0 3.066 3.066 0 001.745.723 3.066 3.066 0 012.812 2.812c.051.643.304 1.254.723 1.745a3.066 3.066 0 010 3.976 3.066 3.066 0 00-.723 1.745 3.066 3.066 0 01-2.812 2.812 3.066 3.066 0 00-1.745.723 3.066 3.066 0 01-3.976 0 3.066 3.066 0 00-1.745-.723 3.066 3.066 0 01-2.812-2.812 3.066 3.066 0 00-.723-1.745 3.066 3.066 0 010-3.976 3.066 3.066 0 00.723-1.745 3.066 3.066 0 012.812-2.812zm7.44 5.252a1 1 0 00-1.414-1.414L9 10.586 7.707 9.293a1 1 0 00-1.414 1.414l2 2a1 1 0 001.414 0l4-4z" clip-rule="evenodd"></path>
                            </svg>
                            Absen
                        </span>
                        <div class="text-xs text-gray-400 transition-opacity opacity-0 group-hover/item:opacity-100">isi otomatis</div>
                    </div>
                    <div class="space-y-1 text-xs">
                        <div class="flex items-center text-gray-700 dark:text-gray-300">
                            <svg class="w-4 h-4 text-gray-400" fill="currentColor" viewBox="0 0 20 20" xmlns="http://www.w3.org/2000/svg">
                                <path d="M2.003 5.884L10 9.882l7.997-3.998A2 2 0 0016 4H4a2 2 0 00-1.997 1.884z"></path>
                                <path d="M18 8.118l-8 4-8-4V14a2 2 0 002 2h12a2 2 0 002-2V8.118z"></path>
                            </svg>
                            <span class="ml-1 font-mono">deden@cafe.com</span>
                        </div>
                        <div class="flex items-center text-gray-700 dark:text-gray-300">
                            <svg class="w-4 h-4 text-gray-400" fill="currentColor" viewBox="0 0 20 20" xmlns="http://www.w3.org/2000/svg">
                                <path fill-rule="evenodd" d="M5 9V7a5 5 0 0110 0v2a2 2 0 012 2v5a2 2 0 01-2 2H5a2 2 0 01-2-2v-5a2 2 0 012-2zm8-2v2H7V7a3 3 0 016 0z" clip-rule="evenodd"></path>
                            </svg>
                            <span class="ml-1 font-mono">deden123</span>
                        </div>
                    </div>
                </div>

                <!-- Kasir -->
                <div class="p-3 transition-all border border-transparent rounded-lg cursor-pointer group/item hover:bg-yellow-50 dark:hover:bg-yellow-900/20 hover:border-yellow-200 dark:hover:border-yellow-700" data-email="kasir@cafe.com" data-password="kasir123">
                    <div class="flex items-center justify-between mb-2">
                        <span class="flex items-center gap-1 px-2 py-1 text-xs font-semibold text-yellow-600 bg-yellow-100 rounded-full dark:text-yellow-400 dark:bg-yellow-900/50">
                            <svg class="w-3 h-3" fill="currentColor" viewBox="0 0 20 20" xmlns="http://www.w3.org/2000/svg">
                                <path d="M4 4a2 2 0 00-2 2v1h16V6a2 2 0 00-2-2H4z"></path>
                                <path fill-rule="evenodd" d="M18 9H2v5a2 2 0 002 2h12a2 2 0 002-2V9zM4 13a1 1 0 011-1h1a1 1 0 110 2H5a1 1 0 01-1-1zm5-1a1 1 0 100 2h1a1 1 0 100-2H9z" clip-rule="evenodd"></path>
                            </svg>
                            Kasir
                        </span>
                        <div class="text-xs text-gray-400 transition-opacity opacity-0 group-hover/item:opacity-100">isi otomatis</div>
                    </div>
                    <div class="space-y-1 text-xs">
                        <div class="flex items-center text-gray-700 dark:text-gray-300">
                            <svg class="w-4 h-4 text-gray-400" fill="currentColor" viewBox="0 0 20 20" xmlns="http://www.w3.org/2000/svg">
                                <path d="M2.003 5.884L10 9.882l7.997-3.998A2 2 0 0016 4H4a2 2 0 00-1.997 1.884z"></path>
                                <path d="M18 8.118l-8 4-8-4V14a2 2 0 002 2h12a2 2 0 002-2V8.118z"></path>
                            </svg>
                            <span class="ml-1 font-mono">kasir@cafe.com</span>
                        </div>
                        <div class="flex items-center text-gray-700 dark:text-gray-300">
                            <svg class="w-4 h-4 text-gray-400" fill="currentColor" viewBox="0 0 20 20" xmlns="http://www.w3.org/2000/svg">
                                <path fill-rule="evenodd" d="M5 9V7a5 5 0 0110 0v2a2 2 0 012 2v5a2 2 0 01-2 2H5a2 2 0 01-2-2v-5a2 2 0 012-2zm8-2v2H7V7a3 3 0 016 0z" clip-rule="evenodd"></path>
                            </svg>
                            <span class="ml-1 font-mono">kasir123</span>
                        </div>
                    </div>
                </div>

                <!-- Barista -->
                <div class="p-3 transition-all border border-transparent rounded-lg cursor-pointer group/item hover:bg-purple-50 dark:hover:bg-purple-900/20 hover:border-purple-200 dark:hover:border-purple-700" data-email="barista@cafe.com" data-password="barista123">
                    <div class="flex items-center justify-between mb-2">
                        <span class="flex items-center gap-1 px-2 py-1 text-xs font-semibold text-purple-600 bg-purple-100 rounded-full dark:text-purple-400 dark:bg-purple-900/50">
                            <svg class="w-3 h-3" fill="currentColor" viewBox="0 0 20 20" xmlns="http://www.w3.org/2000/svg">
                                <path fill-rule="evenodd" d="M3 3a1 1 0 000 2v8a2 2 0 002 2h2.586l-1.293 1.293a1 1 0 101.414 1.414L10 15.414l2.293 2.293a1 1 0 001.414-1.414L12.414 15H15a2 2 0 002-2V5a1 1 0 100-2H3zm11.707 4.707a1 1 0 00-1.414-1.414L10 9.586 8.707 8.293a1 1 0 00-1.414 1.414l2 2a1 1 0 001.414 0l4-4z" clip-rule="evenodd"></path>
                            </svg>
                            Barista
                        </span>
                        <div class="text-xs text-gray-400 transition-opacity opacity-0 group-hover/item:opacity-100">isi otomatis</div>
                    </div>
                    <div class="space-y-1 text-xs">
                        <div class="flex items-center text-gray-700 dark:text-gray-300">
                            <svg class="w-4 h-4 text-gray-400" fill="currentColor" viewBox="0 0 20 20" xmlns="http://www.w3.org/2000/svg">
                                <path d="M2.003 5.884L10 9.882l7.997-3.998A2 2 0 0016 4H4a2 2 0 00-1.997 1.884z"></path>
                                <path d="M18 8.118l-8 4-8-4V14a2 2 0 002 2h12a2 2 0 002-2V8.118z"></path>
                            </svg>
                            <span class="ml-1 font-mono">barista@cafe.com</span>
                        </div>
                        <div class="flex items-center text-gray-700 dark:text-gray-300">
                            <svg class="w-4 h-4 text-gray-400" fill="currentColor" viewBox="0 0 20 20" xmlns="http://www.w3.org/2000/svg">
                                <path fill-rule="evenodd" d="M5 9V7a5 5 0 0110 0v2a2 2 0 012 2v5a2 2 0 01-2 2H5a2 2 0 01-2-2v-5a2 2 0 012-2zm8-2v2H7V7a3 3 0 016 0z" clip-rule="evenodd"></path>
                            </svg>
                            <span class="ml-1 font-mono">barista123</span>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <div class="relative">

        <form method="POST" action="{{ route('login') }}">
        @csrf

        <!-- Email Address -->
        <div>
            <x-input-label for="email" :value="__('Email')" />
            <x-text-input id="email" class="block w-full mt-1" type="email" name="email" :value="old('email')" required autofocus autocomplete="username" />
            <x-input-error :messages="$errors->get('email')" class="mt-2" />
        </div>

        <!-- Password -->
        <div class="mt-4">
            <x-input-label for="password" :value="__('Password')" />

            <x-text-input id="password" class="block w-full mt-1"
                            type="password"
                            name="password"
                            required autocomplete="current-password" />

            <x-input-error :messages="$errors->get('password')" class="mt-2" />
        </div>

        <!-- Remember Me -->
        <div class="block mt-4">
            <label for="remember_me" class="inline-flex items-center">
                <input id="remember_me" type="checkbox" class="text-indigo-600 border-gray-300 rounded shadow-sm dark:bg-gray-900 dark:border-gray-700 focus:ring-indigo-500 dark:focus:ring-indigo-600 dark:focus:ring-offset-gray-800" name="remember">
                <span class="text-sm text-gray-600 ms-2 dark:text-gray-400">{{ __('Remember me') }}</span>
            </label>
        </div>

        <div class="flex items-center justify-between mt-4">
            <div class="flex flex-col space-y-2">
                @if (Route::has('password.request'))
                    <a class="text-sm text-gray-600 underline rounded-md dark:text-gray-400 hover:text-gray-900 dark:hover:text-gray-100 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-indigo-500 dark:focus:ring-offset-gray-800" href="{{ route('password.request') }}">
                        {{ __('Forgot your password?') }}
                    </a>
                @endif

                @if (Route::has('register'))
                    <a class="text-sm text-gray-600 underline rounded-md dark:text-gray-400 hover:text-gray-900 dark:hover:text-gray-100 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-indigo-500 dark:focus:ring-offset-gray-800" href="{{ route('register') }}">
                        Belum punya akun? Daftar disini
                    </a>
                @endif
            </div>

            <x-primary-button class="ms-3">
                {{ __('Log in') }}
            </x-primary-button>
        </div>
    </form>
    </div>

    <!-- SweetAlert2 CDN -->
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>

    <!-- Custom SweetAlert2 Styles -->
    <style>
        /* Dark mode styles for SweetAlert */
        .dark-popup {
            border: 1px solid #4b5563 !important;
        }

        .dark-title {
            color: #f9fafb !important;
        }

        .dark-content {
            color: #d1d5db !important;
        }

        /* Light mode styles for SweetAlert */
        .light-popup {
            border: 1px solid #e5e7eb !important;
        }

        .light-title {
            color: #111827 !important;
        }

        .light-content {
            color: #374151 !important;
        }

        /* Custom button styles */
        .custom-confirm-btn {
            border-radius: 0.375rem !important;
            font-weight: 500 !important;
            padding: 0.5rem 1rem !important;
        }

        /* Timer progress bar styling */
        .swal2-timer-progress-bar {
            background: #10b981 !important;
        }
    </style>

    <script>
        // Check if dark mode is enabled
        function isDarkMode() {
            return document.documentElement.classList.contains('dark');
        }

        // Copy credentials to clipboard and auto-fill form
        function copyCredentials(email, password) {
            // Auto-fill the form
            document.getElementById('email').value = email;
            document.getElementById('password').value = password;

            // Show success message
            const Toast = Swal.mixin({
                toast: true,
                position: 'top-end',
                showConfirmButton: false,
                timer: 2000,
                timerProgressBar: true,
                didOpen: (toast) => {
                    toast.addEventListener('mouseenter', Swal.stopTimer)
                    toast.addEventListener('mouseleave', Swal.resumeTimer)
                }
            });

            Toast.fire({
                icon: 'success',
                title: 'Kredensial berhasil diisi!',
                text: 'Form login sudah terisi otomatis',
                ...getSweetAlertConfig('success')
            });
        }

        // Add click listeners to credential cards
        document.addEventListener('DOMContentLoaded', function() {
            // Get all credential cards
            const credentialCards = document.querySelectorAll('[data-email][data-password]');

            credentialCards.forEach(card => {
                card.addEventListener('click', function() {
                    const email = this.getAttribute('data-email');
                    const password = this.getAttribute('data-password');
                    copyCredentials(email, password);
                });
            });
        });

        // Get SweetAlert theme configuration
        function getSweetAlertConfig(type = 'success') {
            const isDark = isDarkMode();

            const baseConfig = {
                background: isDark ? '#374151' : '#ffffff',
                color: isDark ? '#f9fafb' : '#111827',
                customClass: {
                    popup: isDark ? 'dark-popup' : 'light-popup',
                    title: isDark ? 'dark-title' : 'light-title',
                    content: isDark ? 'dark-content' : 'light-content',
                    confirmButton: 'custom-confirm-btn'
                }
            };

            if (type === 'success') {
                return {
                    ...baseConfig,
                    confirmButtonColor: '#10b981'
                };
            } else if (type === 'error') {
                return {
                    ...baseConfig,
                    confirmButtonColor: '#ef4444'
                };
            }

            return baseConfig;
        }

        // Show success alert if registration was successful
        @if(session('success'))
            document.addEventListener('DOMContentLoaded', function() {
                Swal.fire({
                    title: 'Registrasi Berhasil!',
                    text: '{{ session('success') }}',
                    icon: 'success',
                    timer: 4000,
                    timerProgressBar: true,
                    ...getSweetAlertConfig('success')
                });
            });
        @endif

        // Show error alert if there are login errors
        @if($errors->any())
            document.addEventListener('DOMContentLoaded', function() {
                const errors = @json($errors->all());
                let errorMessage = errors.join('\n');

                Swal.fire({
                    title: 'Login Gagal!',
                    text: errorMessage,
                    icon: 'error',
                    ...getSweetAlertConfig('error')
                });
            });
        @endif
    </script>
</x-guest-layout>
