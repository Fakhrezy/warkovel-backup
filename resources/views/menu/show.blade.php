<x-admin-layout>
    <x-slot name="header">
        Detail Menu
    </x-slot>

    <div class="p-6">
        <div class="max-w-2xl mx-auto">
            <div class="bg-white border border-gray-200 rounded-lg shadow-sm dark:bg-gray-800 dark:border-gray-700">
                <div class="px-6 py-4 border-b border-gray-200 dark:border-gray-700">
                    <div class="flex items-center justify-between">
                        <div>
                            <h3 class="text-lg font-semibold text-gray-800 dark:text-gray-100">Detail Menu</h3>
                            <p class="mt-1 text-sm text-gray-600 dark:text-gray-400">Informasi lengkap menu {{ $menu->nama }}</p>
                        </div>
                        <div class="flex space-x-2">
                            <a href="{{ route('menu.edit', $menu) }}"
                                class="inline-flex items-center px-3 py-2 text-sm font-medium text-white transition duration-150 ease-in-out border border-transparent rounded-lg bg-amber-600 hover:bg-amber-700 focus:outline-none focus:ring-2 focus:ring-amber-500 focus:ring-offset-2">
                                <svg class="w-4 h-4 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M11 5H6a2 2 0 00-2 2v11a2 2 0 002 2h11a2 2 0 002-2v-5m-1.414-9.414a2 2 0 112.828 2.828L11.828 15H9v-2.828l8.586-8.586z"></path>
                                </svg>
                                Edit
                            </a>
                        </div>
                    </div>
                </div>

                <div class="p-6 space-y-6">
                    <!-- Gambar Menu -->
                    @if($menu->gambar)
                    <div class="flex justify-center">
                        <div class="max-w-md">
                            <h4 class="mb-3 text-sm font-medium text-center text-gray-700 dark:text-gray-300">Gambar Menu</h4>
                            <div class="overflow-hidden rounded-lg shadow-md">
                                <img src="{{ asset('storage/' . $menu->gambar) }}"
                                     alt="{{ $menu->nama }}"
                                     class="object-cover w-full h-64">
                            </div>
                        </div>
                    </div>
                    @endif

                    <!-- Nama Menu -->
                    <div class="flex items-start space-x-4">
                        <div class="flex-shrink-0">
                            <div class="flex items-center justify-center w-12 h-12 bg-blue-100 rounded-lg dark:bg-blue-900/30">
                                <svg class="w-6 h-6 text-blue-600 dark:text-blue-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5H7a2 2 0 00-2 2v10a2 2 0 002 2h8a2 2 0 002-2V7a2 2 0 00-2-2h-2M9 5a2 2 0 002 2h2a2 2 0 002-2M9 5a2 2 0 012-2h2a2 2 0 012 2"></path>
                                </svg>
                            </div>
                        </div>
                        <div class="flex-1">
                            <h4 class="text-sm font-medium text-gray-700 dark:text-gray-300">Nama Menu</h4>
                            <p class="mt-1 text-lg font-semibold text-gray-900 dark:text-gray-100">{{ $menu->nama }}</p>
                        </div>
                    </div>

                    <!-- Kategori -->
                    <div class="flex items-start space-x-4">
                        <div class="flex-shrink-0">
                            <div class="flex items-center justify-center w-12 h-12 bg-green-100 rounded-lg dark:bg-green-900/30">
                                <svg class="w-6 h-6 text-green-600 dark:text-green-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M7 7h.01M7 3h5c.512 0 1.024.195 1.414.586l7 7a2 2 0 010 2.828l-7 7a2 2 0 01-2.828 0l-7-7A1.994 1.994 0 013 12V7a4 4 0 014-4z"></path>
                                </svg>
                            </div>
                        </div>
                        <div class="flex-1">
                            <h4 class="text-sm font-medium text-gray-700 dark:text-gray-300">Kategori</h4>
                            <span class="inline-flex items-center px-2.5 py-0.5 rounded-full text-xs font-medium mt-1
                                @if($menu->kategori == 'makanan') bg-orange-100 dark:bg-orange-900/30 text-orange-800 dark:text-orange-300
                                @else bg-blue-100 dark:bg-blue-900/30 text-blue-800 dark:text-blue-300
                                @endif">
                                {{ ucfirst($menu->kategori) }}
                            </span>
                        </div>
                    </div>

                    <!-- Harga -->
                    <div class="flex items-start space-x-4">
                        <div class="flex-shrink-0">
                            <div class="flex items-center justify-center w-12 h-12 rounded-lg bg-emerald-100 dark:bg-emerald-900/30">
                                <svg class="w-6 h-6 text-emerald-600 dark:text-emerald-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8c-1.657 0-3 .895-3 2s1.343 2 3 2 3 .895 3 2-1.343 2-3 2m0-8c1.11 0 2.08.402 2.599 1M12 8V7m0 1v8m0 0v1m0-1c-1.11 0-2.08-.402-2.599-1"></path>
                                </svg>
                            </div>
                        </div>
                        <div class="flex-1">
                            <h4 class="text-sm font-medium text-gray-700 dark:text-gray-300">Harga</h4>
                            <p class="mt-1 text-lg font-semibold text-gray-900 dark:text-gray-100">Rp {{ number_format($menu->harga, 0, ',', '.') }}</p>
                        </div>
                    </div>

                    <!-- Resep -->
                    <div class="flex items-start space-x-4">
                        <div class="flex-shrink-0">
                            <div class="flex items-center justify-center w-12 h-12 bg-purple-100 rounded-lg dark:bg-purple-900/30">
                                <svg class="w-6 h-6 text-purple-600 dark:text-purple-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12h6m-6 4h6m2 5H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z"></path>
                                </svg>
                            </div>
                        </div>
                        <div class="flex-1">
                            <h4 class="text-sm font-medium text-gray-700 dark:text-gray-300">Resep</h4>
                            <div class="p-4 mt-2 rounded-lg bg-gray-50 dark:bg-gray-700">
                                <p class="text-sm text-gray-900 whitespace-pre-line dark:text-gray-100">{{ $menu->resep }}</p>
                            </div>
                        </div>
                    </div>

                    <!-- Timestamps -->
                    <div class="pt-6 border-t border-gray-200 dark:border-gray-700">
                        <div class="grid grid-cols-1 gap-4 sm:grid-cols-2">
                            <div>
                                <h4 class="text-sm font-medium text-gray-700 dark:text-gray-300">Dibuat</h4>
                                <p class="mt-1 text-sm text-gray-900 dark:text-gray-100">{{ $menu->created_at->format('d M Y, H:i') }}</p>
                            </div>
                            <div>
                                <h4 class="text-sm font-medium text-gray-700 dark:text-gray-300">Terakhir Diperbarui</h4>
                                <p class="mt-1 text-sm text-gray-900 dark:text-gray-100">{{ $menu->updated_at->format('d M Y, H:i') }}</p>
                            </div>
                        </div>
                    </div>
                </div>

                <!-- Action Buttons -->
                <div class="flex items-center justify-between px-6 py-4 border-t border-gray-200 bg-gray-50 dark:bg-gray-700 dark:border-gray-600">
                    <a href="{{ route('menu.index') }}"
                        class="inline-flex items-center px-4 py-2 text-sm font-medium text-gray-700 transition duration-150 ease-in-out bg-white border border-gray-300 rounded-lg dark:border-gray-600 dark:text-gray-300 dark:bg-gray-600 hover:bg-gray-50 dark:hover:bg-gray-500 focus:outline-none focus:ring-2 focus:ring-gray-500 focus:ring-offset-2">
                        <svg class="w-4 h-4 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 19l-7-7 7-7"></path>
                        </svg>
                        Kembali ke Daftar Menu
                    </a>

                    <form action="{{ route('menu.destroy', $menu) }}" method="POST" class="inline"
                          onsubmit="return confirm('Apakah Anda yakin ingin menghapus menu ini?')">
                        @csrf
                        @method('DELETE')
                        <button type="submit"
                            class="inline-flex items-center px-4 py-2 text-sm font-medium text-white transition duration-150 ease-in-out bg-red-600 border border-transparent rounded-lg hover:bg-red-700 focus:outline-none focus:ring-2 focus:ring-red-500 focus:ring-offset-2">
                            <svg class="w-4 h-4 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 7l-.867 12.142A2 2 0 0116.138 21H7.862a2 2 0 01-1.995-1.858L5 7m5 4v6m4-6v6m1-10V4a1 1 0 00-1-1h-4a1 1 0 00-1 1v3M4 7h16"></path>
                            </svg>
                            Hapus Menu
                        </button>
                    </form>
                </div>
            </div>
        </div>
    </div>
</x-admin-layout>
