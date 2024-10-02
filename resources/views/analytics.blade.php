<x-app-layout>
    <x-slot name="header">
        <div class="flex items-center justify-between">
            <h2 class="font-semibold text-3xl text-gray-800 leading-tight">
                {{ __('Analytics Dashboard') }}
            </h2>
        </div>
    </x-slot>

    <div class="py-12 bg-gradient-to-r from-purple-50 to-indigo-50 min-h-screen">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <!-- Overview Cards Section -->
            <div class="grid grid-cols-1 md:grid-cols-3 gap-8 mb-8">
                <!-- Card 1: Total Installs -->
                <div class="bg-gradient-to-r from-green-400 to-blue-500 text-white shadow-xl rounded-lg p-6 hover:shadow-2xl transition duration-300 ease-in-out transform hover:scale-105">
                    <h3 class="text-2xl font-bold">Total Installs</h3>
                    <p class="text-white mt-2">The total number of new app installs</p>
                    <span class="block text-4xl font-semibold mt-4">2,450</span>
                </div>

                <!-- Card 2: In-App Purchases -->
                <div class="bg-gradient-to-r from-purple-400 to-pink-500 text-white shadow-xl rounded-lg p-6 hover:shadow-2xl transition duration-300 ease-in-out transform hover:scale-105">
                    <h3 class="text-2xl font-bold">In-App Purchases</h3>
                    <p class="text-white mt-2">Total in-app revenue generated</p>
                    <span class="block text-4xl font-semibold mt-4">LKR 450,000</span>
                </div>

                <!-- Card 3: Active Users -->
                <div class="bg-gradient-to-r from-yellow-400 to-red-500 text-white shadow-xl rounded-lg p-6 hover:shadow-2xl transition duration-300 ease-in-out transform hover:scale-105">
                    <h3 class="text-2xl font-bold">Active Users</h3>
                    <p class="text-white mt-2">Users who are currently active</p>
                    <span class="block text-4xl font-semibold mt-4">1,150</span>
                </div>
            </div>

            <!-- Analytics Chart Section -->
            <div class="bg-white shadow-xl rounded-lg p-8 mb-8 hover:shadow-2xl transition duration-300 ease-in-out">
                <div class="flex items-center justify-between mb-6">
                    <h3 class="text-2xl font-bold text-gray-800">App Analytics Overview</h3>
                    <a href="{{ route('analytics.index') }}" class="bg-indigo-500 hover:bg-indigo-700 text-white font-bold py-2 px-6 rounded-md shadow-md transition duration-200 ease-in-out transform hover:scale-105">
                        View More Analytics
                    </a>
                </div>

                <!-- Doughnut Chart -->
                <div class="flex justify-center items-center">
                    <div class="w-full max-w-lg">
                        <canvas id="analyticsChart"></canvas>
                    </div>
                </div>

                <p class="text-gray-600 text-center mt-6">Analyze app metrics including new installs, in-app purchases, and active users.</p>
            </div>

            <!-- Trends Comparison Chart Section -->
            <div class="bg-white shadow-xl rounded-lg p-8 hover:shadow-2xl transition duration-300 ease-in-out">
                <h3 class="text-2xl font-bold text-gray-800 mb-6">Trends Over Time</h3>

                <!-- Line Chart -->
                <div class="flex justify-center items-center">
                    <div class="w-full max-w-lg">
                        <canvas id="comparisonChart"></canvas>
                    </div>
                </div>

                <p class="text-gray-600 text-center mt-6">Track trends in app installs, in-app purchases, and active users for the past six months.</p>
            </div>
        </div>
    </div>

    <!-- Chart.js scripts -->
    <script>
        // Doughnut Chart for App Analytics
        const analyticsCtx = document.getElementById('analyticsChart').getContext('2d');
        const analyticsChart = new Chart(analyticsCtx, {
            type: 'doughnut',
            data: {
                labels: ['New Installs', 'In-App Purchases', 'Active Users'],
                datasets: [{
                    label: 'App Analytics',
                    data: [200, 150, 50],
                    backgroundColor: ['rgba(75, 192, 192, 0.7)', 'rgba(153, 102, 255, 0.7)', 'rgba(255, 99, 132, 0.7)'],
                    borderColor: ['rgba(75, 192, 192, 1)', 'rgba(153, 102, 255, 1)', 'rgba(255, 99, 132, 1)'],
                    borderWidth: 2
                }]
            },
            options: {
                responsive: true,
                plugins: {
                    legend: {
                        position: 'bottom',
                        labels: {
                            font: {
                                size: 14
                            }
                        }
                    },
                }
            }
        });

        // Line Chart for Trends Comparison
        const comparisonCtx = document.getElementById('comparisonChart').getContext('2d');
        const comparisonChart = new Chart(comparisonCtx, {
            type: 'line',
            data: {
                labels: ['January', 'February', 'March', 'April', 'May', 'June'],
                datasets: [
                    {
                        label: 'New Installs',
                        data: [120, 140, 180, 170, 200, 220],
                        borderColor: 'rgba(75, 192, 192, 1)',
                        backgroundColor: 'rgba(75, 192, 192, 0.2)',
                        fill: true,
                        tension: 0.4
                    },
                    {
                        label: 'In-App Purchases',
                        data: [100, 110, 120, 130, 140, 150],
                        borderColor: 'rgba(153, 102, 255, 1)',
                        backgroundColor: 'rgba(153, 102, 255, 0.2)',
                        fill: true,
                        tension: 0.4
                    },
                    {
                        label: 'Active Users',
                        data: [80, 90, 100, 110, 120, 130],
                        borderColor: 'rgba(255, 99, 132, 1)',
                        backgroundColor: 'rgba(255, 99, 132, 0.2)',
                        fill: true,
                        tension: 0.4
                    }
                ]
            },
            options: {
                responsive: true,
                plugins: {
                    legend: {
                        position: 'bottom',
                        labels: {
                            font: {
                                size: 14
                            }
                        }
                    },
                }
            }
        });
    </script>
</x-app-layout>
