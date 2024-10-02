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

                    <!-- Tourism Company Dropdown -->
                    <div>
                        <label for="company_id" class="block text-gray-700 font-semibold">Tourism Company</label>
                        <select name="company_id" id="company_id" class="form-select mt-1 block w-full rounded-md shadow-sm border-gray-300 focus:ring-indigo-500 focus:border-indigo-500" required>
                            <option value="">Select a Company</option>
                            @foreach($companies as $company)
                                <option value="{{ $company->id }}">{{ $company->name }}</option>
                            @endforeach
                        </select>
                    </div>

                    <!-- Packages and Prices (will be dynamically populated) -->
                    <div id="packagesSection" class="mt-6">
                        <label for="package_id" class="block text-gray-700 font-semibold">Tour Package</label>
                        <select name="package_id" id="package_id" class="form-select mt-1 block w-full rounded-md shadow-sm border-gray-300 focus:ring-indigo-500 focus:border-indigo-500" required>
                            <option value="">Select a Package</option>
                        </select>

                        <label for="package_price" class="block text-gray-700 font-semibold mt-4">Price (LKR)</label>
                        <input type="text" name="package_price" id="package_price" class="form-input mt-1 block w-full rounded-md shadow-sm border-gray-300 focus:ring-indigo-500 focus:border-indigo-500" readonly>
                    </div>

                    <!-- Other Fields (Customer Name, Date, Amount, etc.) -->
                    <div class="grid grid-cols-1 md:grid-cols-2 gap-6 mt-6">
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

            </div>
        </div>
    </div>

    <!-- AJAX Script to Load Packages Based on Company Selection -->
    <script>
        document.getElementById('company_id').addEventListener('change', function() {
            const companyId = this.value;

            if (companyId) {
                fetch(`/api/tourism-packages/${companyId}`)
                    .then(response => response.json())
                    .then(data => {
                        const packageSelect = document.getElementById('package_id');
                        packageSelect.innerHTML = '<option value="">Select a Package</option>';

                        data.packages.forEach(pkg => {
                            const option = document.createElement('option');
                            option.value = pkg.id;
                            option.textContent = `${pkg.name} (LKR ${pkg.price})`;
                            packageSelect.appendChild(option);
                        });
                    });
            }
        });

        document.getElementById('package_id').addEventListener('change', function() {
            const selectedPackage = this.selectedOptions[0].textContent;
            const price = selectedPackage.match(/LKR\s([0-9,]+)/)[1];
            document.getElementById('package_price').value = price.replace(/,/g, '');
        });
    </script>
</x-app-layout>
