<x-admin-layout>
    <x-slot name="header">
        Dashboard Admin
    </x-slot>

    <div class="p-6">
        <div class="mx-auto space-y-6 max-w-7xl">
            <!-- Welcome Section -->
            <div class="overflow-hidden bg-white rounded-lg shadow-sm dark:bg-gray-800">
                <div class="p-6">
                    <h3 class="mb-2 text-2xl font-bold text-gray-800 dark:text-gray-100">
                        Selamat Datang, {{ Auth::user()->name }}!
                    </h3>
                    <p class="text-gray-600 dark:text-gray-400">Anda login sebagai: <span class="font-semibold text-blue-600 dark:text-blue-400">{{ Auth::user()->getRoleNames()->first() }}</span></p>
                </div>
            </div>

            <!-- Stats Cards -->
            <div class="grid grid-cols-1 gap-6 md:grid-cols-2 lg:grid-cols-4">
                <!-- Total Karyawan -->
                <div class="p-6 transition-shadow border border-blue-200 rounded-lg bg-blue-50 dark:bg-blue-900/20 dark:border-blue-800 hover:shadow-md">
                    <div class="flex items-center">
                        <div class="p-3 bg-blue-500 rounded-full bg-opacity-20 dark:bg-blue-500/30">
                            <svg class="w-6 h-6 text-blue-600 dark:text-blue-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17 20h5v-2a3 3 0 00-5.356-1.857M17 20H7m10 0v-2c0-.656-.126-1.283-.356-1.857M7 20H2v-2a3 3 0 015.356-1.857M7 20v-2c0-.656.126-1.283.356-1.857m0 0a5.002 5.002 0 019.288 0M15 7a3 3 0 11-6 0 3 3 0 016 0zm6 3a2 2 0 11-4 0 2 2 0 014 0zM7 10a2 2 0 11-4 0 2 2 0 014 0z"></path>
                            </svg>
                        </div>
                        <div class="ml-4">
                            <h4 class="text-lg font-semibold text-gray-800 dark:text-gray-100">Total Karyawan</h4>
                            <p class="text-2xl font-bold text-blue-600 dark:text-blue-400">{{ $stats['total_karyawan'] }}</p>
                        </div>
                    </div>
                </div>

                <!-- Penjualan Hari Ini -->
                <div class="p-6 transition-shadow border border-green-200 rounded-lg bg-green-50 dark:bg-green-900/20 dark:border-green-800 hover:shadow-md">
                    <div class="flex items-center">
                        <div class="p-3 bg-green-500 rounded-full bg-opacity-20 dark:bg-green-500/30">
                            <svg class="w-6 h-6 text-green-600 dark:text-green-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8c-1.657 0-3 .895-3 2s1.343 2 3 2 3 .895 3 2-1.343 2-3 2m0-8c1.11 0 2.08.402 2.599 1M12 8V7m0 1v8m0 0v1m0-1c-1.11 0-2.08-.402-2.599-1"></path>
                            </svg>
                        </div>
                        <div class="ml-4">
                            <h4 class="text-lg font-semibold text-gray-800 dark:text-gray-100">Penjualan Hari Ini</h4>
                            <p class="text-2xl font-bold text-green-600 dark:text-green-400">
                                {{ 'Rp ' . number_format($stats['penjualan_hari_ini'], 0, ',', '.') }}
                            </p>
                        </div>
                    </div>
                </div>

                <!-- Total Menu -->
                <div class="p-6 transition-shadow border border-yellow-200 rounded-lg bg-yellow-50 dark:bg-yellow-900/20 dark:border-yellow-800 hover:shadow-md">
                    <div class="flex items-center">
                        <div class="p-3 bg-yellow-500 rounded-full bg-opacity-20 dark:bg-yellow-500/30">
                            <svg class="w-6 h-6 text-yellow-600 dark:text-yellow-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5H7a2 2 0 00-2 2v10a2 2 0 002 2h8a2 2 0 002-2V7a2 2 0 00-2-2h-2M9 5a2 2 0 002 2h2a2 2 0 002-2M9 5a2 2 0 012-2h2a2 2 0 012 2"></path>
                            </svg>
                        </div>
                        <div class="ml-4">
                            <h4 class="text-lg font-semibold text-gray-800 dark:text-gray-100">Total Menu</h4>
                            <p class="text-2xl font-bold text-yellow-600 dark:text-yellow-400">{{ $stats['total_menu'] }}</p>
                        </div>
                    </div>
                </div>

                <!-- Total Pesanan -->
                <div class="p-6 transition-shadow border border-purple-200 rounded-lg bg-purple-50 dark:bg-purple-900/20 dark:border-purple-800 hover:shadow-md">
                    <div class="flex items-center">
                        <div class="p-3 bg-purple-500 rounded-full bg-opacity-20 dark:bg-purple-500/30">
                            <svg class="w-6 h-6 text-purple-600 dark:text-purple-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 19v-6a2 2 0 00-2-2H5a2 2 0 00-2 2v6a2 2 0 002 2h2a2 2 0 002-2zm0 0V9a2 2 0 012-2h2a2 2 0 012 2v10m-6 0a2 2 0 002 2h2a2 2 0 002-2m0 0V5a2 2 0 012-2h2a2 2 0 012 2v4a2 2 0 01-2 2h-2a2 2 0 01-2-2z"></path>
                            </svg>
                        </div>
                        <div class="ml-4">
                            <h4 class="text-lg font-semibold text-gray-800 dark:text-gray-100">Total Transaksi</h4>
                            <p class="text-2xl font-bold text-purple-600 dark:text-purple-400">{{ $stats['total_transaksi'] }}</p>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Charts Section -->
            <div class="grid grid-cols-1 gap-6 lg:grid-cols-2">
                <!-- Grafik Penjualan Mingguan -->
                <div class="p-6 transition-shadow bg-white border border-gray-200 rounded-lg shadow-sm dark:bg-gray-800 dark:border-gray-700 hover:shadow-md">
                    <h3 class="mb-4 text-lg font-semibold text-gray-800 dark:text-gray-100">Grafik Penjualan (7 Hari Terakhir)</h3>
                    <div class="h-80">
                        <canvas id="salesChart"></canvas>
                    </div>
                </div>

                <!-- Menu Paling Laku -->
                <div class="p-6 transition-shadow bg-white border border-gray-200 rounded-lg shadow-sm dark:bg-gray-800 dark:border-gray-700 hover:shadow-md">
                    <h3 class="mb-4 text-lg font-semibold text-gray-800 dark:text-gray-100">Menu Paling Laku</h3>
                    <div class="h-80">
                        <canvas id="menuChart"></canvas>
                    </div>
                </div>
            </div>

            <!-- Quick Actions Section -->
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
        function getSweetAlertConfig(type = 'success') {
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

        // Data dari Laravel
        const salesData = @json($salesData);
        const topMenus = @json($topMenus);

        // Function to get chart colors based on theme
        function getChartColors() {
            const isDark = document.documentElement.classList.contains('dark');
            return {
                background: isDark ? 'rgb(31, 41, 55)' : 'rgb(255, 255, 255)',
                text: isDark ? 'rgb(229, 231, 235)' : 'rgb(75, 85, 99)',
                grid: isDark ? 'rgba(75, 85, 99, 0.3)' : 'rgba(156, 163, 175, 0.3)',
                border: isDark ? 'rgb(75, 85, 99)' : 'rgb(209, 213, 219)',
                pointBorder: isDark ? 'rgb(31, 41, 55)' : 'rgb(255, 255, 255)',
                tooltip: {
                    background: isDark ? 'rgb(55, 65, 81)' : 'rgb(255, 255, 255)',
                    text: isDark ? 'rgb(229, 231, 235)' : 'rgb(31, 41, 55)',
                    border: isDark ? 'rgb(75, 85, 99)' : 'rgb(209, 213, 219)'
                }
            };
        }

        // Line Chart - Penjualan
        const salesCtx = document.getElementById('salesChart').getContext('2d');
        const salesChart = new Chart(salesCtx, {
            type: 'line',
            data: {
                labels: salesData.map(item => item.date),
                datasets: [{
                    label: 'Penjualan (Rp)',
                    data: salesData.map(item => item.sales),
                    borderColor: 'rgb(59, 130, 246)',
                    backgroundColor: 'rgba(59, 130, 246, 0.1)',
                    borderWidth: 3,
                    fill: true,
                    tension: 0.4,
                    pointBackgroundColor: 'rgb(59, 130, 246)',
                    pointBorderColor: getChartColors().pointBorder,
                    pointBorderWidth: 2,
                    pointRadius: 6,
                    pointHoverRadius: 8
                }]
            },
            options: {
                responsive: true,
                maintainAspectRatio: false,
                interaction: {
                    intersect: false,
                    mode: 'index'
                },
                plugins: {
                    legend: {
                        display: false
                    },
                    tooltip: {
                        backgroundColor: getChartColors().tooltip.background,
                        titleColor: getChartColors().tooltip.text,
                        bodyColor: getChartColors().tooltip.text,
                        borderColor: getChartColors().tooltip.border,
                        borderWidth: 1,
                        cornerRadius: 8,
                        displayColors: false,
                        titleFont: {
                            size: 13,
                            weight: 'bold'
                        },
                        bodyFont: {
                            size: 12
                        },
                        padding: 12,
                        callbacks: {
                            title: function(context) {
                                return 'Tanggal: ' + context[0].label;
                            },
                            label: function(context) {
                                return 'Total Penjualan: Rp ' + context.parsed.y.toLocaleString('id-ID');
                            }
                        }
                    }
                },
                scales: {
                    y: {
                        beginAtZero: true,
                        title: {
                            display: true,
                            text: 'Penjualan (Rp)',
                            color: getChartColors().text,
                            font: {
                                size: 12,
                                weight: 'bold'
                            }
                        },
                        ticks: {
                            display: true,
                            color: getChartColors().text,
                            font: {
                                size: 11
                            },
                            callback: function(value) {
                                return 'Rp ' + value.toLocaleString('id-ID');
                            }
                        },
                        grid: {
                            color: getChartColors().grid,
                            drawBorder: false
                        }
                    },
                    x: {
                        title: {
                            display: true,
                            text: 'Hari',
                            color: getChartColors().text,
                            font: {
                                size: 12,
                                weight: 'bold'
                            }
                        },
                        ticks: {
                            display: true,
                            color: getChartColors().text,
                            font: {
                                size: 11
                            }
                        },
                        grid: {
                            display: false
                        }
                    }
                },
                elements: {
                    point: {
                        hoverBackgroundColor: 'rgb(59, 130, 246)',
                        hoverBorderColor: '#fff',
                        hoverBorderWidth: 3
                    }
                }
            }
        });

        // Bar Chart - Menu Paling Laku
        const menuCtx = document.getElementById('menuChart').getContext('2d');
        const menuChart = new Chart(menuCtx, {
            type: 'bar',
            data: {
                labels: topMenus.map(item => item.nama_menu),
                datasets: [{
                    label: 'Total Terjual',
                    data: topMenus.map(item => item.total_terjual),
                    backgroundColor: [
                        'rgba(34, 197, 94, 0.8)',
                        'rgba(59, 130, 246, 0.8)',
                        'rgba(251, 191, 36, 0.8)',
                        'rgba(239, 68, 68, 0.8)',
                        'rgba(168, 85, 247, 0.8)'
                    ],
                    borderColor: [
                        'rgb(34, 197, 94)',
                        'rgb(59, 130, 246)',
                        'rgb(251, 191, 36)',
                        'rgb(239, 68, 68)',
                        'rgb(168, 85, 247)'
                    ],
                    borderWidth: 2,
                    borderRadius: 6,
                    borderSkipped: false,
                    hoverBackgroundColor: [
                        'rgba(34, 197, 94, 0.9)',
                        'rgba(59, 130, 246, 0.9)',
                        'rgba(251, 191, 36, 0.9)',
                        'rgba(239, 68, 68, 0.9)',
                        'rgba(168, 85, 247, 0.9)'
                    ]
                }]
            },
            options: {
                responsive: true,
                maintainAspectRatio: false,
                plugins: {
                    legend: {
                        display: false
                    },
                    tooltip: {
                        backgroundColor: getChartColors().tooltip.background,
                        titleColor: getChartColors().tooltip.text,
                        bodyColor: getChartColors().tooltip.text,
                        borderColor: getChartColors().tooltip.border,
                        borderWidth: 1,
                        cornerRadius: 8,
                        displayColors: false,
                        titleFont: {
                            size: 13,
                            weight: 'bold'
                        },
                        bodyFont: {
                            size: 12
                        },
                        padding: 12,
                        callbacks: {
                            title: function(context) {
                                return context[0].label;
                            },
                            label: function(context) {
                                return 'Total Terjual: ' + context.parsed.y + ' porsi';
                            }
                        }
                    }
                },
                scales: {
                    y: {
                        beginAtZero: true,
                        title: {
                            display: true,
                            text: 'Jumlah Terjual',
                            color: getChartColors().text,
                            font: {
                                size: 12,
                                weight: 'bold'
                            }
                        },
                        ticks: {
                            stepSize: 1,
                            color: getChartColors().text,
                            font: {
                                size: 11
                            },
                            callback: function(value) {
                                return value + ' porsi';
                            }
                        },
                        grid: {
                            color: getChartColors().grid,
                            drawBorder: false
                        }
                    },
                    x: {
                        title: {
                            display: true,
                            text: 'Menu',
                            color: getChartColors().text,
                            font: {
                                size: 12,
                                weight: 'bold'
                            }
                        },
                        ticks: {
                            color: getChartColors().text,
                            font: {
                                size: 11
                            },
                            maxRotation: 45,
                            minRotation: 0
                        },
                        grid: {
                            display: false
                        }
                    }
                }
            }
        });

        // Function to update chart colors when theme changes
        function updateChartColors() {
            const colors = getChartColors();

            // Update sales chart
            salesChart.options.scales.y.title.color = colors.text;
            salesChart.options.scales.y.ticks.color = colors.text;
            salesChart.options.scales.y.grid.color = colors.grid;
            salesChart.options.scales.x.title.color = colors.text;
            salesChart.options.scales.x.ticks.color = colors.text;
            salesChart.options.plugins.tooltip.backgroundColor = colors.tooltip.background;
            salesChart.options.plugins.tooltip.titleColor = colors.tooltip.text;
            salesChart.options.plugins.tooltip.bodyColor = colors.tooltip.text;
            salesChart.options.plugins.tooltip.borderColor = colors.tooltip.border;

            // Update sales chart dataset colors
            salesChart.data.datasets[0].pointBorderColor = colors.pointBorder;

            salesChart.update('none'); // Update without animation for smooth transition

            // Update menu chart
            menuChart.options.scales.y.title.color = colors.text;
            menuChart.options.scales.y.ticks.color = colors.text;
            menuChart.options.scales.y.grid.color = colors.grid;
            menuChart.options.scales.x.title.color = colors.text;
            menuChart.options.scales.x.ticks.color = colors.text;
            menuChart.options.plugins.tooltip.backgroundColor = colors.tooltip.background;
            menuChart.options.plugins.tooltip.titleColor = colors.tooltip.text;
            menuChart.options.plugins.tooltip.bodyColor = colors.tooltip.text;
            menuChart.options.plugins.tooltip.borderColor = colors.tooltip.border;
            menuChart.update('none'); // Update without animation for smooth transition
        }

        // Listen for theme changes and update charts
        const observer = new MutationObserver(function(mutations) {
            mutations.forEach(function(mutation) {
                if (mutation.type === 'attributes' && mutation.attributeName === 'class') {
                    // Add a small delay to ensure the theme change is complete
                    setTimeout(updateChartColors, 50);
                }
            });
        });

        observer.observe(document.documentElement, {
            attributes: true,
            attributeFilter: ['class']
        });

        // Listen for system theme changes
        const mediaQuery = window.matchMedia('(prefers-color-scheme: dark)');
        mediaQuery.addEventListener('change', function(e) {
            // Update charts when system theme changes
            setTimeout(updateChartColors, 100);
        });

        // Initialize chart colors on load
        document.addEventListener('DOMContentLoaded', function() {
            updateChartColors();
        });

        // Also update colors when the page is fully loaded
        window.addEventListener('load', function() {
            updateChartColors();
        });
    </script>
</x-admin-layout>
