<x-admin-layout>
    <x-slot name="header">
        Tambah Transaksi
    </x-slot>

    <div class="p-6">
        <div class="max-w-4xl mx-auto space-y-6">
            <!-- Header -->
            <div class="bg-white dark:bg-gray-800 rounded-lg shadow-sm border border-gray-200 dark:border-gray-700">
                <div class="px-6 py-4 border-b border-gray-200 dark:border-gray-700">
                    <div class="flex items-center justify-between">
                        <div>
                            <h2 class="text-xl font-semibold text-gray-800 dark:text-gray-100">Tambah Transaksi Baru</h2>
                            <p class="text-sm text-gray-600 dark:text-gray-300 mt-1">Buat transaksi baru untuk pelanggan</p>
                        </div>
                        <a href="{{ route('transaksi.index') }}" class="inline-flex items-center px-4 py-2 bg-gray-500 dark:bg-gray-600 border border-transparent rounded-lg font-medium text-sm text-white hover:bg-gray-600 dark:hover:bg-gray-700 focus:outline-none focus:ring-2 focus:ring-gray-500 dark:focus:ring-gray-400 focus:ring-offset-2 dark:focus:ring-offset-gray-800 transition ease-in-out duration-150">
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
                <div class="bg-red-50 dark:bg-red-900/30 border border-red-200 dark:border-red-700 text-red-700 dark:text-red-300 px-4 py-3 rounded-lg">
                    <div class="flex">
                        <svg class="w-5 h-5 text-red-600 dark:text-red-400 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8v4m0 4h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z"></path>
                        </svg>
                        <div>
                            <h4 class="font-medium">Terdapat beberapa kesalahan:</h4>
                            <ul class="mt-2 list-disc list-inside text-sm">
                                @foreach ($errors->all() as $error)
                                    <li>{{ $error }}</li>
                                @endforeach
                            </ul>
                        </div>
                    </div>
                </div>
            @endif

            <!-- Main Form -->
            <div class="bg-white dark:bg-gray-800 rounded-lg shadow-sm border border-gray-200 dark:border-gray-700">
                <form action="{{ route('transaksi.store') }}" method="POST" class="space-y-6 p-6" x-data="transaksiForm()">
                    @csrf

                    <!-- Tanggal Transaksi -->
                    <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                        <div>
                            <label for="tanggal_transaksi" class="block text-sm font-medium text-gray-700 dark:text-gray-300 mb-2">
                                Tanggal Transaksi <span class="text-red-500">*</span>
                            </label>
                            <input type="datetime-local" name="tanggal_transaksi" id="tanggal_transaksi" required
                                value="{{ old('tanggal_transaksi', now()->format('Y-m-d\TH:i')) }}"
                                class="w-full border border-gray-300 dark:border-gray-600 rounded-lg px-3 py-2 text-sm bg-white dark:bg-gray-700 text-gray-900 dark:text-gray-100 focus:outline-none focus:ring-2 focus:ring-blue-500 focus:border-blue-500 transition-colors duration-200">
                            @error('tanggal_transaksi')
                                <p class="mt-1 text-sm text-red-600 dark:text-red-400">{{ $message }}</p>
                            @enderror
                        </div>

                        <div>
                            <label for="status" class="block text-sm font-medium text-gray-700 dark:text-gray-300 mb-2">
                                Status <span class="text-red-500">*</span>
                            </label>
                            <select name="status" id="status" required
                                class="w-full border border-gray-300 dark:border-gray-600 rounded-lg px-3 py-2 text-sm bg-white dark:bg-gray-700 text-gray-900 dark:text-gray-100 focus:outline-none focus:ring-2 focus:ring-blue-500 focus:border-blue-500 transition-colors duration-200">
                                <option value="">-- Pilih Status --</option>
                                <option value="antri" {{ old('status') == 'antri' ? 'selected' : '' }}>Antri</option>
                                <option value="selesai" {{ old('status') == 'selesai' ? 'selected' : '' }}>Selesai</option>
                            </select>
                            @error('status')
                                <p class="mt-1 text-sm text-red-600 dark:text-red-400">{{ $message }}</p>
                            @enderror
                        </div>
                    </div>

                    <!-- Menu Items -->
                    <div>
                        <label class="block text-sm font-medium text-gray-700 dark:text-gray-300 mb-4">
                            Pilih Menu <span class="text-red-500">*</span>
                        </label>

                        <div class="space-y-4">
                            <template x-for="(item, index) in items" :key="index">
                                <div class="flex items-center space-x-4 p-4 border border-gray-200 dark:border-gray-600 rounded-lg bg-gray-50 dark:bg-gray-700">
                                    <div class="flex-1">
                                        <select :name="'pesanan[' + index + '][menu_id]'" required
                                            x-model="item.menu_id"
                                            @change="updatePrice(index)"
                                            class="w-full border border-gray-300 dark:border-gray-600 rounded-lg px-3 py-2 text-sm bg-white dark:bg-gray-700 text-gray-900 dark:text-gray-100 focus:outline-none focus:ring-2 focus:ring-blue-500 focus:border-blue-500">
                                            <option value="">-- Pilih Menu --</option>
                                            @foreach($menus as $menu)
                                                <option value="{{ $menu->id }}" data-price="{{ $menu->harga }}">
                                                    {{ $menu->nama }} - {{ $menu->formatted_harga }}
                                                </option>
                                            @endforeach
                                        </select>
                                    </div>
                                    <div class="w-24">
                                        <input type="number" :name="'pesanan[' + index + '][jumlah]'"
                                            x-model="item.jumlah"
                                            @input="calculateTotal()"
                                            min="1" required
                                            placeholder="Qty"
                                            class="w-full border border-gray-300 dark:border-gray-600 rounded-lg px-3 py-2 text-sm bg-white dark:bg-gray-700 text-gray-900 dark:text-gray-100 focus:outline-none focus:ring-2 focus:ring-blue-500 focus:border-blue-500">
                                    </div>
                                    <div class="w-32 text-sm text-gray-600 dark:text-gray-300">
                                        <span x-text="formatCurrency(item.subtotal)"></span>
                                    </div>
                                    <button type="button" @click="removeItem(index)"
                                        class="text-red-600 dark:text-red-400 hover:text-red-800 dark:hover:text-red-300 p-1 rounded-md hover:bg-red-50 dark:hover:bg-red-900/30"
                                        :disabled="items.length === 1">
                                        <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 7l-.867 12.142A2 2 0 0116.138 21H7.862a2 2 0 01-1.995-1.858L5 7m5 4v6m4-6v6m1-10V4a1 1 0 00-1-1h-4a1 1 0 00-1 1v3M4 7h16"></path>
                                        </svg>
                                    </button>
                                </div>
                            </template>
                        </div>

                        <button type="button" @click="addItem()"
                            class="mt-4 inline-flex items-center px-3 py-2 border border-dashed border-gray-300 dark:border-gray-600 rounded-lg text-sm text-gray-600 dark:text-gray-300 hover:border-blue-400 dark:hover:border-blue-500 hover:text-blue-600 dark:hover:text-blue-400">
                            <svg class="w-4 h-4 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 6v6m0 0v6m0-6h6m-6 0H6"></path>
                            </svg>
                            Tambah Item
                        </button>
                    </div>

                    <!-- Total Transaksi -->
                    <div class="bg-gray-50 dark:bg-gray-700 rounded-lg p-4">
                        <div class="flex justify-between items-center">
                            <span class="text-lg font-medium text-gray-700 dark:text-gray-300">Total Transaksi:</span>
                            <span class="text-xl font-bold text-blue-600 dark:text-blue-400" x-text="formatCurrency(total)"></span>
                        </div>
                    </div>

                    <!-- Action Buttons -->
                    <div class="flex items-center justify-end space-x-3 pt-6 border-t border-gray-200 dark:border-gray-700">
                        <a href="{{ route('transaksi.index') }}" class="inline-flex items-center px-4 py-2 border border-gray-300 dark:border-gray-600 rounded-lg font-medium text-sm text-gray-700 dark:text-gray-300 bg-white dark:bg-gray-700 hover:bg-gray-50 dark:hover:bg-gray-600 focus:outline-none focus:ring-2 focus:ring-gray-500 focus:ring-offset-2 dark:focus:ring-offset-gray-800 transition ease-in-out duration-150">
                            <svg class="w-4 h-4 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12"></path>
                            </svg>
                            Batal
                        </a>
                        <button type="submit" class="inline-flex items-center px-6 py-2 bg-blue-600 dark:bg-blue-600 border border-transparent rounded-lg font-medium text-sm text-white hover:bg-blue-700 dark:hover:bg-blue-700 focus:outline-none focus:ring-2 focus:ring-blue-500 focus:ring-offset-2 dark:focus:ring-offset-gray-800 transition ease-in-out duration-150">
                            <svg class="w-4 h-4 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7"></path>
                            </svg>
                            Simpan Transaksi
                        </button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</x-admin-layout>

<script>
function transaksiForm() {
    return {
        items: [
            { menu_id: '', jumlah: 1, harga: 0, subtotal: 0 }
        ],
        total: 0,

        addItem() {
            this.items.push({ menu_id: '', jumlah: 1, harga: 0, subtotal: 0 });
        },

        removeItem(index) {
            if (this.items.length > 1) {
                this.items.splice(index, 1);
                this.calculateTotal();
            }
        },

        updatePrice(index) {
            const select = document.querySelector(`select[name="pesanan[${index}][menu_id]"]`);
            const selectedOption = select.selectedOptions[0];

            if (selectedOption && selectedOption.dataset.price) {
                this.items[index].harga = parseInt(selectedOption.dataset.price);
                this.items[index].subtotal = this.items[index].harga * this.items[index].jumlah;
            } else {
                this.items[index].harga = 0;
                this.items[index].subtotal = 0;
            }

            this.calculateTotal();
        },

        calculateTotal() {
            this.total = this.items.reduce((sum, item) => {
                const subtotal = item.harga * item.jumlah;
                item.subtotal = subtotal;
                return sum + subtotal;
            }, 0);
        },

        formatCurrency(amount) {
            return 'Rp ' + new Intl.NumberFormat('id-ID').format(amount || 0);
        }
    }
}
</script>
