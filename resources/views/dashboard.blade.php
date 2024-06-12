<head>
    <!-- Other head elements -->
    <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
</head>
<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-2xl text-gray-800 leading-tight">
            {{ __('Echo Explore Admin Dashboard') }}
        </h2>
    </x-slot>
    <div class="py-12 bg-gray-100 min-h-screen">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-xl sm:rounded-lg p-8">
                <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-8">

                    <!-- User Info Section -->
                    <div class="bg-white text-gray-800 rounded-lg shadow-md p-6 transform transition duration-500 hover:scale-105">
                        <div class="flex items-center mb-4">
                            <img src="https://www.gravatar.com/avatar/{{ md5(auth()->user()->email) }}?s=80&d=identicon" alt="User Avatar" class="w-16 h-16 rounded-full mr-4">
                            <div>
                                <h3 class="text-xl font-semibold">{{ auth()->user()->name }}</h3>
                                <p class="text-gray-600">{{ auth()->user()->email }}</p>
                            </div>
                        </div>
                        <p class="text-gray-600">Welcome back, {{ auth()->user()->name }}! You are currently logged in.</p>
                        <div class="mt-4">
                            <a href="{{ route('profile.show') }}" class="bg-white text-blue-600 hover:bg-blue-100 py-2 px-4 rounded-lg transition duration-300 mt-2 inline-block font-semibold">View Profile</a>
                        </div>
                    </div>


                    <!-- User Count Section -->
                    <div class="bg-white text-gray-800 rounded-lg shadow-md p-6 transform transition duration-500 hover:scale-105">
                        <h3 class="text-lg font-semibold mb-4">User Count</h3>
                        <p class="text-gray-600 mt-2">Total Users: <span class="text-xl font-semibold text-blue-500">{{ $userCount }}</span></p>
                        <p class="text-sm text-gray-500 mt-4 font-semibold">Manage users and their activity</p>
                        <a href="{{ route('users.manage-users') }}" class="text-blue-500 hover:text-blue-700 hover:underline font-semibold">Manage Users</a>
                    </div>


                    <!-- Bookings Section -->
                    <div class="bg-blue-50 rounded-lg shadow-md p-6 transform transition duration-500 hover:scale-105">
                        <h3 class="text-lg font-semibold text-gray-800 mb-2">Recent Bookings</h3>
                        <canvas id="bookingsChart"></canvas>
                        <p class="text-gray-600 mt-4">Manage and view recent bookings</p>
                        <a href="{{ route('bookings.index') }}" class="text-blue-500 hover:text-blue-700 hover:underline font-semibold">View Bookings</a>
                    </div>

                    <!-- Tours Section -->
                    <div class="bg-green-50 rounded-lg shadow-md p-6 transform transition duration-500 hover:scale-105">
                        <h3 class="text-lg font-semibold text-gray-800 mb-2">Tour Listings</h3>
                        <canvas id="toursChart"></canvas>
                        <p class="text-gray-600 mt-4">Manage your tour listings</p>
                        <a href="{{ route('tours.index') }}" class="text-green-500 hover:text-green-700 hover:underline font-semibold">View Tours</a>
                    </div>

                    <!-- User Statistics Section -->
                    <div class="bg-yellow-50 rounded-lg shadow-md p-6 transform transition duration-500 hover:scale-105">
                        <h3 class="text-lg font-semibold text-gray-800 mb-2">User Statistics</h3>
                        <canvas id="userStatsChart"></canvas>
                        <p class="text-gray-600 mt-4">View user statistics and activity</p>
                        <a href="{{ route('stats.index') }}" class="text-yellow-500 hover:text-yellow-700 hover:underline font-semibold">View Statistics</a>
                    </div>

                    <!-- Analytics Section -->
                    <div class="bg-purple-50 rounded-lg shadow-md p-6 transform transition duration-500 hover:scale-105">
                        <h3 class="text-lg font-semibold text-gray-800 mb-2">Analytics</h3>
                        <canvas id="analyticsChart"></canvas>
                        <p class="text-gray-600 mt-4">Analyze booking trends</p>
                        <a href="{{ route('analytics.index') }}" class="text-purple-500 hover:text-purple-700 hover:underline font-semibold">View Analytics</a>
                    </div>

                    <!-- Settings Section -->
                    <div class="bg-red-50 rounded-lg shadow-md p-6 transform transition duration-500 hover:scale-105">
                        <h3 class="text-lg font-semibold text-gray-800 mb-2">Settings</h3>
                        <p class="text-gray-600 mt-4">Configure your application settings</p>
                        <a href="{{ route('settings.index') }}" class="text-red-500 hover:text-red-700 hover:underline font-semibold">View Settings</a>
                    </div>

                    <!-- Support Section -->
                    <div class="bg-indigo-50 rounded-lg shadow-md p-6 transform transition duration-500 hover:scale-105">
                        <h3 class="text-lg font-semibold text-gray-800 mb-2">Support</h3>
                        <p class="text-gray-600 mt-4">Get help and support</p>
                        <a href="{{ route('support.index') }}" class="text-indigo-500 hover:text-indigo-700 hover:underline font-semibold">Get Support</a>
                    </div>

                </div>
            </div>
        </div>
    </div>

    <!-- Chart.js scripts -->
    <script>
        // Bookings Chart
        const bookingsCtx = document.getElementById('bookingsChart').getContext('2d');
        const bookingsChart = new Chart(bookingsCtx, {
            type: 'line',
            data: {
                labels: ['January', 'February', 'March', 'April', 'May', 'June'],
                datasets: [{
                    label: 'Bookings',
                    data: [65, 59, 80, 81, 56, 55],
                    borderColor: 'rgba(75, 192, 192, 1)',
                    borderWidth: 1,
                    fill: false,
                    tension: 0.1
                }]
            },
            options: {
                responsive: true,
                scales: {
                    y: {
                        beginAtZero: true
                    }
                }
            }
        });

        // Tours Chart
        const toursCtx = document.getElementById('toursChart').getContext('2d');
        const toursChart = new Chart(toursCtx, {
            type: 'bar',
            data: {
                labels: ['January', 'February', 'March', 'April', 'May', 'June'],
                datasets: [{
                    label: 'Tours',
                    data: [45, 50, 60, 70, 80, 90],
                    backgroundColor: 'rgba(153, 102, 255, 0.2)',
                    borderColor: 'rgba(153, 102, 255, 1)',
                    borderWidth: 1
                }]
            },
            options: {
                responsive: true,
                scales: {
                    y: {
                        beginAtZero: true
                    }
                }
            }
        });

        // User Statistics Chart
        const userStatsCtx = document.getElementById('userStatsChart').getContext('2d');
        const userStatsChart = new Chart(userStatsCtx, {
            type: 'pie',
            data: {
                labels: ['Active', 'Inactive', 'Pending'],
                datasets: [{
                    label: 'Users',
                    data: [300, 50, 100],
                    backgroundColor: ['rgba(255, 206, 86, 0.2)', 'rgba(75, 192, 192, 0.2)', 'rgba(255, 99, 132, 0.2)'],
                    borderColor: ['rgba(255, 206, 86, 1)', 'rgba(75, 192, 192, 1)', 'rgba(255, 99, 132, 1)'],
                    borderWidth: 1
                }]
            },
            options: {
                responsive: true,
            }
        });

        // Analytics Chart
        const analyticsCtx = document.getElementById('analyticsChart').getContext('2d');
        const analyticsChart = new Chart(analyticsCtx, {
            type: 'doughnut',
            data: {
                labels: ['New Installs', 'In-App Purchases', 'Active Users'],
                datasets: [{
                    label: 'App Analytics',
                    data: [200, 150, 50],
                    backgroundColor: ['rgba(75, 192, 192, 0.2)', 'rgba(153, 102, 255, 0.2)', 'rgba(255, 99, 132, 0.2)'],
                    borderColor: ['rgba(75, 192, 192, 1)', 'rgba(153, 102, 255, 1)', 'rgba(255, 99, 132, 1)'],
                    borderWidth: 1
                }]
            },
            options: {
                responsive: true,
            }
        });

    </script>
</x-app-layout>
