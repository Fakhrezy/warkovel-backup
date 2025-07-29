<x-admin-layout>
    <x-slot name="header">
        Detail Karyawan
    </x-slot>

    <div class="p-6">
        <div class="max-w-4xl mx-auto">
            <!-- Header -->
            <div class="mb-6 bg-white border border-gray-200 rounded-lg shadow-sm dark:bg-gray-800 dark:border-gray-700">
                <div class="flex items-center justify-between px-6 py-4 border-b border-gray-200 dark:border-gray-700">
                    <div>
                        <h2 class="text-xl font-semibold text-gray-800 dark:text-gray-100">Detail Karyawan</h2>
                        <p class="mt-1 text-sm text-gray-600 dark:text-gray-400">Informasi lengkap karyawan: {{ $karyawan->nama }}</p>
                    </div>
                    <div>
                        <a href="{{ route('karyawan.index') }}" class="inline-flex items-center px-4 py-2 text-xs font-semibold tracking-widest text-white uppercase transition duration-150 ease-in-out bg-gray-600 border border-transparent rounded-md hover:bg-gray-700 focus:bg-gray-700 active:bg-gray-900 focus:outline-none focus:ring-2 focus:ring-gray-500 focus:ring-offset-2">
                            <svg class="w-4 h-4 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10 19l-7-7m0 0l7-7m-7 7h18"></path>
                            </svg>
                            Kembali
                        </a>
                    </div>
                </div>
            </div>

            <!-- Detail Content -->
            <div class="grid grid-cols-1 gap-6 lg:grid-cols-3">
                <!-- Main Information -->
                <div class="lg:col-span-2">
                    <div class="bg-white border border-gray-200 rounded-lg shadow-sm dark:bg-gray-800 dark:border-gray-700">
                        <div class="px-6 py-4 border-b border-gray-200 dark:border-gray-700">
                            <h3 class="text-lg font-semibold text-gray-800 dark:text-gray-100">Informasi Karyawan</h3>
                        </div>
                        <div class="p-6">
                            <dl class="grid grid-cols-1 gap-6 sm:grid-cols-2">
                                <div>
                                    <dt class="text-sm font-medium text-gray-500 dark:text-gray-400">ID Karyawan</dt>
                                    <dd class="mt-1 text-sm text-gray-900 dark:text-gray-100">#{{ $karyawan->id }}</dd>
                                </div>

                                <div>
                                    <dt class="text-sm font-medium text-gray-500 dark:text-gray-400">Nama Lengkap</dt>
                                    <dd class="mt-1 text-sm font-medium text-gray-900 dark:text-gray-100">{{ $karyawan->nama }}</dd>
                                </div>

                                <div>
                                    <dt class="text-sm font-medium text-gray-500 dark:text-gray-400">Umur</dt>
                                    <dd class="mt-1 text-sm text-gray-900 dark:text-gray-100">{{ $karyawan->umur }} tahun</dd>
                                </div>

                                <div>
                                    <dt class="text-sm font-medium text-gray-500 dark:text-gray-400">Jenis Kelamin</dt>
                                    <dd class="mt-1 text-sm text-gray-900 dark:text-gray-100">{{ $karyawan->jenis_kelamin }}</dd>
                                </div>

                                <div>
                                    <dt class="text-sm font-medium text-gray-500 dark:text-gray-400">Posisi</dt>
                                    <dd class="mt-1">
                                        <span class="inline-flex px-2 py-1 text-xs font-semibold rounded-full
                                            @if($karyawan->posisi == 'admin') bg-red-100 dark:bg-red-900/30 text-red-800 dark:text-red-300
                                            @elseif($karyawan->posisi == 'barista') bg-yellow-100 dark:bg-yellow-900/30 text-yellow-800 dark:text-yellow-300
                                            @elseif($karyawan->posisi == 'kasir') bg-green-100 dark:bg-green-900/30 text-green-800 dark:text-green-300
                                            @else bg-blue-100 dark:bg-blue-900/30 text-blue-800 dark:text-blue-300
                                            @endif">
                                            {{ ucfirst($karyawan->posisi) }}
                                        </span>
                                    </dd>
                                </div>

                                <div>
                                    <dt class="text-sm font-medium text-gray-500 dark:text-gray-400">Gaji</dt>
                                    <dd class="mt-1 text-sm font-semibold text-gray-900 dark:text-gray-100">{{ $karyawan->formatted_gaji }}</dd>
                                </div>

                                <div class="sm:col-span-2">
                                    <dt class="text-sm font-medium text-gray-500 dark:text-gray-400">Alamat</dt>
                                    <dd class="mt-1 text-sm text-gray-900 dark:text-gray-100">{{ $karyawan->alamat }}</dd>
                                </div>

                                <div>
                                    <dt class="text-sm font-medium text-gray-500 dark:text-gray-400">Status</dt>
                                    <dd class="mt-1">
                                        @if($karyawan->status == 'aktif')
                                        <span class="inline-flex px-2 py-1 text-xs font-semibold text-green-800 bg-green-100 rounded-full dark:bg-green-900/30 dark:text-green-300">
                                            Aktif
                                        </span>
                                        @else
                                        <span class="inline-flex px-2 py-1 text-xs font-semibold text-red-800 bg-red-100 rounded-full dark:bg-red-900/30 dark:text-red-300">
                                            Tidak Aktif
                                        </span>
                                        @endif
                                    </dd>
                                </div>

                                @if($karyawan->user)
                                <div>
                                    <dt class="text-sm font-medium text-gray-500 dark:text-gray-400">Email</dt>
                                    <dd class="mt-1 text-sm text-gray-900 dark:text-gray-100">{{ $karyawan->user->email }}</dd>
                                </div>
                                @endif
                            </dl>
                        </div>
                    </div>
                </div>

                <!-- Side Information -->
                <div class="space-y-6">
                    <!-- Quick Actions -->
                    <div class="bg-white border border-gray-200 rounded-lg shadow-sm dark:bg-gray-800 dark:border-gray-700">
                        <div class="px-6 py-4 border-b border-gray-200 dark:border-gray-700">
                            <h3 class="text-lg font-semibold text-gray-800 dark:text-gray-100">Aksi</h3>
                        </div>
                        <div class="p-6 space-y-3">
                            <a href="{{ route('karyawan.edit', $karyawan) }}" class="flex items-center w-full p-3 transition-colors rounded-lg bg-yellow-50 dark:bg-yellow-900/20 hover:bg-yellow-100 dark:hover:bg-yellow-900/30 group">
                                <svg class="w-5 h-5 mr-3 text-yellow-600 dark:text-yellow-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M11 5H6a2 2 0 00-2 2v11a2 2 0 002 2h11a2 2 0 002-2v-5m-1.414-9.414a2 2 0 112.828 2.828L11.828 15H9v-2.828l8.586-8.586z"></path>
                                </svg>
                                <span class="text-sm font-medium text-gray-800 dark:text-gray-100 group-hover:text-yellow-800 dark:group-hover:text-yellow-300">Edit Data</span>
                            </a>

                            <form action="{{ route('karyawan.destroy', $karyawan) }}" method="POST"
                                  onsubmit="return confirm('Apakah Anda yakin ingin menghapus data karyawan {{ $karyawan->nama }}? Tindakan ini tidak dapat dibatalkan.')">
                                @csrf
                                @method('DELETE')
                                <button type="submit" class="flex items-center w-full p-3 transition-colors rounded-lg bg-red-50 dark:bg-red-900/20 hover:bg-red-100 dark:hover:bg-red-900/30 group">
                                    <svg class="w-5 h-5 mr-3 text-red-600 dark:text-red-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 7l-.867 12.142A2 2 0 0116.138 21H7.862a2 2 0 01-1.995-1.858L5 7m5 4v6m4-6v6m1-10V4a1 1 0 00-1-1h-4a1 1 0 00-1 1v3M4 7h16"></path>
                                    </svg>
                                    <span class="text-sm font-medium text-gray-800 dark:text-gray-100 group-hover:text-red-800 dark:group-hover:text-red-300">Hapus Data</span>
                                </button>
                            </form>
                        </div>
                    </div>

                    <!-- Additional Info -->
                    <div class="bg-white border border-gray-200 rounded-lg shadow-sm dark:bg-gray-800 dark:border-gray-700">
                        <div class="px-6 py-4 border-b border-gray-200 dark:border-gray-700">
                            <h3 class="text-lg font-semibold text-gray-800 dark:text-gray-100">Informasi Tambahan</h3>
                        </div>
                        <div class="p-6">
                            <div class="space-y-4">
                                <div class="p-4 text-center rounded-lg bg-blue-50 dark:bg-blue-900/20">
                                    <svg class="w-8 h-8 mx-auto mb-2 text-blue-600 dark:text-blue-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8v4l3 3m6-3a9 9 0 11-18 0 9 9 0 0118 0z"></path>
                                    </svg>
                                    <p class="text-sm text-gray-600 dark:text-gray-400">Data terakhir diperbarui</p>
                                    <p class="text-xs font-medium text-blue-600 dark:text-blue-400">{{ $karyawan->updated_at->diffForHumans() }}</p>
                                </div>

                                <div class="p-4 text-center rounded-lg bg-green-50 dark:bg-green-900/20">
                                    <svg class="w-8 h-8 mx-auto mb-2 text-green-600 dark:text-green-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 6v6m0 0v6m0-6h6m-6 0H6"></path>
                                    </svg>
                                    <p class="text-sm text-gray-600 dark:text-gray-400">Terdaftar sejak</p>
                                    <p class="text-xs font-medium text-green-600 dark:text-green-400">{{ $karyawan->created_at->format('d M Y') }}</p>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</x-admin-layout>
