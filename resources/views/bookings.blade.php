<x-app-layout>
    <x-slot name="header">
        <div class="flex items-center justify-between">
            <h2 class="font-semibold text-3xl text-gray-900 leading-tight">
                {{ __('Bookings Dashboard') }}
            </h2>
        </div>
    </x-slot>

    <div class="py-12 bg-gradient-to-r from-gray-100 via-blue-50 to-indigo-100 min-h-screen">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-xl sm:rounded-lg p-8 hover:shadow-2xl transition duration-300 ease-in-out">

                <!-- Add Booking Form -->
                <h3 class="text-2xl font-extrabold text-gray-900 mb-6">Add New Booking</h3>
                <form action="{{ route('bookings.store') }}" method="POST" class="mb-8">
                    @csrf
                    <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                        <div>
                            <label for="customer_name" class="block text-gray-700 font-semibold">Customer Name</label>
                            <input type="text" name="customer_name" id="customer_name" class="form-input mt-1 block w-full rounded-md shadow-sm border-gray-300 focus:ring-indigo-500 focus:border-indigo-500" required>
                        </div>

                        <div>
                            <label for="tour_name" class="block text-gray-700 font-semibold">Tour Name</label>
                            <input type="text" name="tour_name" id="tour_name" class="form-input mt-1 block w-full rounded-md shadow-sm border-gray-300 focus:ring-indigo-500 focus:border-indigo-500" required>
                        </div>

                        <div>
                            <label for="date" class="block text-gray-700 font-semibold">Date</label>
                            <input type="date" name="date" id="date" class="form-input mt-1 block w-full rounded-md shadow-sm border-gray-300 focus:ring-indigo-500 focus:border-indigo-500" required>
                        </div>

                        <div>
                            <label for="amount" class="block text-gray-700 font-semibold">Amount (LKR)</label>
                            <input type="number" name="amount" id="amount" step="0.01" class="form-input mt-1 block w-full rounded-md shadow-sm border-gray-300 focus:ring-indigo-500 focus:border-indigo-500" required>
                        </div>

                        <div>
                            <label for="status" class="block text-gray-700 font-semibold">Status</label>
                            <select name="status" id="status" class="form-select mt-1 block w-full rounded-md shadow-sm border-gray-300 focus:ring-indigo-500 focus:border-indigo-500" required>
                                <option value="confirmed">Confirmed</option>
                                <option value="pending">Pending</option>
                                <option value="canceled">Canceled</option>
                            </select>
                        </div>
                    </div>

                    <div class="mt-6">
                        <button type="submit" class="bg-indigo-600 hover:bg-indigo-800 text-white font-bold py-2 px-4 rounded-md shadow-sm transition duration-200 ease-in-out">
                            Add Booking
                        </button>
                    </div>
                </form>

                <hr class="my-8">

                <!-- Displaying recent bookings -->
                <h3 class="text-2xl font-extrabold text-gray-900 mb-6">Recent Bookings</h3>
                <table class="min-w-full bg-white shadow-md rounded-lg overflow-hidden">
                    <thead>
                    <tr class="bg-indigo-600 text-white text-left text-sm font-bold uppercase">
                        <th class="px-4 py-3">Customer</th>
                        <th class="px-4 py-3">Tour</th>
                        <th class="px-4 py-3">Date</th>
                        <th class="px-4 py-3">Status</th>
                        <th class="px-4 py-3">Amount</th>
                    </tr>
                    </thead>
                    <tbody class="text-gray-700">
                    <!-- Display bookings dynamically -->
                    @foreach ($bookings as $booking)
                        <tr class="border-b hover:bg-indigo-50 transition duration-200">
                            <td class="px-4 py-3">{{ $booking->customer_name }}</td>
                            <td class="px-4 py-3">{{ $booking->tour_name }}</td>
                            <td class="px-4 py-3">{{ \Carbon\Carbon::parse($booking->date)->format('M d, Y') }}</td>
                            <td class="px-4 py-3">
                                <span class="px-2 inline-flex text-xs leading-5 font-semibold rounded-full {{ $booking->status == 'confirmed' ? 'bg-green-100 text-green-800' : ($booking->status == 'canceled' ? 'bg-red-100 text-red-800' : 'bg-yellow-100 text-yellow-800') }}">
                                    {{ ucfirst($booking->status) }}
                                </span>
                            </td>
                            <td class="px-4 py-3">LKR {{ number_format($booking->amount, 2) }}</td>
                        </tr>
                    @endforeach
                    </tbody>
                </table>

                <!-- Chart.js canvas for booking trends -->
                <div class="mt-8">
                    <canvas id="bookingsChart"></canvas>
                </div>

                <p class="text-gray-600 mt-4">Manage and view recent bookings.</p>
            </div>
        </div>
    </div>

    <!-- Chart.js scripts for Bookings Chart -->
    <script>
        const bookingsCtx = document.getElementById('bookingsChart').getContext('2d');
        const bookingsChart = new Chart(bookingsCtx, {
            type: 'line',
            data: {
                labels: ['January', 'February', 'March', 'April', 'May', 'June'], // Example months
                datasets: [{
                    label: 'Number of Bookings',
                    data: [50, 75, 90, 110, 85, 100], // Manual example values for bookings
                    borderColor: 'rgba(75, 192, 192, 1)',
                    borderWidth: 2,
                    fill: false,
                    tension: 0.3
                }]
            },
            options: {
                responsive: true,
                scales: {
                    y: {
                        beginAtZero: true,
                        ticks: {
                            stepSize: 20 // Manual step size for y-axis
                        }
                    }
                },
                plugins: {
                    legend: {
                        position: 'bottom',
                        labels: {
                            font: {
                                size: 14
                            }
                        }
                    }
                }
            }
        });
    </script>
</x-app-layout>
