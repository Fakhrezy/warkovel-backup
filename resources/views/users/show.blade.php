<x-admin-layout>
    <x-slot name="header">
        Detail User
    </x-slot>

    <div class="p-6">
        <div class="max-w-4xl mx-auto space-y-6">
            <!-- Header -->
            <div class="bg-white border border-gray-200 rounded-lg shadow-sm dark:bg-gray-800 dark:border-gray-700">
                <div class="px-6 py-4 border-b border-gray-200 dark:border-gray-700">
                    <div class="flex items-center justify-between">
                        <div>
                            <h2 class="text-xl font-semibold text-gray-800 dark:text-gray-100">Detail User</h2>
                            <p class="mt-1 text-sm text-gray-600 dark:text-gray-300">Informasi lengkap user {{ $user->name }}</p>
                        </div>
                        <a href="{{ route('users.index') }}" class="inline-flex items-center px-4 py-2 text-sm font-medium text-white transition duration-150 ease-in-out bg-gray-500 border border-transparent rounded-lg dark:bg-gray-600 hover:bg-gray-600 dark:hover:bg-gray-700 focus:outline-none focus:ring-2 focus:ring-gray-500 dark:focus:ring-gray-400 focus:ring-offset-2 dark:focus:ring-offset-gray-800">
                            <svg class="w-4 h-4 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10 19l-7-7m0 0l7-7m-7 7h18"></path>
                            </svg>
                            Kembali
                        </a>
                    </div>
                </div>
            </div>

            <!-- User Information -->
            <div class="bg-white border border-gray-200 rounded-lg shadow-sm dark:bg-gray-800 dark:border-gray-700">
                <div class="px-6 py-4 border-b border-gray-200 dark:border-gray-700">
                    <h3 class="text-lg font-medium text-gray-900 dark:text-gray-100">Informasi User</h3>
                </div>
                <div class="p-6">
                    <div class="grid grid-cols-1 gap-6 md:grid-cols-2">
                        <!-- Avatar & Basic Info -->
                        <div class="space-y-6">
                            <div class="flex items-center space-x-4">
                                <div class="flex-shrink-0">
                                    <div class="flex items-center justify-center w-20 h-20 bg-blue-100 rounded-full dark:bg-blue-900/30">
                                        <span class="text-2xl font-medium text-blue-600 dark:text-blue-400">
                                            {{ substr($user->name, 0, 2) }}
                                        </span>
                                    </div>
                                </div>
                                <div>
                                    <h4 class="text-xl font-semibold text-gray-900 dark:text-gray-100">{{ $user->name }}</h4>
                                    <p class="text-sm text-gray-500 dark:text-gray-400">User ID: {{ $user->id }}</p>
                                </div>
                            </div>

                            <div class="space-y-4">
                                <!-- Name -->
                                <div>
                                    <label class="block text-sm font-medium text-gray-500 dark:text-gray-400">Nama Lengkap</label>
                                    <p class="mt-1 text-sm text-gray-900 dark:text-gray-100">{{ $user->name }}</p>
                                </div>

                                <!-- Email -->
                                <div>
                                    <label class="block text-sm font-medium text-gray-500 dark:text-gray-400">Email</label>
                                    <p class="mt-1 text-sm text-gray-900 dark:text-gray-100">{{ $user->email }}</p>
                                </div>

                                <!-- Email Verification Status -->
                                <div>
                                    <label class="block text-sm font-medium text-gray-500 dark:text-gray-400">Status Email</label>
                                    <div class="mt-1">
                                        @if($user->email_verified_at)
                                            <span class="inline-flex items-center px-3 py-1 text-sm font-medium text-green-800 bg-green-100 rounded-full dark:bg-green-900/30 dark:text-green-200">
                                                <svg class="w-4 h-4 mr-1" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7"></path>
                                                </svg>
                                                Verified
                                            </span>
                                            <p class="mt-1 text-xs text-gray-500 dark:text-gray-400">
                                                Diverifikasi pada {{ $user->email_verified_at->format('d M Y H:i') }}
                                            </p>
                                        @else
                                            <span class="inline-flex items-center px-3 py-1 text-sm font-medium text-yellow-800 bg-yellow-100 rounded-full dark:bg-yellow-900/30 dark:text-yellow-200">
                                                <svg class="w-4 h-4 mr-1" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8v4m0 4h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z"></path>
                                                </svg>
                                                Belum Diverifikasi
                                            </span>
                                        @endif
                                    </div>
                                </div>
                            </div>
                        </div>

                        <!-- Account Details -->
                        <div class="space-y-4">
                            <!-- Created At -->
                            <div>
                                <label class="block text-sm font-medium text-gray-500 dark:text-gray-400">Tanggal Bergabung</label>
                                <p class="mt-1 text-sm text-gray-900 dark:text-gray-100">{{ $user->created_at->format('d M Y H:i') }}</p>
                                <p class="text-xs text-gray-500 dark:text-gray-400">{{ $user->created_at->diffForHumans() }}</p>
                            </div>

                            <!-- Updated At -->
                            <div>
                                <label class="block text-sm font-medium text-gray-500 dark:text-gray-400">Terakhir Diperbarui</label>
                                <p class="mt-1 text-sm text-gray-900 dark:text-gray-100">{{ $user->updated_at->format('d M Y H:i') }}</p>
                                <p class="text-xs text-gray-500 dark:text-gray-400">{{ $user->updated_at->diffForHumans() }}</p>
                            </div>

                            <!-- Current User Check -->
                            @if($user->id === auth()->user()->id)
                                <div class="p-3 border border-blue-200 rounded-lg bg-blue-50 dark:bg-blue-900/30 dark:border-blue-700">
                                    <div class="flex">
                                        <svg class="w-5 h-5 mr-2 text-blue-600 dark:text-blue-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13 16h-1v-4h-1m1-4h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z"></path>
                                        </svg>
                                        <div class="text-sm text-blue-700 dark:text-blue-300">
                                            <p class="font-medium">Akun Anda</p>
                                            <p>Ini adalah akun yang sedang Anda gunakan saat ini.</p>
                                        </div>
                                    </div>
                                </div>
                            @endif
                        </div>
                    </div>
                </div>
            </div>

            <!-- Actions -->
            @if($user->id !== auth()->user()->id)
                <div class="bg-white border border-gray-200 rounded-lg shadow-sm dark:bg-gray-800 dark:border-gray-700">
                    <div class="px-6 py-4 border-b border-gray-200 dark:border-gray-700">
                        <h3 class="text-lg font-medium text-gray-900 dark:text-gray-100">Aksi</h3>
                    </div>
                    <div class="p-6">
                        <div class="flex items-center space-x-4">
                            <a href="{{ route('users.edit', $user) }}" class="inline-flex items-center px-4 py-2 text-sm font-medium text-white transition duration-150 ease-in-out bg-blue-600 border border-transparent rounded-lg dark:bg-blue-600 hover:bg-blue-700 dark:hover:bg-blue-700 focus:outline-none focus:ring-2 focus:ring-blue-500 focus:ring-offset-2 dark:focus:ring-offset-gray-800">
                                <svg class="w-4 h-4 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M11 5H6a2 2 0 00-2 2v11a2 2 0 002 2h11a2 2 0 002-2v-5m-1.414-9.414a2 2 0 112.828 2.828L11.828 15H9v-2.828l8.586-8.586z"></path>
                                </svg>
                                Edit User
                            </a>

                            <form action="{{ route('users.destroy', $user) }}" method="POST" class="inline-block">
                                @csrf
                                @method('DELETE')
                                <button type="submit"
                                        class="inline-flex items-center px-4 py-2 text-sm font-medium text-white transition duration-150 ease-in-out bg-red-600 border border-transparent rounded-lg dark:bg-red-600 hover:bg-red-700 dark:hover:bg-red-700 focus:outline-none focus:ring-2 focus:ring-red-500 focus:ring-offset-2 dark:focus:ring-offset-gray-800"
                                        onclick="return confirm('Apakah Anda yakin ingin menghapus user ini? Tindakan ini tidak dapat dibatalkan.')">
                                    <svg class="w-4 h-4 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 7l-.867 12.142A2 2 0 0116.138 21H7.862a2 2 0 01-1.995-1.858L5 7m5 4v6m4-6v6m1-10V4a1 1 0 00-1-1h-4a1 1 0 00-1 1v3M4 7h16"></path>
                                    </svg>
                                    Hapus User
                                </button>
                            </form>
                        </div>
                    </div>
                </div>
            @endif
        </div>
    </div>
</x-admin-layout>
