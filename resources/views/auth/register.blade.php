<x-guest-layout>
    <div class="mb-4 text-center">
        <h2 class="text-2xl font-bold text-gray-900 dark:text-gray-100">Registrasi Karyawan</h2>
        <p class="text-sm text-gray-600 dark:text-gray-400 mt-2">Silakan lengkapi data untuk mendaftar sebagai karyawan</p>
    </div>

    <form method="POST" action="{{ route('register') }}" class="space-y-4" id="registrationForm">
        @csrf

        <!-- Nama -->
        <div>
            <x-input-label for="nama" value="Nama Lengkap" />
            <x-text-input id="nama" class="block mt-1 w-full" type="text" name="nama" :value="old('nama')" required autofocus autocomplete="name" placeholder="Masukkan nama lengkap" />
            <x-input-error :messages="$errors->get('nama')" class="mt-2" />
        </div>

        <!-- Umur -->
        <div>
            <x-input-label for="umur" value="Umur" />
            <x-text-input id="umur" class="block mt-1 w-full" type="number" name="umur" :value="old('umur')" required min="17" max="65" placeholder="Masukkan umur (17-65 tahun)" />
            <x-input-error :messages="$errors->get('umur')" class="mt-2" />
        </div>

        <!-- Jenis Kelamin -->
        <div>
            <x-input-label for="jenis_kelamin" value="Jenis Kelamin" />
            <select id="jenis_kelamin" name="jenis_kelamin" class="block mt-1 w-full border-gray-300 dark:border-gray-700 dark:bg-gray-900 dark:text-gray-300 focus:border-indigo-500 dark:focus:border-indigo-600 focus:ring-indigo-500 dark:focus:ring-indigo-600 rounded-md shadow-sm" required>
                <option value="">Pilih Jenis Kelamin</option>
                <option value="Laki-laki" {{ old('jenis_kelamin') == 'Laki-laki' ? 'selected' : '' }}>Laki-laki</option>
                <option value="Perempuan" {{ old('jenis_kelamin') == 'Perempuan' ? 'selected' : '' }}>Perempuan</option>
            </select>
            <x-input-error :messages="$errors->get('jenis_kelamin')" class="mt-2" />
        </div>

        <!-- Posisi -->
        <div>
            <x-input-label for="posisi" value="Posisi" />
            <select id="posisi" name="posisi" class="block mt-1 w-full border-gray-300 dark:border-gray-700 dark:bg-gray-900 dark:text-gray-300 focus:border-indigo-500 dark:focus:border-indigo-600 focus:ring-indigo-500 dark:focus:ring-indigo-600 rounded-md shadow-sm" required>
                <option value="">Pilih Posisi</option>
                <option value="barista" {{ old('posisi') == 'barista' ? 'selected' : '' }}>Barista</option>
                <option value="kasir" {{ old('posisi') == 'kasir' ? 'selected' : '' }}>Kasir</option>
                <option value="staff" {{ old('posisi') == 'staff' ? 'selected' : '' }}>Staff</option>
            </select>
            <x-input-error :messages="$errors->get('posisi')" class="mt-2" />
            <p class="text-xs text-gray-500 dark:text-gray-400 mt-1">
                <span id="posisi-description">Pilih posisi sesuai dengan pekerjaan yang akan dilakukan</span>
            </p>
        </div>

        <!-- Alamat -->
        <div>
            <x-input-label for="alamat" value="Alamat" />
            <textarea id="alamat" name="alamat" rows="3" class="block mt-1 w-full border-gray-300 dark:border-gray-700 dark:bg-gray-900 dark:text-gray-300 focus:border-indigo-500 dark:focus:border-indigo-600 focus:ring-indigo-500 dark:focus:ring-indigo-600 rounded-md shadow-sm" required placeholder="Masukkan alamat lengkap">{{ old('alamat') }}</textarea>
            <x-input-error :messages="$errors->get('alamat')" class="mt-2" />
        </div>

        <!-- Gaji -->
        <div>
            <x-input-label for="gaji" value="Gaji yang Diharapkan" />
            <div class="relative">
                <span class="absolute inset-y-0 left-0 pl-3 flex items-center text-gray-500">Rp</span>
                <x-text-input id="gaji" class="block mt-1 w-full pl-8" type="number" name="gaji" :value="old('gaji')" required min="3000000" placeholder="3000000" />
            </div>
            <x-input-error :messages="$errors->get('gaji')" class="mt-2" />
            <p class="text-xs text-gray-500 dark:text-gray-400 mt-1">Masukkan gaji yang diharapkan (minimal Rp 3.000.000)</p>
        </div>

        <div class="border-t border-gray-200 dark:border-gray-700 pt-4 mt-6">
            <h3 class="text-lg font-medium text-gray-900 dark:text-gray-100 mb-4">Informasi Akun</h3>

            <!-- Email Address -->
            <div class="mb-4">
                <x-input-label for="email" value="Email" />
                <x-text-input id="email" class="block mt-1 w-full" type="email" name="email" :value="old('email')" required autocomplete="username" placeholder="Masukkan alamat email" />
                <x-input-error :messages="$errors->get('email')" class="mt-2" />
                <p class="text-xs text-gray-500 dark:text-gray-400 mt-1">Email akan digunakan untuk login ke sistem</p>
            </div>

            <!-- Password -->
            <div class="mb-4">
                <x-input-label for="password" value="Password" />
                <div class="relative">
                    <x-text-input id="password" class="block mt-1 w-full pr-10"
                                    type="password"
                                    name="password"
                                    required autocomplete="new-password"
                                    placeholder="Masukkan password" />
                    <button type="button" id="togglePassword" class="absolute inset-y-0 right-0 pr-3 flex items-center">
                        <svg id="eyeIcon" class="w-5 h-5 text-gray-400 hover:text-gray-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 12a3 3 0 11-6 0 3 3 0 016 0z"></path>
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M2.458 12C3.732 7.943 7.523 5 12 5c4.478 0 8.268 2.943 9.542 7-1.274 4.057-5.064 7-9.542 7-4.477 0-8.268-2.943-9.542-7z"></path>
                        </svg>
                    </button>
                </div>
                <x-input-error :messages="$errors->get('password')" class="mt-2" />
                <div class="text-xs text-gray-500 dark:text-gray-400 mt-1">
                    <div id="password-requirements">
                        <p>Password harus memenuhi:</p>
                        <ul class="list-disc list-inside mt-1 space-y-1">
                            <li id="length-req" class="text-red-500">Minimal 8 karakter</li>
                            <li id="letter-req" class="text-red-500">Mengandung huruf</li>
                            <li id="number-req" class="text-red-500">Mengandung angka</li>
                        </ul>
                    </div>
                </div>
            </div>

            <!-- Confirm Password -->
            <div class="mb-4">
                <x-input-label for="password_confirmation" value="Konfirmasi Password" />
                <x-text-input id="password_confirmation" class="block mt-1 w-full"
                                type="password"
                                name="password_confirmation" required autocomplete="new-password"
                                placeholder="Ulangi password" />
                <x-input-error :messages="$errors->get('password_confirmation')" class="mt-2" />
                <div id="password-match" class="text-xs mt-1 hidden">
                    <span id="match-message"></span>
                </div>
            </div>
        </div>

        <div class="flex items-center justify-between pt-4">
            <a class="underline text-sm text-gray-600 dark:text-gray-400 hover:text-gray-900 dark:hover:text-gray-100 rounded-md focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-indigo-500 dark:focus:ring-offset-gray-800" href="{{ route('login') }}">
                Sudah punya akun? Login
            </a>

            <x-primary-button class="ms-4" id="submitButton">
                <span id="submitText">Daftar Sebagai Karyawan</span>
                <svg id="loadingIcon" class="hidden animate-spin -mr-1 ml-3 h-5 w-5 text-white" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24">
                    <circle class="opacity-25" cx="12" cy="12" r="10" stroke="currentColor" stroke-width="4"></circle>
                    <path class="opacity-75" fill="currentColor" d="M4 12a8 8 0 018-8V0C5.373 0 0 5.373 0 12h4zm2 5.291A7.962 7.962 0 014 12H0c0 3.042 1.135 5.824 3 7.938l3-2.647z"></path>
                </svg>
            </x-primary-button>
        </div>
    </form>

    <script>
        document.addEventListener('DOMContentLoaded', function() {
            // Toggle password visibility
            const togglePassword = document.getElementById('togglePassword');
            const passwordField = document.getElementById('password');
            const eyeIcon = document.getElementById('eyeIcon');

            togglePassword.addEventListener('click', function() {
                const type = passwordField.getAttribute('type') === 'password' ? 'text' : 'password';
                passwordField.setAttribute('type', type);

                if (type === 'password') {
                    eyeIcon.innerHTML = `
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 12a3 3 0 11-6 0 3 3 0 016 0z"></path>
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M2.458 12C3.732 7.943 7.523 5 12 5c4.478 0 8.268 2.943 9.542 7-1.274 4.057-5.064 7-9.542 7-4.477 0-8.268-2.943-9.542-7z"></path>
                    `;
                } else {
                    eyeIcon.innerHTML = `
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13.875 18.825A10.05 10.05 0 0112 19c-4.478 0-8.268-2.943-9.543-7a9.97 9.97 0 011.563-3.029m5.858.908a3 3 0 114.243 4.243M9.878 9.878l4.242 4.242M9.878 9.878L3 3m6.878 6.878L21 21"></path>
                    `;
                }
            });

            // Position description
            const posisiSelect = document.getElementById('posisi');
            const posisiDescription = document.getElementById('posisi-description');

            const descriptions = {
                'barista': 'Bertanggung jawab membuat dan menyajikan kopi dan minuman lainnya',
                'kasir': 'Menangani transaksi pembayaran dan melayani pelanggan di kasir',
                'staff': 'Membantu operasional umum cafe dan tugas-tugas pendukung lainnya'
            };

            posisiSelect.addEventListener('change', function() {
                const selectedValue = this.value;
                if (descriptions[selectedValue]) {
                    posisiDescription.textContent = descriptions[selectedValue];
                } else {
                    posisiDescription.textContent = 'Pilih posisi sesuai dengan pekerjaan yang akan dilakukan';
                }
            });

            // Password validation
            const passwordInput = document.getElementById('password');
            const confirmPasswordInput = document.getElementById('password_confirmation');
            const lengthReq = document.getElementById('length-req');
            const letterReq = document.getElementById('letter-req');
            const numberReq = document.getElementById('number-req');
            const passwordMatch = document.getElementById('password-match');
            const matchMessage = document.getElementById('match-message');

            function validatePassword() {
                const password = passwordInput.value;

                // Length requirement
                if (password.length >= 8) {
                    lengthReq.className = 'text-green-500';
                } else {
                    lengthReq.className = 'text-red-500';
                }

                // Letter requirement
                if (/[a-zA-Z]/.test(password)) {
                    letterReq.className = 'text-green-500';
                } else {
                    letterReq.className = 'text-red-500';
                }

                // Number requirement
                if (/\d/.test(password)) {
                    numberReq.className = 'text-green-500';
                } else {
                    numberReq.className = 'text-red-500';
                }
            }

            function checkPasswordMatch() {
                const password = passwordInput.value;
                const confirmPassword = confirmPasswordInput.value;

                if (confirmPassword.length > 0) {
                    passwordMatch.classList.remove('hidden');
                    if (password === confirmPassword) {
                        matchMessage.textContent = 'Password cocok';
                        matchMessage.className = 'text-green-500';
                    } else {
                        matchMessage.textContent = 'Password tidak cocok';
                        matchMessage.className = 'text-red-500';
                    }
                } else {
                    passwordMatch.classList.add('hidden');
                }
            }

            passwordInput.addEventListener('input', validatePassword);
            passwordInput.addEventListener('input', checkPasswordMatch);
            confirmPasswordInput.addEventListener('input', checkPasswordMatch);

            // Form submission
            const form = document.getElementById('registrationForm');
            const submitButton = document.getElementById('submitButton');
            const submitText = document.getElementById('submitText');
            const loadingIcon = document.getElementById('loadingIcon');

            form.addEventListener('submit', function() {
                submitButton.disabled = true;
                submitText.textContent = 'Sedang memproses...';
                loadingIcon.classList.remove('hidden');
            });
        });
    </script>

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

        .custom-cancel-btn {
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
        function getSweetAlertConfig(type = 'error') {
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

        // Show error alert if there are validation errors
        @if($errors->any())
            document.addEventListener('DOMContentLoaded', function() {
                const errors = @json($errors->all());
                let errorList = '<ul class="text-left text-sm">';
                errors.forEach(error => {
                    errorList += `<li class="mb-1">• ${error}</li>`;
                });
                errorList += '</ul>';

                Swal.fire({
                    title: 'Registrasi Gagal!',
                    html: `<div class="mb-3">Terdapat beberapa kesalahan:</div>${errorList}`,
                    icon: 'error',
                    ...getSweetAlertConfig('error')
                });
            });
        @endif
    </script>
</x-guest-layout>
