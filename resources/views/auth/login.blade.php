<x-guest-layout>
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
