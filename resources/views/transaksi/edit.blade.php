<x-admin-layout>
    <x-slot name="header">
        Edit Transaksi
    </x-slot>

    <div class="p-6">
        <div class="max-w-4xl mx-auto space-y-6">
            <!-- Header -->
            <div class="bg-white border border-gray-200 rounded-lg shadow-sm dark:bg-gray-800 dark:border-gray-700">
                <div class="px-6 py-4 border-b border-gray-200 dark:border-gray-700">
                    <div class="flex items-center justify-between">
                        <div>
                            <h2 class="text-xl font-semibold text-gray-800 dark:text-gray-100">Edit Transaksi</h2>
                            <p class="mt-1 text-sm text-gray-600 dark:text-gray-300">{{ $transaksi->kode_transaksi }}</p>
                        </div>
                        <a href="{{ route('transaksi.index') }}" class="inline-flex items-center px-4 py-2 text-sm font-medium text-white transition duration-150 ease-in-out bg-gray-500 border border-transparent rounded-lg dark:bg-gray-600 hover:bg-gray-600 dark:hover:bg-gray-700 focus:outline-none focus:ring-2 focus:ring-gray-500 dark:focus:ring-gray-400 focus:ring-offset-2 dark:focus:ring-offset-gray-800">
                            <svg class="w-4 h-4 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10 19l-7-7m0 0l7-7m-7 7h18"></path>
                            </svg>
                            Kembali
                        </a>
                    </div>
                </div>
            </div>

            <!-- Alert Error -->
            @if ($errors->any())
                <div class="px-4 py-3 text-red-700 border border-red-200 rounded-lg bg-red-50 dark:bg-red-900/30 dark:border-red-700 dark:text-red-300">
                    <div class="flex">
                        <svg class="w-5 h-5 mr-2 text-red-600 dark:text-red-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8v4m0 4h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z"></path>
                        </svg>
                        <div>
                            <h4 class="font-medium">Terdapat beberapa kesalahan:</h4>
                            <ul class="mt-2 text-sm list-disc list-inside">
                                @foreach ($errors->all() as $error)
                                    <li>{{ $error }}</li>
                                @endforeach
                            </ul>
                        </div>
                    </div>
                </div>
            @endif

            <!-- Main Form -->
            <div class="bg-white border border-gray-200 rounded-lg shadow-sm dark:bg-gray-800 dark:border-gray-700">
                <form action="{{ route('transaksi.update', $transaksi) }}" method="POST" class="p-6 space-y-6" x-data="transaksiEditForm()">
                    @csrf
                    @method('PUT')

                    <!-- Tanggal Transaksi -->
                    <div class="grid grid-cols-1 gap-6 md:grid-cols-2">
                        <div>
                            <label for="tanggal_transaksi" class="block mb-2 text-sm font-medium text-gray-700 dark:text-gray-300">
                                Tanggal Transaksi <span class="text-red-500">*</span>
                            </label>
                            <input type="datetime-local" name="tanggal_transaksi" id="tanggal_transaksi" required
                                value="{{ old('tanggal_transaksi', $transaksi->tanggal_transaksi->format('Y-m-d\TH:i')) }}"
                                class="w-full px-3 py-2 text-sm text-gray-900 transition-colors duration-200 bg-white border border-gray-300 rounded-lg dark:border-gray-600 dark:bg-gray-700 dark:text-gray-100 focus:outline-none focus:ring-2 focus:ring-blue-500 focus:border-blue-500">
                            @error('tanggal_transaksi')
                                <p class="mt-1 text-sm text-red-600 dark:text-red-400">{{ $message }}</p>
                            @enderror
                        </div>

                        <div>
                            <label for="status" class="block mb-2 text-sm font-medium text-gray-700 dark:text-gray-300">
                                Status <span class="text-red-500">*</span>
                            </label>
                            <select name="status" id="status" required
                                class="w-full px-3 py-2 text-sm text-gray-900 transition-colors duration-200 bg-white border border-gray-300 rounded-lg dark:border-gray-600 dark:bg-gray-700 dark:text-gray-100 focus:outline-none focus:ring-2 focus:ring-blue-500 focus:border-blue-500">
                                <option value="">-- Pilih Status --</option>
                                <option value="antri" {{ old('status', $transaksi->status) == 'antri' ? 'selected' : '' }}>Antri</option>
                                <option value="selesai" {{ old('status', $transaksi->status) == 'selesai' ? 'selected' : '' }}>Selesai</option>
                            </select>
                            @error('status')
                                <p class="mt-1 text-sm text-red-600 dark:text-red-400">{{ $message }}</p>
                            @enderror
                        </div>
                    </div>

                    <!-- Menu Items -->
                    <div>
                        <label class="block mb-4 text-sm font-medium text-gray-700 dark:text-gray-300">
                            Edit Menu <span class="text-red-500">*</span>
                        </label>

                        <div class="space-y-4" x-data="{ items: [] }" x-init="initItems()">
                            @foreach($transaksi->pesanan as $index => $existingItem)
                                <div class="flex items-center p-4 space-x-4 border border-gray-200 rounded-lg dark:border-gray-600 bg-gray-50 dark:bg-gray-700">
                                    <div class="flex-1">
                                        <select name="pesanan[{{ $index }}][menu_id]" required
                                            x-on:change="updateSubtotal({{ $index }})"
                                            class="w-full px-3 py-2 text-sm text-gray-900 bg-white border border-gray-300 rounded-lg dark:border-gray-600 dark:bg-gray-700 dark:text-gray-100 focus:outline-none focus:ring-2 focus:ring-blue-500 focus:border-blue-500">
                                            <option value="">-- Pilih Menu --</option>
                                            @foreach($menus as $menu)
                                                <option value="{{ $menu->id }}"
                                                    data-price="{{ $menu->harga }}"
                                                    {{ $existingItem['menu_id'] == $menu->id ? 'selected' : '' }}>
                                                    {{ $menu->nama }} - {{ $menu->formatted_harga }}
                                                </option>
                                            @endforeach
                                        </select>
                                    </div>
                                    <div class="w-24">
                                        <input type="number" name="pesanan[{{ $index }}][jumlah]"
                                            value="{{ $existingItem['jumlah'] }}"
                                            min="1" required
                                            placeholder="Qty"
                                            x-on:input="updateSubtotal({{ $index }})"
                                            class="w-full px-3 py-2 text-sm text-gray-900 bg-white border border-gray-300 rounded-lg dark:border-gray-600 dark:bg-gray-700 dark:text-gray-100 focus:outline-none focus:ring-2 focus:ring-blue-500 focus:border-blue-500">
                                    </div>
                                    <div class="w-32 text-sm text-gray-600 dark:text-gray-300" x-data="{ subtotal: {{ isset($existingItem['subtotal']) ? $existingItem['subtotal'] : ($menus->find($existingItem['menu_id'])->harga ?? 0) * $existingItem['jumlah'] }} }">
                                        <span x-text="'Rp ' + new Intl.NumberFormat('id-ID').format(subtotal)"></span>
                                    </div>
                                </div>
                            @endforeach
                        </div>
                    </div>

                    <!-- Current Total -->
                    <div class="p-4 rounded-lg bg-gray-50 dark:bg-gray-700">
                        <div class="flex items-center justify-between">
                            <span class="text-lg font-medium text-gray-700 dark:text-gray-300">Total Transaksi:</span>
                            <span class="text-xl font-bold text-blue-600 dark:text-blue-400" x-text="'Rp ' + new Intl.NumberFormat('id-ID').format(totalTransaksi)"></span>
                        </div>
                    </div>

                    <!-- Action Buttons -->
                    <div class="flex items-center justify-end pt-6 space-x-3 border-t border-gray-200 dark:border-gray-700">
                        <a href="{{ route('transaksi.show', $transaksi) }}" class="inline-flex items-center px-4 py-2 text-sm font-medium text-gray-700 transition duration-150 ease-in-out bg-white border border-gray-300 rounded-lg dark:border-gray-600 dark:text-gray-300 dark:bg-gray-700 hover:bg-gray-50 dark:hover:bg-gray-600 focus:outline-none focus:ring-2 focus:ring-gray-500 focus:ring-offset-2 dark:focus:ring-offset-gray-800">
                            <svg class="w-4 h-4 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12"></path>
                            </svg>
                            Batal
                        </a>
                        <button type="submit" class="inline-flex items-center px-6 py-2 text-sm font-medium text-white transition duration-150 ease-in-out bg-blue-600 border border-transparent rounded-lg dark:bg-blue-600 hover:bg-blue-700 dark:hover:bg-blue-700 focus:outline-none focus:ring-2 focus:ring-blue-500 focus:ring-offset-2 dark:focus:ring-offset-gray-800">
                            <svg class="w-4 h-4 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7"></path>
                            </svg>
                            Update Transaksi
                        </button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</x-admin-layout>

<script>
function transaksiEditForm() {
    return {
        totalTransaksi: {{ $transaksi->total_transaksi }},

        init() {
            this.updateTotal();
        },

        updateSubtotal(index) {
            const menuSelect = document.querySelector(`select[name="pesanan[${index}][menu_id]"]`);
            const qtyInput = document.querySelector(`input[name="pesanan[${index}][jumlah]"]`);

            if (menuSelect && qtyInput) {
                const selectedOption = menuSelect.options[menuSelect.selectedIndex];
                const price = selectedOption.getAttribute('data-price') || 0;
                const qty = parseInt(qtyInput.value) || 0;
                const subtotal = price * qty;

                // Update subtotal display
                const subtotalElement = menuSelect.closest('.flex').querySelector('[x-data]');
                if (subtotalElement && subtotalElement.__x) {
                    subtotalElement.__x.$data.subtotal = subtotal;
                }
            }

            this.updateTotal();
        },

        updateTotal() {
            let total = 0;
            document.querySelectorAll('select[name*="[menu_id]"]').forEach((select, index) => {
                const qtyInput = document.querySelector(`input[name="pesanan[${index}][jumlah]"]`);
                if (select && qtyInput) {
                    const selectedOption = select.options[select.selectedIndex];
                    const price = selectedOption.getAttribute('data-price') || 0;
                    const qty = parseInt(qtyInput.value) || 0;
                    total += price * qty;
                }
            });

            this.totalTransaksi = total;
        }
    }
}
</script>
