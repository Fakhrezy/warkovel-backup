<x-admin-layout>
    <x-slot name="header">
        Detail Transaksi
    </x-slot>

    <div class="p-6">
        <div class="max-w-4xl mx-auto space-y-6">
            <!-- Header -->
            <div class="bg-white dark:bg-gray-800 rounded-lg shadow-sm border border-gray-200 dark:border-gray-700">
                <div class="px-6 py-4 border-b border-gray-200 dark:border-gray-700">
                    <div class="flex items-center justify-between">
                        <div>
                            <h2 class="text-xl font-semibold text-gray-800 dark:text-gray-100">Detail Transaksi</h2>
                            <p class="text-sm text-gray-600 dark:text-gray-300 mt-1">{{ $transaksi->kode_transaksi }}</p>
                        </div>
                        <div class="flex space-x-2">
                            <a href="{{ route('transaksi.edit', $transaksi) }}" class="inline-flex items-center px-4 py-2 bg-blue-600 dark:bg-blue-600 border border-transparent rounded-lg font-medium text-sm text-white hover:bg-blue-700 dark:hover:bg-blue-700 focus:outline-none focus:ring-2 focus:ring-blue-500 focus:ring-offset-2 dark:focus:ring-offset-gray-800 transition ease-in-out duration-150">
                                <svg class="w-4 h-4 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M11 5H6a2 2 0 00-2 2v11a2 2 0 002 2h11a2 2 0 002-2v-5m-1.414-9.414a2 2 0 112.828 2.828L11.828 15H9v-2.828l8.586-8.586z"></path>
                                </svg>
                                Edit
                            </a>
                            <a href="{{ route('transaksi.index') }}" class="inline-flex items-center px-4 py-2 bg-gray-500 dark:bg-gray-600 border border-transparent rounded-lg font-medium text-sm text-white hover:bg-gray-600 dark:hover:bg-gray-700 focus:outline-none focus:ring-2 focus:ring-gray-500 dark:focus:ring-gray-400 focus:ring-offset-2 dark:focus:ring-offset-gray-800 transition ease-in-out duration-150">
                                <svg class="w-4 h-4 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10 19l-7-7m0 0l7-7m-7 7h18"></path>
                                </svg>
                                Kembali
                            </a>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Transaction Info -->
                        <!-- Transaction Information -->
            <div class="bg-white dark:bg-gray-800 rounded-lg shadow-sm border border-gray-200 dark:border-gray-700">
                <div class="px-6 py-4 border-b border-gray-200 dark:border-gray-700">
                    <h3 class="text-lg font-medium text-gray-900 dark:text-gray-100">Informasi Transaksi</h3>
                </div>
                <div class="p-6">
                    <dl class="grid grid-cols-1 md:grid-cols-2 gap-6">
                        <div>
                            <dt class="text-sm font-medium text-gray-500 dark:text-gray-400">Kode Transaksi</dt>
                            <dd class="mt-1 text-lg font-semibold text-gray-900 dark:text-gray-100">{{ $transaksi->kode_transaksi }}</dd>
                        </div>
                        <div>
                            <dt class="text-sm font-medium text-gray-500 dark:text-gray-400">Tanggal Transaksi</dt>
                            <dd class="mt-1 text-lg text-gray-900 dark:text-gray-100">{{ $transaksi->tanggal_transaksi->format('d/m/Y H:i') }}</dd>
                        </div>
                        <div>
                            <dt class="text-sm font-medium text-gray-500 dark:text-gray-400">Status</dt>
                            <dd class="mt-1">
                                @if($transaksi->status == 'antri')
                                    <span class="inline-flex items-center px-3 py-1 rounded-full text-sm font-medium bg-yellow-100 dark:bg-yellow-900/30 text-yellow-800 dark:text-yellow-200 border border-yellow-200 dark:border-yellow-700">
                                        <svg class="w-4 h-4 mr-1" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8v4l3 3m6-3a9 9 0 11-18 0 9 9 0 0118 0z"></path>
                                        </svg>
                                        Antri
                                    </span>
                                @else
                                    <span class="inline-flex items-center px-3 py-1 rounded-full text-sm font-medium bg-green-100 dark:bg-green-900/30 text-green-800 dark:text-green-200 border border-green-200 dark:border-green-700">
                                        <svg class="w-4 h-4 mr-1" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z"></path>
                                        </svg>
                                        Selesai
                                    </span>
                                @endif
                            </dd>
                        </div>
                        <div>
                            <dt class="text-sm font-medium text-gray-500 dark:text-gray-400">Total Item</dt>
                            <dd class="mt-1 text-lg text-gray-900 dark:text-gray-100">{{ $transaksi->total_item }} Item</dd>
                        </div>
                    </dl>
                </div>
            </div>

            <!-- Order Details -->
            <div class="bg-white dark:bg-gray-800 rounded-lg shadow-sm border border-gray-200 dark:border-gray-700">
                <div class="px-6 py-4 border-b border-gray-200 dark:border-gray-700">
                    <h3 class="text-lg font-medium text-gray-900 dark:text-gray-100">Detail Pesanan</h3>
                </div>
                <div class="overflow-x-auto">
                    <table class="min-w-full divide-y divide-gray-200 dark:divide-gray-700">
                        <thead class="bg-gray-50 dark:bg-gray-700">
                            <tr>
                                <th scope="col" class="px-6 py-3 text-left text-xs font-medium text-gray-500 dark:text-gray-300 uppercase tracking-wider">
                                    Menu
                                </th>
                                <th scope="col" class="px-6 py-3 text-left text-xs font-medium text-gray-500 dark:text-gray-300 uppercase tracking-wider">
                                    Harga Satuan
                                </th>
                                <th scope="col" class="px-6 py-3 text-left text-xs font-medium text-gray-500 dark:text-gray-300 uppercase tracking-wider">
                                    Jumlah
                                </th>
                                <th scope="col" class="px-6 py-3 text-right text-xs font-medium text-gray-500 dark:text-gray-300 uppercase tracking-wider">
                                    Subtotal
                                </th>
                            </tr>
                        </thead>
                        <tbody class="bg-white dark:bg-gray-800 divide-y divide-gray-200 dark:divide-gray-700">
                            @foreach($transaksi->pesanan as $item)
                                @php
                                    // Handle both old and new data structure
                                    if (isset($item['nama_menu'])) {
                                        // New structure with nama_menu stored
                                        $namaMenu = $item['nama_menu'];
                                        $harga = $item['harga'];
                                        $subtotal = $item['subtotal'];
                                    } else {
                                        // Old structure - fetch from Menu model
                                        $menu = \App\Models\Menu::find($item['menu_id']);
                                        $namaMenu = $menu ? $menu->nama : 'Menu tidak ditemukan';
                                        $harga = $menu ? $menu->harga : 0;
                                        $subtotal = $harga * $item['jumlah'];
                                    }
                                @endphp
                                <tr>
                                    <td class="px-6 py-4 whitespace-nowrap">
                                        <div class="text-sm font-medium text-gray-900 dark:text-gray-100">
                                            {{ $namaMenu }}
                                        </div>
                                    </td>
                                    <td class="px-6 py-4 whitespace-nowrap">
                                        <div class="text-sm text-gray-900 dark:text-gray-100">
                                            Rp {{ number_format($harga, 0, ',', '.') }}
                                        </div>
                                    </td>
                                    <td class="px-6 py-4 whitespace-nowrap">
                                        <div class="text-sm text-gray-900 dark:text-gray-100">
                                            {{ $item['jumlah'] }}x
                                        </div>
                                    </td>
                                    <td class="px-6 py-4 whitespace-nowrap text-right">
                                        <div class="text-sm font-medium text-gray-900 dark:text-gray-100">
                                            Rp {{ number_format($subtotal, 0, ',', '.') }}
                                        </div>
                                    </td>
                                </tr>
                            @endforeach
                        </tbody>
                        <tfoot class="bg-gray-50 dark:bg-gray-700">
                            <tr>
                                <td colspan="3" class="px-6 py-4 text-right text-sm font-medium text-gray-900 dark:text-gray-100">
                                    Total Transaksi:
                                </td>
                                <td class="px-6 py-4 text-right text-lg font-bold text-blue-600 dark:text-blue-400">
                                    {{ $transaksi->formatted_total }}
                                </td>
                            </tr>
                        </tfoot>
                    </table>
                </div>
            </div>

            <!-- Action Section -->
            @if($transaksi->status == 'antri')
                <div class="bg-yellow-50 dark:bg-yellow-900/30 border border-yellow-200 dark:border-yellow-700 rounded-lg p-4">
                    <div class="flex items-center justify-between">
                        <div class="flex items-center">
                            <svg class="w-5 h-5 text-yellow-600 dark:text-yellow-400 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8v4l3 3m6-3a9 9 0 11-18 0 9 9 0 0118 0z"></path>
                            </svg>
                            <div>
                                <h4 class="text-sm font-medium text-yellow-800 dark:text-yellow-200">Transaksi Sedang Diproses</h4>
                                <p class="text-sm text-yellow-700 dark:text-yellow-300">Pesanan sedang dalam antrian dan akan segera diproses.</p>
                            </div>
                        </div>
                        <form action="{{ route('transaksi.update', $transaksi) }}" method="POST" class="inline-block">
                            @csrf
                            @method('PUT')
                            <input type="hidden" name="tanggal_transaksi" value="{{ $transaksi->tanggal_transaksi->format('Y-m-d\TH:i') }}">
                            <input type="hidden" name="status" value="selesai">
                            @foreach($transaksi->pesanan as $index => $item)
                                <input type="hidden" name="pesanan[{{ $index }}][menu_id]" value="{{ $item['menu_id'] }}">
                                <input type="hidden" name="pesanan[{{ $index }}][jumlah]" value="{{ $item['jumlah'] }}">
                            @endforeach
                            <button type="submit" class="inline-flex items-center px-4 py-2 bg-green-600 dark:bg-green-600 border border-transparent rounded-lg font-medium text-sm text-white hover:bg-green-700 dark:hover:bg-green-700 focus:outline-none focus:ring-2 focus:ring-green-500 focus:ring-offset-2 dark:focus:ring-offset-gray-800">
                                <svg class="w-4 h-4 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z"></path>
                                </svg>
                                Tandai Selesai
                            </button>
                        </form>
                    </div>
                </div>
            @else
                <div class="bg-green-50 dark:bg-green-900/30 border border-green-200 dark:border-green-700 rounded-lg p-4">
                    <div class="flex items-center">
                        <svg class="w-5 h-5 text-green-600 dark:text-green-400 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z"></path>
                        </svg>
                        <div>
                            <h4 class="text-sm font-medium text-green-800 dark:text-green-200">Transaksi Selesai</h4>
                            <p class="text-sm text-green-700 dark:text-green-300">Pesanan telah selesai diproses dan diserahkan kepada pelanggan.</p>
                        </div>
                    </div>
                </div>
            @endif

            <!-- Additional Actions -->
            <div class="bg-white dark:bg-gray-800 rounded-lg shadow-sm border border-gray-200 dark:border-gray-700 p-6">
                <h3 class="text-lg font-medium text-gray-900 dark:text-gray-100 mb-4">Aksi Lainnya</h3>
                <div class="flex flex-wrap gap-4">
                    <button onclick="window.print()" class="inline-flex items-center px-4 py-2 bg-gray-600 dark:bg-gray-600 border border-transparent rounded-lg font-medium text-sm text-white hover:bg-gray-700 dark:hover:bg-gray-700 focus:outline-none focus:ring-2 focus:ring-gray-500 focus:ring-offset-2 dark:focus:ring-offset-gray-800">
                        <svg class="w-4 h-4 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17 17h2a2 2 0 002-2v-4a2 2 0 00-2-2H5a2 2 0 00-2 2v4a2 2 0 002 2h2m2 4h6a2 2 0 002-2v-4a2 2 0 00-2-2H9a2 2 0 00-2 2v4a2 2 0 002 2zm8-12V5a2 2 0 00-2-2H9a2 2 0 00-2 2v4h10z"></path>
                        </svg>
                        Cetak Struk
                    </button>

                    <form action="{{ route('transaksi.destroy', $transaksi) }}" method="POST" class="inline-block" onsubmit="return confirm('Yakin ingin menghapus transaksi ini? Aksi ini tidak dapat dibatalkan.')">
                        @csrf
                        @method('DELETE')
                        <button type="submit" class="inline-flex items-center px-4 py-2 bg-red-600 dark:bg-red-600 border border-transparent rounded-lg font-medium text-sm text-white hover:bg-red-700 dark:hover:bg-red-700 focus:outline-none focus:ring-2 focus:ring-red-500 focus:ring-offset-2 dark:focus:ring-offset-gray-800">
                            <svg class="w-4 h-4 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 7l-.867 12.142A2 2 0 0116.138 21H7.862a2 2 0 01-1.995-1.858L5 7m5 4v6m4-6v6m1-10V4a1 1 0 00-1-1h-4a1 1 0 00-1 1v3M4 7h16"></path>
                            </svg>
                            Hapus Transaksi
                        </button>
                    </form>
                </div>
            </div>
        </div>
    </div>
</x-admin-layout>

<style>
@media print {
    /* Hide navigation and unnecessary elements when printing */
    .sidebar, .top-navigation, .action-buttons, button, form {
        display: none !important;
    }

    body {
        font-size: 12px;
    }

    .print-header {
        text-align: center;
        border-bottom: 2px solid #000;
        padding-bottom: 10px;
        margin-bottom: 20px;
    }
}
</style>
