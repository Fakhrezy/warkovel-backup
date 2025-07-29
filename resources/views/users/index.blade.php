<x-admin-layout>
    <x-slot name="header">
        Kelola User
    </x-slot>

    <div class="p-6">
        <div class="space-y-6">
            <!-- Header Section -->
            <div class="flex items-center justify-between">
                <div>
                    <h2 class="text-2xl font-bold text-gray-900 dark:text-gray-100">Kelola User</h2>
                    <p class="text-gray-600 dark:text-gray-400">Manage user accounts and permissions</p>
                </div>
                <a href="{{ route('users.create') }}"
                   class="inline-flex items-center px-4 py-2 text-sm font-medium text-white transition duration-150 ease-in-out bg-blue-600 border border-transparent rounded-lg dark:bg-blue-700 hover:bg-blue-700 dark:hover:bg-blue-600 focus:outline-none focus:ring-2 focus:ring-blue-500 focus:ring-offset-2 dark:focus:ring-offset-gray-800">
                    <svg class="w-4 h-4 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 6v6m0 0v6m0-6h6m-6 0H6"></path>
                    </svg>
                    Tambah User
                </a>
            </div>

            <!-- Alert Messages -->
            @if(session('success'))
                <div class="px-4 py-3 text-green-700 border border-green-200 rounded-lg bg-green-50 dark:bg-green-900/20 dark:border-green-800 dark:text-green-300">
                    <div class="flex">
                        <svg class="w-5 h-5 mr-2 text-green-600 dark:text-green-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7"></path>
                        </svg>
                        <span>{{ session('success') }}</span>
                    </div>
                </div>
            @endif

            @if(session('error'))
                <div class="px-4 py-3 text-red-700 border border-red-200 rounded-lg bg-red-50 dark:bg-red-900/20 dark:border-red-800 dark:text-red-300">
                    <div class="flex">
                        <svg class="w-5 h-5 mr-2 text-red-600 dark:text-red-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8v4m0 4h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z"></path>
                        </svg>
                        <span>{{ session('error') }}</span>
                    </div>
                </div>
            @endif

            <!-- Search & Filter Section -->
            <div class="bg-white border border-gray-200 rounded-lg shadow-sm dark:bg-gray-800 dark:border-gray-700">
                <div class="p-4">
                    <form method="GET" action="{{ route('users.index') }}" class="flex flex-col gap-4 sm:flex-row">
                        <div class="flex-1">
                            <label for="search" class="sr-only">Search users</label>
                            <div class="relative">
                                <div class="absolute inset-y-0 left-0 flex items-center pl-3 pointer-events-none">
                                    <svg class="w-5 h-5 text-gray-400 dark:text-gray-500" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M21 21l-6-6m2-5a7 7 0 11-14 0 7 7 0 0114 0z"></path>
                                    </svg>
                                </div>
                                <input id="search" name="search" type="text"
                                       value="{{ $search }}"
                                       placeholder="Cari berdasarkan nama atau email..."
                                       class="block w-full py-2 pl-10 pr-3 text-sm leading-5 text-gray-900 placeholder-gray-500 bg-white border border-gray-300 rounded-lg dark:border-gray-600 dark:bg-gray-700 dark:placeholder-gray-400 dark:text-gray-100 focus:outline-none focus:placeholder-gray-400 focus:ring-1 focus:ring-blue-500 focus:border-blue-500">
                            </div>
                        </div>
                        <div class="w-48">
                            <label for="role_filter" class="sr-only">Filter by role</label>
                            <select id="role_filter" name="role_filter"
                                    class="block w-full px-3 py-2 text-sm text-gray-900 bg-white border border-gray-300 rounded-lg dark:border-gray-600 dark:bg-gray-700 dark:text-gray-100 focus:outline-none focus:ring-1 focus:ring-blue-500 focus:border-blue-500">
                                <option value="">Semua Role</option>
                                <option value="admin" {{ request('role_filter') === 'admin' ? 'selected' : '' }}>Admin</option>
                                <option value="staff" {{ request('role_filter') === 'staff' ? 'selected' : '' }}>Staff</option>
                                <option value="kasir" {{ request('role_filter') === 'kasir' ? 'selected' : '' }}>Kasir</option>
                                <option value="barista" {{ request('role_filter') === 'barista' ? 'selected' : '' }}>Barista</option>
                            </select>
                        </div>
                        <div class="flex gap-2">
                            <button type="submit" class="inline-flex items-center px-4 py-2 text-sm font-medium text-gray-700 bg-white border border-gray-300 rounded-lg dark:border-gray-600 dark:text-gray-300 dark:bg-gray-700 hover:bg-gray-50 dark:hover:bg-gray-600 focus:outline-none focus:ring-2 focus:ring-blue-500 focus:ring-offset-2 dark:focus:ring-offset-gray-800">
                                <svg class="w-4 h-4 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M21 21l-6-6m2-5a7 7 0 11-14 0 7 7 0 0114 0z"></path>
                                </svg>
                                Cari
                            </button>
                            @if($search || request('role_filter'))
                                <a href="{{ route('users.index') }}" class="inline-flex items-center px-4 py-2 text-sm font-medium text-gray-700 bg-white border border-gray-300 rounded-lg dark:border-gray-600 dark:text-gray-300 dark:bg-gray-700 hover:bg-gray-50 dark:hover:bg-gray-600 focus:outline-none focus:ring-2 focus:ring-blue-500 focus:ring-offset-2 dark:focus:ring-offset-gray-800">
                                    <svg class="w-4 h-4 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12"></path>
                                    </svg>
                                    Reset
                                </a>
                            @endif
                        </div>
                    </form>
                </div>
            </div>

            <!-- Users Table -->
            <div class="overflow-hidden bg-white border border-gray-200 rounded-lg shadow-sm dark:bg-gray-800 dark:border-gray-700">
                <div class="overflow-x-auto">
                    <table class="min-w-full divide-y divide-gray-200 dark:divide-gray-700">
                        <thead class="bg-gray-50 dark:bg-gray-700">
                            <tr>
                                <th scope="col" class="px-6 py-3 text-xs font-medium tracking-wider text-left text-gray-500 uppercase dark:text-gray-400">
                                    User
                                </th>
                                <th scope="col" class="px-6 py-3 text-xs font-medium tracking-wider text-left text-gray-500 uppercase dark:text-gray-400">
                                    Email
                                </th>
                                <th scope="col" class="px-6 py-3 text-xs font-medium tracking-wider text-left text-gray-500 uppercase dark:text-gray-400">
                                    Role
                                </th>
                                <th scope="col" class="px-6 py-3 text-xs font-medium tracking-wider text-left text-gray-500 uppercase dark:text-gray-400">
                                    Tanggal Bergabung
                                </th>
                                <th scope="col" class="relative px-6 py-3">
                                    <span class="sr-only">Actions</span>
                                </th>
                            </tr>
                        </thead>
                        <tbody class="bg-white divide-y divide-gray-200 dark:bg-gray-800 dark:divide-gray-700">
                            @forelse($users as $user)
                                <tr class="hover:bg-gray-50 dark:hover:bg-gray-700">
                                    <td class="px-6 py-4 whitespace-nowrap">
                                        <div class="flex items-center">
                                            <div class="flex-shrink-0 w-10 h-10">
                                                <div class="flex items-center justify-center w-10 h-10 bg-blue-100 rounded-full dark:bg-blue-900/30">
                                                    <span class="text-sm font-medium text-blue-600 dark:text-blue-400">
                                                        {{ substr($user->name, 0, 2) }}
                                                    </span>
                                                </div>
                                            </div>
                                            <div class="ml-4">
                                                <div class="text-sm font-medium text-gray-900 dark:text-gray-100">
                                                    {{ $user->name }}
                                                </div>
                                                <div class="text-sm text-gray-500 dark:text-gray-400">
                                                    ID: {{ $user->id }}
                                                </div>
                                            </div>
                                        </div>
                                    </td>
                                    <td class="px-6 py-4 whitespace-nowrap">
                                        <div class="text-sm text-gray-900 dark:text-gray-100">{{ $user->email }}</div>
                                    </td>
                                    <td class="px-6 py-4 whitespace-nowrap">
                                        @php
                                            $roleColors = [
                                                'admin' => 'bg-red-100 dark:bg-red-900/30 text-red-800 dark:text-red-400',
                                                'staff' => 'bg-blue-100 dark:bg-blue-900/30 text-blue-800 dark:text-blue-400',
                                                'kasir' => 'bg-green-100 dark:bg-green-900/30 text-green-800 dark:text-green-400',
                                                'barista' => 'bg-purple-100 dark:bg-purple-900/30 text-purple-800 dark:text-purple-400',
                                            ];
                                            $color = $roleColors[$user->role] ?? 'bg-gray-100 dark:bg-gray-700 text-gray-800 dark:text-gray-300';
                                        @endphp
                                        <span class="inline-flex items-center px-2.5 py-0.5 rounded-full text-xs font-medium {{ $color }}">
                                            {{ ucfirst($user->role ?? 'No Role') }}
                                        </span>
                                    </td>
                                    <td class="px-6 py-4 whitespace-nowrap">
                                        <div class="text-sm text-gray-900 dark:text-gray-100">
                                            {{ $user->created_at->format('d M Y') }}
                                        </div>
                                        <div class="text-sm text-gray-500 dark:text-gray-400">
                                            {{ $user->created_at->format('H:i') }}
                                        </div>
                                    </td>
                                    <td class="px-6 py-4 text-sm font-medium text-right whitespace-nowrap">
                                        <div class="flex items-center space-x-2">
                                            <a href="{{ route('users.show', $user) }}"
                                               class="text-blue-600 transition-colors duration-200 dark:text-blue-400 hover:text-blue-900 dark:hover:text-blue-300"
                                               title="View">
                                                <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 12a3 3 0 11-6 0 3 3 0 016 0z"></path>
                                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M2.458 12C3.732 7.943 7.523 5 12 5c4.478 0 8.268 2.943 9.542 7-1.274 4.057-5.064 7-9.542 7-4.477 0-8.268-2.943-9.542-7z"></path>
                                                </svg>
                                            </a>
                                            <a href="{{ route('users.edit', $user) }}"
                                               class="text-indigo-600 transition-colors duration-200 dark:text-indigo-400 hover:text-indigo-900 dark:hover:text-indigo-300"
                                               title="Edit">
                                                <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M11 5H6a2 2 0 00-2 2v11a2 2 0 002 2h11a2 2 0 002-2v-5m-1.414-9.414a2 2 0 112.828 2.828L11.828 15H9v-2.828l8.586-8.586z"></path>
                                                </svg>
                                            </a>
                                            @if($user->id !== auth()->user()->id)
                                                <form action="{{ route('users.destroy', $user) }}" method="POST" class="inline-block">
                                                    @csrf
                                                    @method('DELETE')
                                                    <button type="submit"
                                                            class="text-red-600 transition-colors duration-200 dark:text-red-400 hover:text-red-900 dark:hover:text-red-300"
                                                            title="Delete"
                                                            onclick="return confirm('Apakah Anda yakin ingin menghapus user ini?')">
                                                        <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 7l-.867 12.142A2 2 0 0116.138 21H7.862a2 2 0 01-1.995-1.858L5 7m5 4v6m4-6v6m1-10V4a1 1 0 00-1-1h-4a1 1 0 00-1 1v3M4 7h16"></path>
                                                        </svg>
                                                    </button>
                                                </form>
                                            @else
                                                <span class="text-gray-400 dark:text-gray-500" title="Cannot delete your own account">
                                                    <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 7l-.867 12.142A2 2 0 0116.138 21H7.862a2 2 0 01-1.995-1.858L5 7m5 4v6m4-6v6m1-10V4a1 1 0 00-1-1h-4a1 1 0 00-1 1v3M4 7h16"></path>
                                                    </svg>
                                                </span>
                                            @endif
                                        </div>
                                    </td>
                                </tr>
                            @empty
                                <tr>
                                    <td colspan="5" class="px-6 py-12 text-center">
                                        <div class="flex flex-col items-center">
                                            <svg class="w-12 h-12 mb-4 text-gray-400 dark:text-gray-500" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4.354a4 4 0 110 5.292M15 21H3v-1a6 6 0 0112 0v1zm0 0h6v-1a6 6 0 00-9-5.197m13.5-9a2.5 2.5 0 11-5 0 2.5 2.5 0 015 0z"></path>
                                            </svg>
                                            <h3 class="mb-1 text-sm font-medium text-gray-900 dark:text-gray-100">Tidak ada user</h3>
                                            <p class="mb-4 text-sm text-gray-500 dark:text-gray-400">
                                                @if($search)
                                                    Tidak ada user yang sesuai dengan pencarian "{{ $search }}"
                                                @else
                                                    Belum ada user yang terdaftar dalam sistem.
                                                @endif
                                            </p>
                                            @if(!$search)
                                                <a href="{{ route('users.create') }}" class="inline-flex items-center px-4 py-2 text-sm font-medium text-white transition duration-150 ease-in-out bg-blue-600 border border-transparent rounded-lg dark:bg-blue-700 hover:bg-blue-700 dark:hover:bg-blue-600">
                                                    <svg class="w-4 h-4 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 6v6m0 0v6m0-6h6m-6 0H6"></path>
                                                    </svg>
                                                    Tambah User Pertama
                                                </a>
                                            @endif
                                        </div>
                                    </td>
                                </tr>
                            @endforelse
                        </tbody>
                    </table>
                </div>

                <!-- Pagination -->
                @if($users->hasPages())
                    <div class="px-6 py-3 border-t border-gray-200 dark:border-gray-700">
                        <div class="flex items-center justify-between">
                            <div class="flex items-center text-sm text-gray-500 dark:text-gray-400">
                                Menampilkan {{ $users->firstItem() }} sampai {{ $users->lastItem() }} dari {{ $users->total() }} user
                            </div>
                            <div class="flex items-center space-x-2">
                                {{-- Previous Page Link --}}
                                @if ($users->onFirstPage())
                                    <span class="px-3 py-1 text-sm text-gray-400 bg-white border border-gray-300 rounded cursor-not-allowed dark:text-gray-500 dark:bg-gray-700 dark:border-gray-600">&laquo;&laquo;</span>
                                    <span class="px-3 py-1 text-sm text-gray-400 bg-white border border-gray-300 rounded cursor-not-allowed dark:text-gray-500 dark:bg-gray-700 dark:border-gray-600">&laquo;</span>
                                @else
                                    <a href="{{ $users->url(1) }}" class="px-3 py-1 text-sm text-gray-700 bg-white border border-gray-300 rounded dark:text-gray-300 dark:bg-gray-700 dark:border-gray-600 hover:bg-gray-50 dark:hover:bg-gray-600">&laquo;&laquo;</a>
                                    <a href="{{ $users->previousPageUrl() }}" class="px-3 py-1 text-sm text-gray-700 bg-white border border-gray-300 rounded dark:text-gray-300 dark:bg-gray-700 dark:border-gray-600 hover:bg-gray-50 dark:hover:bg-gray-600">&laquo;</a>
                                @endif

                                {{-- Page Numbers --}}
                                @foreach ($users->getUrlRange(max(1, $users->currentPage() - 2), min($users->lastPage(), $users->currentPage() + 2)) as $page => $url)
                                    @if ($page == $users->currentPage())
                                        <span class="px-3 py-1 text-sm text-white bg-blue-600 border border-blue-600 rounded dark:bg-blue-700 dark:border-blue-700">{{ $page }}</span>
                                    @else
                                        <a href="{{ $url }}" class="px-3 py-1 text-sm text-gray-700 bg-white border border-gray-300 rounded dark:text-gray-300 dark:bg-gray-700 dark:border-gray-600 hover:bg-gray-50 dark:hover:bg-gray-600">{{ $page }}</a>
                                    @endif
                                @endforeach

                                {{-- Next Page Link --}}
                                @if ($users->hasMorePages())
                                    <a href="{{ $users->nextPageUrl() }}" class="px-3 py-1 text-sm text-gray-700 bg-white border border-gray-300 rounded dark:text-gray-300 dark:bg-gray-700 dark:border-gray-600 hover:bg-gray-50 dark:hover:bg-gray-600">&raquo;</a>
                                    <a href="{{ $users->url($users->lastPage()) }}" class="px-3 py-1 text-sm text-gray-700 bg-white border border-gray-300 rounded dark:text-gray-300 dark:bg-gray-700 dark:border-gray-600 hover:bg-gray-50 dark:hover:bg-gray-600">&raquo;&raquo;</a>
                                @else
                                    <span class="px-3 py-1 text-sm text-gray-400 bg-white border border-gray-300 rounded cursor-not-allowed dark:text-gray-500 dark:bg-gray-700 dark:border-gray-600">&raquo;</span>
                                    <span class="px-3 py-1 text-sm text-gray-400 bg-white border border-gray-300 rounded cursor-not-allowed dark:text-gray-500 dark:bg-gray-700 dark:border-gray-600">&raquo;&raquo;</span>
                                @endif
                            </div>
                        </div>
                    </div>
                @endif
            </div>
        </div>
    </div>
</x-admin-layout>
