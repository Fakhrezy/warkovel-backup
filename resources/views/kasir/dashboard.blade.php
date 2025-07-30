<x-app-layout>
    <x-slot name="header">
        <h2 class="text-xl font-semibold leading-tight text-gray-800 dark:text-gray-200">
            {{ __('Dashboard Kasir - Point of Sale') }}
        </h2>
    </x-slot>

    <div class="py-6">
        <div class="mx-auto max-w-7xl sm:px-6 lg:px-8">
            <div class="grid grid-cols-1 gap-6 lg:grid-cols-3">
                <!-- Menu Section -->
                <div class="lg:col-span-2">
                    <!-- Quick Stats -->
                    <div class="grid grid-cols-1 gap-4 mb-6 md:grid-cols-3">
                        <div class="p-4 bg-white border border-gray-200 rounded-lg shadow-sm dark:bg-gray-800 dark:border-gray-700">
                            <div class="flex items-center">
                                <div class="flex items-center justify-center w-8 h-8 mr-3 bg-blue-100 rounded-lg dark:bg-blue-900/30">
                                    <svg class="w-5 h-5 text-blue-600 dark:text-blue-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5H7a2 2 0 00-2 2v10a2 2 0 002 2h8a2 2 0 002-2V7a2 2 0 00-2-2h-2M9 5a2 2 0 002 2h2a2 2 0 002-2M9 5a2 2 0 012-2h2a2 2 0 012 2"></path>
                                    </svg>
                                </div>
                                <div>
                                    <p class="text-lg font-semibold text-gray-900 dark:text-gray-100">{{ $totalTransaksiHari }}</p>
                                    <p class="text-sm text-gray-500 dark:text-gray-400">Transaksi Hari Ini</p>
                                </div>
                            </div>
                        </div>
                        <div class="p-4 bg-white border border-gray-200 rounded-lg shadow-sm dark:bg-gray-800 dark:border-gray-700">
                            <div class="flex items-center">
                                <div class="flex items-center justify-center w-8 h-8 mr-3 bg-green-100 rounded-lg dark:bg-green-900/30">
                                    <svg class="w-5 h-5 text-green-600 dark:text-green-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8c-1.657 0-3 .895-3 2s1.343 2 3 2 3 .895 3 2-1.343 2-3 2m0-8c1.11 0 2.08.402 2.599 1M12 8V7m0 1v8m0 0v1m0-1c-1.11 0-2.08-.402-2.599-1"></path>
                                    </svg>
                                </div>
                                <div>
                                    <p class="text-lg font-semibold text-gray-900 dark:text-gray-100">Rp {{ number_format($totalPendapatanHari, 0, ',', '.') }}</p>
                                    <p class="text-sm text-gray-500 dark:text-gray-400">Pendapatan Hari Ini</p>
                                </div>
                            </div>
                        </div>
                        <div class="p-4 bg-white border border-gray-200 rounded-lg shadow-sm dark:bg-gray-800 dark:border-gray-700">
                            <div class="flex items-center">
                                <div class="flex items-center justify-center w-8 h-8 mr-3 bg-orange-100 rounded-lg dark:bg-orange-900/30">
                                    <svg class="w-5 h-5 text-orange-600 dark:text-orange-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 6h16M4 10h16M4 14h16M4 18h16"></path>
                                    </svg>
                                </div>
                                <div>
                                    <p class="text-lg font-semibold text-gray-900 dark:text-gray-100">{{ $menuTersedia->count() }}</p>
                                    <p class="text-sm text-gray-500 dark:text-gray-400">Menu Tersedia</p>
                                </div>
                            </div>
                        </div>
                    </div>

                    <!-- Menu Categories -->
                    <div class="p-6 bg-white border border-gray-200 rounded-lg shadow-sm dark:bg-gray-800 dark:border-gray-700">
                        <h3 class="mb-4 text-lg font-semibold text-gray-900 dark:text-gray-100">Menu Items</h3>

                        <!-- Category Tabs -->
                        <div class="mb-4 border-b border-gray-200 dark:border-gray-700">
                            <nav class="flex -mb-px space-x-8">
                                <button onclick="showCategory('makanan')" id="tab-makanan" class="px-1 py-2 text-sm font-medium border-b-2 category-tab active-tab">
                                    Makanan ({{ $menuMakanan->count() }})
                                </button>
                                <button onclick="showCategory('minuman')" id="tab-minuman" class="px-1 py-2 text-sm font-medium border-b-2 category-tab">
                                    Minuman ({{ $menuMinuman->count() }})
                                </button>
                            </nav>
                        </div>

                        <!-- Makanan Menu -->
                        <div id="category-makanan" class="category-content">
                            <div class="grid grid-cols-1 gap-4 sm:grid-cols-2 xl:grid-cols-3">
                                @foreach($menuMakanan as $menu)
                                <div class="p-4 transition-shadow duration-200 rounded-lg bg-gray-50 dark:bg-gray-700 hover:shadow-md">
                                    @if($menu->gambar)
                                    <div class="w-full h-32 mb-3 overflow-hidden bg-gray-200 rounded-lg dark:bg-gray-600">
                                        <img src="{{ asset('storage/' . $menu->gambar) }}" alt="{{ $menu->nama }}" class="object-cover w-full h-full">
                                    </div>
                                    @else
                                    <div class="flex items-center justify-center w-full h-32 mb-3 bg-gray-200 rounded-lg dark:bg-gray-600">
                                        <svg class="w-12 h-12 text-gray-400 dark:text-gray-500" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 16l4.586-4.586a2 2 0 012.828 0L16 16m-2-2l1.586-1.586a2 2 0 012.828 0L20 14m-6-6h.01M6 20h12a2 2 0 002-2V6a2 2 0 00-2-2H6a2 2 0 00-2 2v12a2 2 0 002 2z"></path>
                                        </svg>
                                    </div>
                                    @endif
                                    <h4 class="mb-1 font-semibold text-gray-900 dark:text-gray-100">{{ $menu->nama }}</h4>
                                    <p class="mb-3 text-lg font-bold text-green-600 dark:text-green-400">Rp {{ number_format($menu->harga, 0, ',', '.') }}</p>
                                    <button onclick="addToCart({{ $menu->id }}, '{{ $menu->nama }}', {{ $menu->harga }})"
                                            class="w-full px-4 py-2 text-sm font-medium text-white transition-colors duration-200 bg-blue-600 rounded-lg dark:bg-blue-700 hover:bg-blue-700 dark:hover:bg-blue-600">
                                        Tambah ke Keranjang
                                    </button>
                                </div>
                                @endforeach
                            </div>
                        </div>

                        <!-- Minuman Menu -->
                        <div id="category-minuman" class="hidden category-content">
                            <div class="grid grid-cols-1 gap-4 sm:grid-cols-2 xl:grid-cols-3">
                                @foreach($menuMinuman as $menu)
                                <div class="p-4 transition-shadow duration-200 rounded-lg bg-gray-50 dark:bg-gray-700 hover:shadow-md">
                                    @if($menu->gambar)
                                    <div class="w-full h-32 mb-3 overflow-hidden bg-gray-200 rounded-lg dark:bg-gray-600">
                                        <img src="{{ asset('storage/' . $menu->gambar) }}" alt="{{ $menu->nama }}" class="object-cover w-full h-full">
                                    </div>
                                    @else
                                    <div class="flex items-center justify-center w-full h-32 mb-3 bg-gray-200 rounded-lg dark:bg-gray-600">
                                        <svg class="w-12 h-12 text-gray-400 dark:text-gray-500" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 16l4.586-4.586a2 2 0 012.828 0L16 16m-2-2l1.586-1.586a2 2 0 012.828 0L20 14m-6-6h.01M6 20h12a2 2 0 002-2V6a2 2 0 00-2-2H6a2 2 0 00-2 2v12a2 2 0 002 2z"></path>
                                        </svg>
                                    </div>
                                    @endif
                                    <h4 class="mb-1 font-semibold text-gray-900 dark:text-gray-100">{{ $menu->nama }}</h4>
                                    <p class="mb-3 text-lg font-bold text-green-600 dark:text-green-400">Rp {{ number_format($menu->harga, 0, ',', '.') }}</p>
                                    <button onclick="addToCart({{ $menu->id }}, '{{ $menu->nama }}', {{ $menu->harga }})"
                                            class="w-full px-4 py-2 text-sm font-medium text-white transition-colors duration-200 bg-blue-600 rounded-lg dark:bg-blue-700 hover:bg-blue-700 dark:hover:bg-blue-600">
                                        Tambah ke Keranjang
                                    </button>
                                </div>
                                @endforeach
                            </div>
                        </div>
                    </div>
                </div>

                <!-- Cart Section -->
                    <div class="lg:col-span-1">
                    <div class="sticky p-6 bg-white border border-gray-200 rounded-lg shadow-sm dark:bg-gray-800 dark:border-gray-700 top-6">
                        <div class="flex items-center justify-between mb-4">
                            <h3 class="text-lg font-semibold text-gray-900 dark:text-gray-100">Keranjang</h3>
                            <span id="cart-count" class="bg-blue-100 dark:bg-blue-900/30 text-blue-800 dark:text-blue-300 text-xs font-medium px-2.5 py-0.5 rounded-full">0</span>
                        </div>

                        <div id="cart-items" class="mb-4 space-y-3 overflow-y-auto max-h-64">
                            <div id="empty-cart" class="py-8 text-center">
                                <svg class="w-16 h-16 mx-auto mb-4 text-gray-300 dark:text-gray-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 3h2l.4 2M7 13h10l4-8H5.4m0 0L7 13m0 0l-2.293 2.293c-.63.63-.184 1.707.707 1.707H17M17 13v6a2 2 0 01-2 2H9a2 2 0 01-2-2v-6.28"></path>
                                </svg>
                                <p class="text-gray-500 dark:text-gray-400">Keranjang kosong</p>
                            </div>
                        </div>

                        <!-- Customer Name Input -->
                        <div class="mb-4">
                            <label for="customer-name" class="block mb-2 text-sm font-medium text-gray-700 dark:text-gray-300">
                                Nama Pelanggan (Opsional)
                            </label>
                            <div class="relative">
                                <div class="absolute inset-y-0 left-0 flex items-center pl-3 pointer-events-none">
                                    <svg class="w-5 h-5 text-gray-400 dark:text-gray-500" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M16 7a4 4 0 11-8 0 4 4 0 018 0zM12 14a7 7 0 00-7 7h14a7 7 0 00-7-7z"></path>
                                    </svg>
                                </div>
                                <input type="text" id="customer-name" placeholder="Masukkan nama pelanggan..."
                                       class="w-full py-2 pl-10 pr-3 text-sm text-gray-900 placeholder-gray-500 bg-white border border-gray-300 rounded-lg dark:border-gray-600 dark:bg-gray-700 dark:text-gray-100 dark:placeholder-gray-400 focus:outline-none focus:ring-2 focus:ring-blue-500 focus:border-blue-500 dark:focus:ring-blue-600 dark:focus:border-blue-600">
                            </div>
                            
                        </div>

                        <div class="pt-4 border-t border-gray-200 dark:border-gray-700">
                            <div class="flex items-center justify-between mb-4">
                                <span class="text-lg font-semibold text-gray-900 dark:text-gray-100">Total:</span>
                                <span id="cart-total" class="text-xl font-bold text-green-600 dark:text-green-400">Rp 0</span>
                            </div>
                            <div class="space-y-2">
                                <button id="checkout-btn" onclick="checkout()" disabled
                                        class="w-full px-4 py-3 font-medium text-white transition-colors duration-200 bg-green-600 rounded-lg dark:bg-green-700 disabled:bg-gray-300 dark:disabled:bg-gray-600 disabled:cursor-not-allowed hover:bg-green-700 dark:hover:bg-green-600">
                                    Checkout
                                </button>
                                <button id="clear-cart-btn" onclick="clearCart()" disabled
                                        class="w-full px-4 py-2 font-medium text-white transition-colors duration-200 bg-red-600 rounded-lg dark:bg-red-700 disabled:bg-gray-300 dark:disabled:bg-gray-600 disabled:cursor-not-allowed hover:bg-red-700 dark:hover:bg-red-600">
                                    Kosongkan Keranjang
                                </button>
                            </div>
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

    <script>
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
            } else if (type === 'warning') {
                return {
                    ...baseConfig,
                    confirmButtonColor: '#f59e0b'
                };
            }

            return baseConfig;
        }

        let cart = {};

        // Initialize cart from server session
        function initializeCart() {
            fetch('{{ route("kasir.dashboard") }}')
                .then(response => {
                    // For now, start with empty cart
                })
                .catch(error => {
                    console.error('Error initializing cart:', error);
                });
        }

        // Category switching
        function showCategory(category) {
            // Hide all categories
            document.querySelectorAll('.category-content').forEach(el => el.classList.add('hidden'));
            document.querySelectorAll('.category-tab').forEach(el => el.classList.remove('active-tab'));

            // Show selected category
            document.getElementById('category-' + category).classList.remove('hidden');
            document.getElementById('tab-' + category).classList.add('active-tab');
        }

        // Add to cart with better error handling
        function addToCart(menuId, nama, harga) {
            // Update local cart immediately for responsive UI
            if (cart[menuId]) {
                cart[menuId].jumlah += 1;
                cart[menuId].subtotal = cart[menuId].jumlah * harga;
            } else {
                cart[menuId] = {
                    id: menuId,
                    nama: nama,
                    harga: harga,
                    jumlah: 1,
                    subtotal: harga
                };
            }

            // Update display immediately
            updateCartDisplay();

            // Send to server with error handling
            fetch('{{ route("kasir.cart.add") }}', {
                method: 'POST',
                headers: {
                    'Content-Type': 'application/json',
                    'X-CSRF-TOKEN': '{{ csrf_token() }}',
                    'Accept': 'application/json'
                },
                body: JSON.stringify({
                    menu_id: menuId,
                    jumlah: 1
                })
            })
            .then(response => {
                if (!response.ok) {
                    throw new Error('Network response was not ok');
                }
                return response.json();
            })
            .then(data => {
                if (data.success) {
                    // Optionally show success message
                    showToast('Menu berhasil ditambahkan ke keranjang', 'success');
                } else {
                    // Revert local cart if server failed
                    if (cart[menuId].jumlah > 1) {
                        cart[menuId].jumlah -= 1;
                        cart[menuId].subtotal = cart[menuId].jumlah * harga;
                    } else {
                        delete cart[menuId];
                    }
                    updateCartDisplay();
                    showToast('Gagal menambahkan ke keranjang', 'error');
                }
            })
            .catch(error => {
                console.error('Error adding to cart:', error);
                // Revert local cart if request failed
                if (cart[menuId].jumlah > 1) {
                    cart[menuId].jumlah -= 1;
                    cart[menuId].subtotal = cart[menuId].jumlah * harga;
                } else {
                    delete cart[menuId];
                }
                updateCartDisplay();
                showToast('Error jaringan. Silakan coba lagi.', 'error');
            });
        }

        // Remove from cart with better error handling
        function removeFromCart(menuId) {
            // Store original state for potential revert
            const originalItem = cart[menuId] ? {...cart[menuId]} : null;

            // Update local cart immediately
            delete cart[menuId];
            updateCartDisplay();

            // Send to server
            fetch('{{ route("kasir.cart.remove") }}', {
                method: 'POST',
                headers: {
                    'Content-Type': 'application/json',
                    'X-CSRF-TOKEN': '{{ csrf_token() }}',
                    'Accept': 'application/json'
                },
                body: JSON.stringify({
                    menu_id: menuId
                })
            })
            .then(response => {
                if (!response.ok) {
                    throw new Error('Network response was not ok');
                }
                return response.json();
            })
            .then(data => {
                if (data.success) {
                    showToast('Menu berhasil dihapus dari keranjang', 'success');
                } else {
                    // Revert if server failed
                    if (originalItem) {
                        cart[menuId] = originalItem;
                        updateCartDisplay();
                    }
                    showToast('Gagal menghapus dari keranjang', 'error');
                }
            })
            .catch(error => {
                console.error('Error removing from cart:', error);
                // Revert if request failed
                if (originalItem) {
                    cart[menuId] = originalItem;
                    updateCartDisplay();
                }
                showToast('Error jaringan. Silakan coba lagi.', 'error');
            });
        }

        // Update quantity with better error handling
        function updateQuantity(menuId, newQuantity) {
            if (newQuantity <= 0) {
                removeFromCart(menuId);
                return;
            }

            if (!cart[menuId]) {
                console.error('Item not found in cart:', menuId);
                return;
            }

            // Store original state for potential revert
            const originalQuantity = cart[menuId].jumlah;
            const originalSubtotal = cart[menuId].subtotal;

            // Update local cart immediately
            cart[menuId].jumlah = newQuantity;
            cart[menuId].subtotal = cart[menuId].jumlah * cart[menuId].harga;
            updateCartDisplay();

            // Send to server
            fetch('{{ route("kasir.cart.update") }}', {
                method: 'POST',
                headers: {
                    'Content-Type': 'application/json',
                    'X-CSRF-TOKEN': '{{ csrf_token() }}',
                    'Accept': 'application/json'
                },
                body: JSON.stringify({
                    menu_id: menuId,
                    jumlah: newQuantity
                })
            })
            .then(response => {
                if (!response.ok) {
                    throw new Error('Network response was not ok');
                }
                return response.json();
            })
            .then(data => {
                if (data.success) {
                    showToast('Keranjang berhasil diupdate', 'success');
                } else {
                    // Revert if server failed
                    cart[menuId].jumlah = originalQuantity;
                    cart[menuId].subtotal = originalSubtotal;
                    updateCartDisplay();
                    showToast('Gagal mengupdate keranjang', 'error');
                }
            })
            .catch(error => {
                console.error('Error updating cart:', error);
                // Revert if request failed
                cart[menuId].jumlah = originalQuantity;
                cart[menuId].subtotal = originalSubtotal;
                updateCartDisplay();
                showToast('Error jaringan. Silakan coba lagi.', 'error');
            });
        }

        // Update cart display with better error handling
        function updateCartDisplay() {
            try {
                const cartItemsContainer = document.getElementById('cart-items');
                const cartCount = document.getElementById('cart-count');
                const cartTotal = document.getElementById('cart-total');
                const emptyCart = document.getElementById('empty-cart');
                const checkoutBtn = document.getElementById('checkout-btn');
                const clearCartBtn = document.getElementById('clear-cart-btn');

                if (!cartItemsContainer || !cartCount || !cartTotal) {
                    console.error('Cart elements not found');
                    return;
                }

                const itemCount = Object.keys(cart).length;
                const total = Object.values(cart).reduce((sum, item) => sum + (item.subtotal || 0), 0);

                cartCount.textContent = itemCount;
                cartTotal.textContent = 'Rp ' + total.toLocaleString('id-ID');

                if (itemCount === 0) {
                    if (emptyCart) emptyCart.style.display = 'block';
                    if (checkoutBtn) checkoutBtn.disabled = true;
                    if (clearCartBtn) clearCartBtn.disabled = true;
                    cartItemsContainer.innerHTML = '';
                    if (emptyCart) cartItemsContainer.appendChild(emptyCart);
                } else {
                    if (emptyCart) emptyCart.style.display = 'none';
                    if (checkoutBtn) checkoutBtn.disabled = false;
                    if (clearCartBtn) clearCartBtn.disabled = false;

                    cartItemsContainer.innerHTML = Object.values(cart).map(item => `
                        <div class="flex items-center justify-between p-3 rounded-lg bg-gray-50 dark:bg-gray-700">
                            <div class="flex-1">
                                <h4 class="text-sm font-medium text-gray-900 dark:text-gray-100">${item.nama || 'Unknown Item'}</h4>
                                <p class="text-sm text-gray-500 dark:text-gray-400">Rp ${(item.harga || 0).toLocaleString('id-ID')}</p>
                            </div>
                            <div class="flex items-center space-x-2">
                                <button onclick="updateQuantity(${item.id}, ${(item.jumlah || 1) - 1})"
                                        class="flex items-center justify-center w-6 h-6 text-sm font-medium text-gray-700 bg-gray-200 rounded-full dark:bg-gray-600 dark:text-gray-300 hover:bg-gray-300 dark:hover:bg-gray-500">
                                    -
                                </button>
                                <span class="w-8 text-sm font-medium text-center text-gray-900 dark:text-gray-100">${item.jumlah || 1}</span>
                                <button onclick="updateQuantity(${item.id}, ${(item.jumlah || 1) + 1})"
                                        class="flex items-center justify-center w-6 h-6 text-sm font-medium text-gray-700 bg-gray-200 rounded-full dark:bg-gray-600 dark:text-gray-300 hover:bg-gray-300 dark:hover:bg-gray-500">
                                    +
                                </button>
                                <button onclick="removeFromCart(${item.id})"
                                        class="ml-2 text-red-500 dark:text-red-400 hover:text-red-700 dark:hover:text-red-300">
                                    <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12"></path>
                                    </svg>
                                </button>
                            </div>
                        </div>
                    `).join('');
                }
            } catch (error) {
                console.error('Error updating cart display:', error);
            }
        }

        // Clear cart with better error handling
        function clearCart() {
            // Store original cart for potential revert
            const originalCart = {...cart};

            // Clear local cart immediately
            cart = {};
            updateCartDisplay();

            // Send to server
            fetch('{{ route("kasir.cart.clear") }}', {
                method: 'POST',
                headers: {
                    'Content-Type': 'application/json',
                    'X-CSRF-TOKEN': '{{ csrf_token() }}',
                    'Accept': 'application/json'
                }
            })
            .then(response => {
                if (!response.ok) {
                    throw new Error('Network response was not ok');
                }
                return response.json();
            })
            .then(data => {
                if (data.success) {
                    showToast('Keranjang berhasil dikosongkan', 'success');
                } else {
                    // Revert if server failed
                    cart = originalCart;
                    updateCartDisplay();
                    showToast('Gagal mengosongkan keranjang', 'error');
                }
            })
            .catch(error => {
                console.error('Error clearing cart:', error);
                // Revert if request failed
                cart = originalCart;
                updateCartDisplay();
                showToast('Error jaringan. Silakan coba lagi.', 'error');
            });
        }

        // Toast notification system
        function showToast(message, type = 'info') {
            // Remove existing toast
            const existingToast = document.getElementById('toast');
            if (existingToast) {
                existingToast.remove();
            }

            // Create toast element
            const toast = document.createElement('div');
            toast.id = 'toast';
            toast.className = `fixed top-4 right-4 z-50 p-4 rounded-lg shadow-lg transition-all duration-300 transform ${
                type === 'success' ? 'bg-green-500 text-white' :
                type === 'error' ? 'bg-red-500 text-white' :
                'bg-blue-500 text-white'
            }`;
            toast.innerHTML = `
                <div class="flex items-center">
                    <span>${message}</span>
                    <button onclick="this.parentElement.parentElement.remove()" class="ml-4 text-white hover:text-gray-200">
                        ×
                    </button>
                </div>
            `;

            // Add to page
            document.body.appendChild(toast);

            // Auto remove after 3 seconds
            setTimeout(() => {
                if (toast.parentElement) {
                    toast.remove();
                }
            }, 3000);
        }

        // Checkout
        async function checkout() {
            if (Object.keys(cart).length === 0) {
                await Swal.fire({
                    title: 'Keranjang Kosong!',
                    text: 'Silakan tambahkan menu ke keranjang terlebih dahulu.',
                    icon: 'warning',
                    ...getSweetAlertConfig('warning')
                });
                return;
            }

            const result = await Swal.fire({
                title: 'Konfirmasi Checkout',
                text: 'Proses checkout dan simpan transaksi?',
                icon: 'question',
                showCancelButton: true,
                confirmButtonText: 'Ya, Checkout!',
                cancelButtonText: 'Batal',
                reverseButtons: true,
                ...getSweetAlertConfig('confirm')
            });

            if (!result.isConfirmed) return;

            try {
                // Get customer name from input
                const customerName = document.getElementById('customer-name').value.trim();

                const response = await fetch('{{ route("kasir.checkout") }}', {
                    method: 'POST',
                    headers: {
                        'Content-Type': 'application/json',
                        'X-CSRF-TOKEN': '{{ csrf_token() }}'
                    },
                    body: JSON.stringify({
                        nama_pelanggan: customerName || null
                    })
                });

                const data = await response.json();

                if (data.success) {
                    await Swal.fire({
                        title: 'Transaksi Berhasil!',
                        html: `
                            <div class="text-center">
                                <p class="mb-2"><strong>Kode Transaksi:</strong> ${data.kode_transaksi}</p>
                                ${customerName ? `<p class="mb-2"><strong>Nama Pelanggan:</strong> ${customerName}</p>` : ''}
                                <p class="text-lg font-semibold">Total: Rp ${data.total.toLocaleString('id-ID')}</p>
                            </div>
                        `,
                        icon: 'success',
                        timer: 3000,
                        timerProgressBar: true,
                        ...getSweetAlertConfig('success')
                    });

                    // Clear local cart and refresh display
                    cart = {};
                    updateCartDisplay();

                    // Clear customer name input
                    document.getElementById('customer-name').value = '';

                    // Refresh page to update statistics
                    window.location.reload();
                } else {
                    await Swal.fire({
                        title: 'Checkout Gagal!',
                        text: data.message || 'Terjadi kesalahan saat memproses transaksi',
                        icon: 'error',
                        ...getSweetAlertConfig('error')
                    });
                }
            } catch (error) {
                console.error('Error:', error);
                await Swal.fire({
                    title: 'Error!',
                    text: 'Terjadi kesalahan saat checkout',
                    icon: 'error',
                    ...getSweetAlertConfig('error')
                });
            }
        }

        // CSS for tabs and initialization
        document.addEventListener('DOMContentLoaded', function() {
            // Initialize cart
            initializeCart();
            updateCartDisplay();

            // Add tab styling
            const style = document.createElement('style');
            style.textContent = `
                .category-tab {
                    color: rgb(107 114 128);
                    border-color: transparent;
                }
                .active-tab {
                    color: rgb(59 130 246) !important;
                    border-color: rgb(59 130 246) !important;
                }
                .dark .category-tab {
                    color: rgb(156 163 175);
                }
                .dark .active-tab {
                    color: rgb(96 165 250) !important;
                    border-color: rgb(96 165 250) !important;
                }
            `;
            document.head.appendChild(style);
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
