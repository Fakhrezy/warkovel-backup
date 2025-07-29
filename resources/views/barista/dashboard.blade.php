<x-app-layout>
    <x-slot name="header">
        <h2 class="text-xl font-semibold leading-tight text-gray-800 dark:text-gray-200">
            {{ __('Dashboard Barista') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="mx-auto max-w-7xl sm:px-6 lg:px-8">
            <!-- Statistics Cards -->
            <div class="grid grid-cols-1 gap-6 mb-8 md:grid-cols-2 lg:grid-cols-3">
                <!-- Antrian -->
                <div class="overflow-hidden bg-white shadow-xl dark:bg-gray-800 sm:rounded-lg">
                    <div class="p-6">
                        <div class="flex items-center">
                            <div class="flex-shrink-0">
                                <div class="flex items-center justify-center w-8 h-8 bg-yellow-100 rounded-full dark:bg-yellow-900/30">
                                    <svg class="w-5 h-5 text-yellow-600 dark:text-yellow-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8v4l3 3m6-3a9 9 0 11-18 0 9 9 0 0118 0z"></path>
                                    </svg>
                                </div>
                            </div>
                            <div class="ml-4">
                                <h3 class="text-lg font-medium text-gray-900 dark:text-white">Antrian</h3>
                                <p class="text-2xl font-bold text-yellow-600 dark:text-yellow-400">{{ $antrianOrders->count() }}</p>
                            </div>
                        </div>
                    </div>
                </div>

                <!-- Dalam Proses -->
                <div class="overflow-hidden bg-white shadow-xl dark:bg-gray-800 sm:rounded-lg">
                    <div class="p-6">
                        <div class="flex items-center">
                            <div class="flex-shrink-0">
                                <div class="flex items-center justify-center w-8 h-8 bg-blue-100 rounded-full dark:bg-blue-900/30">
                                    <svg class="w-5 h-5 text-blue-600 dark:text-blue-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13 10V3L4 14h7v7l9-11h-7z"></path>
                                    </svg>
                                </div>
                            </div>
                            <div class="ml-4">
                                <h3 class="text-lg font-medium text-gray-900 dark:text-white">Dalam Proses</h3>
                                <p class="text-2xl font-bold text-blue-600 dark:text-blue-400">{{ $prosesOrders->count() }}</p>
                            </div>
                        </div>
                    </div>
                </div>

                <!-- Selesai Hari Ini -->
                <div class="overflow-hidden bg-white shadow-xl dark:bg-gray-800 sm:rounded-lg">
                    <div class="p-6">
                        <div class="flex items-center">
                            <div class="flex-shrink-0">
                                <div class="flex items-center justify-center w-8 h-8 bg-green-100 rounded-full dark:bg-green-900/30">
                                    <svg class="w-5 h-5 text-green-600 dark:text-green-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7"></path>
                                    </svg>
                                </div>
                            </div>
                            <div class="ml-4">
                                <h3 class="text-lg font-medium text-gray-900 dark:text-white">Selesai Hari Ini</h3>
                                <p class="text-2xl font-bold text-green-600 dark:text-green-400">{{ $completedToday }}</p>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Main Content -->
            <div class="grid grid-cols-1 gap-6 lg:grid-cols-2">
                <!-- Antrian Orders -->
                <div class="overflow-hidden bg-white shadow-xl dark:bg-gray-800 sm:rounded-lg">
                    <div class="p-6">
                        <div class="flex items-center justify-between mb-4">
                            <h3 class="text-lg font-medium text-gray-900 dark:text-white">Antrian Pesanan</h3>
                            <span class="inline-flex items-center px-2.5 py-0.5 rounded-full text-xs font-medium bg-yellow-100 dark:bg-yellow-900/30 text-yellow-800 dark:text-yellow-400">
                                {{ $antrianOrders->count() }} pesanan
                            </span>
                        </div>
                        <div class="space-y-3 overflow-y-auto max-h-96">
                            @forelse($antrianOrders as $order)
                                <div class="p-4 transition-colors border border-gray-200 rounded-lg dark:border-gray-700 hover:bg-gray-50 dark:hover:bg-gray-700">
                                    <div class="flex items-center justify-between">
                                        <div class="flex-1">
                                            <div class="flex items-center space-x-2">
                                                <h4 class="font-medium text-gray-900 dark:text-white">{{ $order->kode_transaksi }}</h4>
                                                <span class="inline-flex items-center px-2 py-1 text-xs font-medium text-yellow-800 bg-yellow-100 rounded-full dark:bg-yellow-900/30 dark:text-yellow-400">
                                                    Antri
                                                </span>
                                            </div>
                                            <p class="mt-1 text-sm text-gray-600 dark:text-gray-400">
                                                {{ $order->created_at->format('H:i') }} • Total: Rp {{ number_format($order->total_transaksi, 0, ',', '.') }}
                                            </p>
                                            <p class="mt-1 text-xs text-gray-500 dark:text-gray-500">
                                                {{ count($order->pesanan) }} item pesanan
                                            </p>
                                        </div>
                                        <div class="flex space-x-2">
                                            <button onclick="startOrder('{{ $order->id }}')"
                                                    class="px-3 py-1 text-sm text-white transition-colors bg-blue-600 rounded dark:bg-blue-700 hover:bg-blue-700 dark:hover:bg-blue-600">
                                                Mulai
                                            </button>
                                        </div>
                                    </div>
                                </div>
                            @empty
                                <div class="py-8 text-center">
                                    <svg class="w-12 h-12 mx-auto mb-4 text-gray-400 dark:text-gray-500" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M20 13V6a2 2 0 00-2-2H6a2 2 0 00-2 2v7m16 0v5a2 2 0 01-2 2H6a2 2 0 01-2-2v-5m16 0h-6a2 2 0 00-2 2v1a2 2 0 01-2 2H8a2 2 0 01-2-2v-1a2 2 0 00-2-2H4"></path>
                                    </svg>
                                    <h3 class="mb-1 text-sm font-medium text-gray-900 dark:text-gray-100">Tidak ada antrian</h3>
                                    <p class="text-sm text-gray-500 dark:text-gray-400">Semua pesanan telah diproses</p>
                                </div>
                            @endforelse
                        </div>
                    </div>
                </div>

                <!-- Dalam Proses Orders -->
                <div class="overflow-hidden bg-white shadow-xl dark:bg-gray-800 sm:rounded-lg">
                    <div class="p-6">
                        <div class="flex items-center justify-between mb-4">
                            <h3 class="text-lg font-medium text-gray-900 dark:text-white">Sedang Diproses</h3>
                            <span class="inline-flex items-center px-2.5 py-0.5 rounded-full text-xs font-medium bg-blue-100 dark:bg-blue-900/30 text-blue-800 dark:text-blue-400">
                                {{ $prosesOrders->count() }} pesanan
                            </span>
                        </div>
                        <div class="space-y-3 overflow-y-auto max-h-96">
                            @forelse($prosesOrders as $order)
                                <div class="p-4 transition-colors border border-gray-200 rounded-lg dark:border-gray-700 hover:bg-gray-50 dark:hover:bg-gray-700">
                                    <div class="flex items-center justify-between">
                                        <div class="flex-1">
                                            <div class="flex items-center space-x-2">
                                                <h4 class="font-medium text-gray-900 dark:text-white">{{ $order->kode_transaksi }}</h4>
                                                <span class="inline-flex items-center px-2 py-1 text-xs font-medium text-blue-800 bg-blue-100 rounded-full dark:bg-blue-900/30 dark:text-blue-400">
                                                    Proses
                                                </span>
                                            </div>
                                            <p class="mt-1 text-sm text-gray-600 dark:text-gray-400">
                                                {{ $order->created_at->format('H:i') }} • Total: Rp {{ number_format($order->total_transaksi, 0, ',', '.') }}
                                            </p>
                                            <p class="mt-1 text-xs text-gray-500 dark:text-gray-500">
                                                {{ count($order->pesanan) }} item pesanan
                                            </p>
                                        </div>
                                        <div class="flex space-x-2">
                                            <button onclick="viewRecipeDetails('{{ $order->id }}')"
                                                    class="text-sm font-medium text-blue-600 dark:text-blue-400 hover:text-blue-800 dark:hover:text-blue-300">
                                                Detail
                                            </button>
                                            <button onclick="completeOrder('{{ $order->id }}')"
                                                    class="px-3 py-1 text-sm text-white transition-colors bg-green-600 rounded dark:bg-green-700 hover:bg-green-700 dark:hover:bg-green-600">
                                                Selesai
                                            </button>
                                        </div>
                                    </div>
                                </div>
                            @empty
                                <div class="py-8 text-center">
                                    <svg class="w-12 h-12 mx-auto mb-4 text-gray-400 dark:text-gray-500" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13 10V3L4 14h7v7l9-11h-7z"></path>
                                    </svg>
                                    <h3 class="mb-1 text-sm font-medium text-gray-900 dark:text-gray-100">Tidak ada yang diproses</h3>
                                    <p class="text-sm text-gray-500 dark:text-gray-400">Ambil pesanan dari antrian</p>
                                </div>
                            @endforelse
                        </div>
                    </div>
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

    <!-- Order Details Modal -->
    <div id="orderModal" class="fixed inset-0 z-50 hidden w-full h-full overflow-y-auto bg-gray-600 bg-opacity-50">
        <div class="relative w-11/12 p-5 mx-auto bg-white border rounded-md shadow-lg top-20 md:w-1/2 lg:w-1/3 dark:bg-gray-800">
            <div class="mt-3">
                <div class="flex items-center justify-between mb-4">
                    <h3 class="text-lg font-medium text-gray-900 dark:text-white">Detail Pesanan</h3>
                    <button onclick="closeModal()" class="text-gray-400 dark:text-gray-500 hover:text-gray-600 dark:hover:text-gray-300">
                        <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12"></path>
                        </svg>
                    </button>
                </div>
                <div id="orderDetails" class="space-y-4">
                    <!-- Details will be loaded here -->
                </div>
            </div>
        </div>
    </div>

    <!-- Recipe Modal -->
    <div id="recipeModal" class="fixed inset-0 z-50 hidden w-full h-full bg-black bg-opacity-30">
        <div class="flex items-center justify-center min-h-screen p-4">
            <div class="relative w-full max-w-md mx-auto transition-all duration-300 transform scale-95 bg-white border rounded-lg shadow-2xl opacity-0 dark:bg-gray-800" id="recipeModalContent">
                <div class="p-4">
                    <div class="flex items-center justify-between mb-3">
                        <div class="flex items-center space-x-2">
                            <svg class="w-5 h-5 text-gray-600 dark:text-gray-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19.428 15.428a2 2 0 00-1.022-.547l-2.387-.477a6 6 0 00-3.86.517l-.318.158a6 6 0 01-3.86.517L6.05 15.21a2 2 0 00-1.806.547M8 4h8l-1 1v5.172a2 2 0 00.586 1.414l5 5c1.26 1.26.367 3.414-1.415 3.414H4.828c-1.782 0-2.674-2.154-1.414-3.414l5-5A2 2 0 009 10.172V5L8 4z"></path>
                            </svg>
                            <h3 class="text-lg font-semibold text-gray-900 dark:text-white">Detail Resep</h3>
                        </div>
                        <button onclick="closeRecipeModal()" class="text-gray-400 transition-colors dark:text-gray-500 hover:text-gray-600 dark:hover:text-gray-300">
                            <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12"></path>
                            </svg>
                        </button>
                    </div>
                    <div id="recipeDetails" class="space-y-3 overflow-y-auto max-h-96">
                        <!-- Recipe details will be loaded here -->
                    </div>
                    <div class="flex justify-end pt-3 mt-4 border-t border-gray-200 dark:border-gray-700">
                        <button onclick="closeRecipeModal()"
                                class="px-4 py-2 text-sm text-gray-700 transition-colors bg-gray-100 rounded-md dark:bg-gray-700 dark:text-gray-300 hover:bg-gray-200 dark:hover:bg-gray-600">
                            Tutup
                        </button>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- JavaScript -->
    <script>
        // Update time every second
        function updateTime() {
            const now = new Date();
            document.getElementById('current-time').textContent = now.toLocaleTimeString('id-ID');
        }
        setInterval(updateTime, 1000);

        // CSRF Token
        const csrfToken = document.querySelector('meta[name="csrf-token"]').getAttribute('content');

        // Check if dark mode is enabled
        function isDarkMode() {
            return document.documentElement.classList.contains('dark');
        }

        // Get SweetAlert theme configuration
        function getSweetAlertConfig(type = 'confirm') {
            const isDark = isDarkMode();

            const baseConfig = {
                background: isDark ? '#374151' : '#ffffff',
                color: isDark ? '#f9fafb' : '#111827',
                customClass: {
                    popup: isDark ? 'dark-popup' : 'light-popup',
                    title: isDark ? 'dark-title' : 'light-title',
                    content: isDark ? 'dark-content' : 'light-content',
                    confirmButton: 'custom-confirm-btn',
                    cancelButton: 'custom-cancel-btn'
                }
            };

            if (type === 'confirm') {
                return {
                    ...baseConfig,
                    confirmButtonColor: '#10b981',
                    cancelButtonColor: isDark ? '#6b7280' : '#9ca3af'
                };
            } else if (type === 'success') {
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

        // Start Order
        async function startOrder(orderId) {
            try {
                const response = await fetch(`/barista/orders/${orderId}/start`, {
                    method: 'POST',
                    headers: {
                        'Content-Type': 'application/json',
                        'X-CSRF-TOKEN': csrfToken
                    }
                });

                const data = await response.json();

                if (data.success) {
                    showToast('Order berhasil dimulai!', 'success');

                    // Show recipe details if available
                    if (data.resep_detail && data.resep_detail.length > 0) {
                        showRecipeModal(data.resep_detail, data.kode_transaksi);
                    } else {
                        // Only reload if no recipe modal is shown
                        setTimeout(() => location.reload(), 1500);
                    }
                } else {
                    showToast(data.message || 'Gagal memulai order', 'error');
                }
            } catch (error) {
                showToast('Terjadi kesalahan', 'error');
                console.error('Error:', error);
            }
        }

        // Complete Order
        async function completeOrder(orderId) {
            const result = await Swal.fire({
                title: 'Konfirmasi Penyelesaian',
                text: 'Tandai pesanan ini sebagai selesai?',
                icon: 'question',
                showCancelButton: true,
                confirmButtonText: 'Ya, Selesai!',
                cancelButtonText: 'Batal',
                reverseButtons: true,
                ...getSweetAlertConfig('confirm')
            });

            if (!result.isConfirmed) return;

            try {
                const response = await fetch(`/barista/orders/${orderId}/complete`, {
                    method: 'POST',
                    headers: {
                        'Content-Type': 'application/json',
                        'X-CSRF-TOKEN': csrfToken
                    }
                });

                const data = await response.json();

                if (data.success) {
                    await Swal.fire({
                        title: 'Berhasil!',
                        text: 'Order berhasil diselesaikan!',
                        icon: 'success',
                        timer: 2000,
                        timerProgressBar: true,
                        ...getSweetAlertConfig('success')
                    });
                    setTimeout(() => location.reload(), 1000);
                } else {
                    await Swal.fire({
                        title: 'Gagal!',
                        text: data.message || 'Gagal menyelesaikan order',
                        icon: 'error',
                        ...getSweetAlertConfig('error')
                    });
                }
            } catch (error) {
                await Swal.fire({
                    title: 'Error!',
                    text: 'Terjadi kesalahan sistem',
                    icon: 'error',
                    ...getSweetAlertConfig('error')
                });
                console.error('Error:', error);
            }
        }

        // View Order Details
        async function viewOrderDetails(orderId) {
            try {
                const response = await fetch(`/barista/orders/${orderId}/details`);
                const data = await response.json();

                if (data.success) {
                    const order = data.data;
                    document.getElementById('orderDetails').innerHTML = `
                        <div class="pb-4 border-b border-gray-200 dark:border-gray-700">
                            <h4 class="font-medium text-gray-900 dark:text-white">${order.kode_transaksi}</h4>
                            <p class="text-sm text-gray-600 dark:text-gray-400">${order.created_at}</p>
                        </div>
                        <div class="space-y-3">
                            <h5 class="font-medium text-gray-900 dark:text-white">Item Pesanan:</h5>
                            ${order.pesanan.map(item => `
                                <div class="flex items-center justify-between p-3 rounded bg-gray-50 dark:bg-gray-700">
                                    <div>
                                        <p class="font-medium text-gray-900 dark:text-white">${item.nama}</p>
                                        <p class="text-sm text-gray-600 dark:text-gray-400">Qty: ${item.quantity}</p>
                                    </div>
                                    <p class="font-medium text-gray-900 dark:text-white">Rp ${parseInt(item.harga).toLocaleString('id-ID')}</p>
                                </div>
                            `).join('')}
                        </div>
                        <div class="pt-4 border-t border-gray-200 dark:border-gray-700">
                            <div class="flex items-center justify-between">
                                <span class="font-medium text-gray-900 dark:text-white">Total:</span>
                                <span class="text-lg font-bold text-gray-900 dark:text-white">Rp ${parseInt(order.total_harga).toLocaleString('id-ID')}</span>
                            </div>
                        </div>
                    `;
                    document.getElementById('orderModal').classList.remove('hidden');
                }
            } catch (error) {
                showToast('Gagal memuat detail pesanan', 'error');
                console.error('Error:', error);
            }
        }

        // View Recipe Details for orders in process
        async function viewRecipeDetails(orderId) {
            try {
                const response = await fetch(`/barista/orders/${orderId}/details`);
                const data = await response.json();

                if (data.success) {
                    const order = data.data;
                    console.log('Order data:', order); // Debug log

                    // Create recipe details from order data with better error handling
                    const resepDetails = order.pesanan.map(item => {
                        console.log('Processing item:', item); // Debug log
                        return {
                            nama_menu: item.nama || 'Nama tidak tersedia',
                            quantity: item.jumlah || 1,
                            kategori: item.kategori || 'Menu',
                            harga: item.harga || 0,
                            resep: item.resep || 'Resep tidak tersedia untuk item ini'
                        };
                    });

                    console.log('Recipe details:', resepDetails); // Debug log

                    // Show recipe modal
                    showRecipeModal(resepDetails, order.kode_transaksi);
                } else {
                    showToast('Gagal memuat data pesanan', 'error');
                }
            } catch (error) {
                showToast('Gagal memuat detail resep', 'error');
                console.error('Error:', error);
            }
        }

        // Close Modal
        function closeModal() {
            document.getElementById('orderModal').classList.add('hidden');
        }

        // Show Recipe Modal
        function showRecipeModal(resepDetails, kodeTransaksi) {
            console.log('Showing modal with:', resepDetails, kodeTransaksi); // Debug log

            const recipeContainer = document.getElementById('recipeDetails');
            recipeContainer.innerHTML = `
                <div class="p-3 mb-3 border border-blue-200 rounded-lg bg-blue-50 dark:bg-blue-900/20 dark:border-blue-800">
                    <div class="flex items-center mb-1 space-x-2">
                        <svg class="w-4 h-4 text-blue-600 dark:text-blue-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12h6m-6 4h6m2 5H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z"></path>
                        </svg>
                        <h4 class="text-sm font-semibold text-blue-900 dark:text-blue-200">${kodeTransaksi || 'Kode tidak tersedia'}</h4>
                    </div>
                    <p class="text-xs text-blue-700 dark:text-blue-300">Pesanan siap diproses</p>
                </div>
                ${(resepDetails || []).map((item, index) => `
                    <div class="p-3 mb-2 border border-gray-200 rounded-lg dark:border-gray-700 bg-gray-50 dark:bg-gray-700">
                        <div class="mb-2">
                            <h5 class="text-sm font-semibold text-gray-900 dark:text-white">${item.nama_menu || 'Nama menu tidak tersedia'}</h5>
                            <p class="text-xs text-gray-600 dark:text-gray-400">
                                Qty: ${item.quantity || 1} • ${item.kategori || 'Menu'}
                            </p>
                        </div>
                        <div class="p-2 bg-white border border-gray-200 rounded dark:bg-gray-800 dark:border-gray-600">
                            <div class="mb-1">
                                <h6 class="text-xs font-medium text-gray-900 dark:text-white">Resep:</h6>
                            </div>
                            <div class="text-xs leading-relaxed text-gray-700 whitespace-pre-line dark:text-gray-300">${item.resep || 'Resep tidak tersedia'}</div>
                        </div>
                    </div>
                `).join('')}
                <div class="p-2 mt-2 border border-green-200 rounded-lg bg-green-50 dark:bg-green-900/20 dark:border-green-800">
                    <div class="flex items-start space-x-1">
                        <svg class="w-3 h-3 text-green-600 dark:text-green-400 mt-0.5 flex-shrink-0" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7"></path>
                        </svg>
                        <p class="text-xs text-green-700 dark:text-green-300">
                            Setelah selesai, klik "Selesai" di panel "Sedang Diproses"
                        </p>
                    </div>
                </div>
            `;

            // Show modal with animation
            const modal = document.getElementById('recipeModal');
            const modalContent = document.getElementById('recipeModalContent');
            modal.classList.remove('hidden');

            // Trigger animation
            setTimeout(() => {
                modalContent.classList.remove('scale-95', 'opacity-0');
                modalContent.classList.add('scale-100', 'opacity-100');
            }, 10);
        }

        // Close Recipe Modal
        function closeRecipeModal() {
            const modal = document.getElementById('recipeModal');
            const modalContent = document.getElementById('recipeModalContent');

            // Animate out
            modalContent.classList.remove('scale-100', 'opacity-100');
            modalContent.classList.add('scale-95', 'opacity-0');

            // Hide modal after animation
            setTimeout(() => {
                modal.classList.add('hidden');
                // Reload page to update order status after recipe modal is closed
                setTimeout(() => location.reload(), 300);
            }, 150);
        }

        // Toast Notification
        function showToast(message, type = 'info') {
            const toast = document.createElement('div');
            toast.className = `fixed top-4 right-4 p-4 rounded-md shadow-lg z-50 ${
                type === 'success' ? 'bg-green-500' :
                type === 'error' ? 'bg-red-500' : 'bg-blue-500'
            } text-white`;
            toast.textContent = message;
            document.body.appendChild(toast);

            setTimeout(() => {
                toast.remove();
            }, 3000);
        }

        // Close modal when clicking outside
        document.getElementById('orderModal').addEventListener('click', function(e) {
            if (e.target === this) {
                closeModal();
            }
        });

        // Close recipe modal when clicking outside
        document.getElementById('recipeModal').addEventListener('click', function(e) {
            if (e.target === this) {
                closeRecipeModal();
            }
        });

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
