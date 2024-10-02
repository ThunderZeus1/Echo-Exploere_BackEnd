<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-2xl text-gray-800 leading-tight">
            {{ __('Trending Tourism Companies') }}
        </h2>
    </x-slot>

    <div class="py-12 bg-gray-100">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white shadow-xl sm:rounded-lg p-6">
                <h3 class="text-2xl font-bold mb-6 text-gray-800">Most Trending Tourism Companies</h3>

                <!-- Check if there are companies to display -->
                @if ($companies->isNotEmpty())
                    <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-8">
                        @foreach ($companies as $company)
                            <div class="bg-white p-6 rounded-lg shadow-md transition-transform transform hover:scale-105 hover:shadow-lg">
                                <div class="mb-4">
                                    <img src="{{ asset('images/company-placeholder.jpg') }}" alt="{{ $company->name }}" class="w-full h-32 object-cover rounded-t-lg">
                                </div>
                                <div class="flex flex-col">
                                    <h4 class="text-xl font-semibold text-gray-900">{{ $company->name }}</h4>
                                    <p class="text-gray-600 mt-2">{{ $company->description }}</p>
                                    <div class="mt-4 flex justify-between items-center">
                                        <span class="text-sm font-medium text-gray-500">Trending Score:</span>
                                        <span class="text-lg font-bold text-blue-500">{{ $company->trending_score }}</span>
                                    </div>
                                    <a href="#" class="mt-6 text-blue-600 hover:text-blue-800 text-sm font-semibold transition duration-200">Learn more →</a>
                                </div>
                            </div>
                        @endforeach
                    </div>
                @else
                    <p class="text-center text-gray-500">No trending companies at the moment.</p>
                @endif
            </div>
        </div>
    </div>
</x-app-layout>
