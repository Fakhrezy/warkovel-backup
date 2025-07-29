<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 dark:text-gray-200 leading-tight">
            {{ __('Dashboard') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white dark:bg-gray-800 overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 text-gray-900 dark:text-gray-100">
                    {{ __("You're logged in!") }}
                </div>
            </div>
        </div>
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

        // Show login success alert if user just logged in
        @if(session('login_success'))
            document.addEventListener('DOMContentLoaded', function() {
                Swal.fire({
                    title: 'Login Berhasil!',
                    text: '{{ session('login_success') }}',
                    icon: 'success',
                    timer: 3000,
                    timerProgressBar: true,
                    showConfirmButton: false,
                    ...getSweetAlertConfig('success')
                });
            });
        @endif
    </script>
</x-app-layout>
