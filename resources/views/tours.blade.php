<x-app-layout>
    <x-slot name="header">
        <div class="flex items-center justify-between">
            <h2 class="font-semibold text-3xl text-gray-900 leading-tight">
                {{ __('Tour Listings') }}
            </h2>
        </div>
    </x-slot>

    <div class="py-12 bg-gradient-to-br from-gray-100 via-blue-50 to-indigo-100 min-h-screen">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white shadow-xl sm:rounded-lg p-8 hover:shadow-2xl transition duration-300 ease-in-out">
                <!-- Add new tourism company -->
                <div class="mb-8">
                    <h3 class="text-2xl font-extrabold text-gray-900 mb-4">Add New Tourism Company</h3>
                    <form action="{{ route('tours.company.store') }}" method="POST" class="mt-4">
                        @csrf
                        <div class="mb-4">
                            <label for="name" class="block text-gray-700 font-medium">Tourism Company Name</label>
                            <input type="text" name="name" id="name" class="form-input mt-1 block w-full rounded-md shadow-sm border-gray-300 focus:ring-indigo-500 focus:border-indigo-500" required>
                        </div>
                        <button type="submit" class="bg-green-500 hover:bg-green-700 text-white font-bold py-2 px-4 rounded-md shadow-sm transition duration-200 ease-in-out transform hover:scale-105">
                            Add Tourism Company
                        </button>
                    </form>
                </div>

                <hr class="my-8">

                <!-- List of Tourism Companies and their Tour Packages -->
                @foreach ($companies as $company)
                    <div x-data="{ open: false, deleteCompanyOpen: false }" class="mb-8">
                        <!-- Company Name, Dropdown Arrow, and Delete Button -->
                        <div @click="open = !open" class="flex justify-between items-center bg-indigo-100 p-4 rounded-md shadow-md cursor-pointer transition duration-200 ease-in-out transform hover:scale-105 hover:bg-indigo-200">
                            <h3 class="text-xl font-bold text-gray-900">{{ $company->name }}</h3>
                            <div class="flex items-center space-x-4">
                                <svg class="w-6 h-6 transform transition-transform" :class="open ? 'rotate-180' : 'rotate-0'" fill="none" stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 9l-7 7-7-7"></path>
                                </svg>
                                <!-- Delete button triggers confirmation modal -->
                                <button @click="deleteCompanyOpen = true" class="text-red-500 hover:text-red-700 transition duration-200">Delete</button>
                            </div>
                        </div>

                        <!-- Add new tour package and list of tour packages (Dropdown) -->
                        <div x-show="open" x-collapse class="mt-4">
                            <!-- Add new tour package form -->
                            <form action="{{ route('tours.package.store') }}" method="POST" class="bg-gray-50 p-4 rounded-md shadow-sm mb-4 transition hover:shadow-lg">
                                @csrf
                                <input type="hidden" name="tourism_company_id" value="{{ $company->id }}">
                                <h4 class="text-lg font-semibold mb-2 text-gray-800">Add Tour Package</h4>
                                <div class="grid grid-cols-1 md:grid-cols-3 gap-4 mb-4">
                                    <div>
                                        <label for="name" class="block text-gray-700 font-medium">Package Name</label>
                                        <input type="text" name="name" id="name" class="form-input mt-1 block w-full rounded-md border-gray-300 focus:ring-indigo-500 focus:border-indigo-500" required>
                                    </div>
                                    <div>
                                        <label for="price" class="block text-gray-700 font-medium">Price (LKR)</label>
                                        <input type="number" step="0.01" name="price" id="price" class="form-input mt-1 block w-full rounded-md border-gray-300 focus:ring-indigo-500 focus:border-indigo-500" required>
                                    </div>
                                    <div>
                                        <label for="duration" class="block text-gray-700 font-medium">Duration (days)</label>
                                        <input type="number" name="duration" id="duration" class="form-input mt-1 block w-full rounded-md border-gray-300 focus:ring-indigo-500 focus:border-indigo-500" required>
                                    </div>
                                </div>
                                <button type="submit" class="bg-blue-500 hover:bg-blue-700 text-white font-bold py-2 px-4 rounded-md shadow-sm transition duration-200 ease-in-out transform hover:scale-105">
                                    Add Tour Package
                                </button>
                            </form>

                            <!-- List of tour packages -->
                            <ul class="space-y-2">
                                @foreach ($company->packages as $package)
                                    <li class="bg-white p-4 rounded-md shadow-md flex justify-between items-center transition hover:shadow-lg">
                                        <div>
                                            <h5 class="text-lg font-semibold text-gray-900">{{ $package->name }} - LKR {{ number_format($package->price, 2) }} ({{ $package->duration }} days)</h5>
                                        </div>
                                        <div class="space-x-4">
                                            <!-- Edit button -->
                                            <button class="text-blue-500 hover:text-blue-700 transition duration-200">Edit</button>
                                            <!-- Delete button -->
                                            <button class="text-red-500 hover:text-red-700 transition duration-200">Delete</button>
                                        </div>
                                    </li>
                                @endforeach
                            </ul>
                        </div>

                        <!-- Delete Confirmation Modal -->
                        <div x-show="deleteCompanyOpen" x-cloak class="fixed inset-0 bg-gray-600 bg-opacity-75 flex items-center justify-center z-50 transition duration-200">
                            <div class="bg-white p-6 rounded-lg shadow-lg w-full max-w-lg">
                                <h3 class="text-xl font-semibold mb-4">Delete Tourism Company</h3>
                                <p>Are you sure you want to delete the company "<strong>{{ $company->name }}</strong>"?</p>
                                <form action="{{ route('tours.company.delete', $company->id) }}" method="POST" class="mt-4">
                                    @csrf
                                    @method('DELETE')
                                    <div class="flex justify-end space-x-4">
                                        <button type="button" @click="deleteCompanyOpen = false" class="bg-gray-500 hover:bg-gray-700 text-white py-2 px-4 rounded transition duration-200">Cancel</button>
                                        <button type="submit" class="bg-red-500 hover:bg-red-700 text-white py-2 px-4 rounded transition duration-200">Delete</button>
                                    </div>
                                </form>
                            </div>
                        </div>

                    </div>
                @endforeach
            </div>
        </div>
    </div>

    <!-- Alpine.js for modal handling -->
    <script>
        document.addEventListener('alpine:init', () => {
            Alpine.data('dropdown', () => ({
                open: false,
                deleteCompanyOpen: false,
            }));
        });
    </script>
</x-app-layout>
