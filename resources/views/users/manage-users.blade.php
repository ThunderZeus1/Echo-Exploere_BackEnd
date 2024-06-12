<!-- resources/views/users/manage-users.blade.php -->

<x-app-layout>
    <div class="container mx-auto p-6" x-data="{ showSuccessMessage: @if (session('success')) true @else false @endif, showDeleteModal: false, userIdToDelete: null }" x-init="setTimeout(() => { showSuccessMessage = false; }, 5000)">
        <div x-show="showSuccessMessage" x-transition:enter="transition ease-out duration-300" x-transition:enter-start="opacity-0 transform -translate-y-4" x-transition:enter-end="opacity-100 transform translate-y-0" x-transition:leave="transition ease-in duration-200" x-transition:leave-start="opacity-100 transform translate-y-0" x-transition:leave-end="opacity-0 transform -translate-y-4" class="bg-green-100 border border-green-400 text-green-700 px-4 py-3 rounded relative mb-4" role="alert">
            <span class="block sm:inline">{{ session('success') }}</span>
        </div>

        <div class="bg-white text-gray-800 rounded-lg shadow-md p-6">
            <h3 class="text-2xl font-semibold mb-4">User Management</h3>

            <div class="overflow-x-auto">
                <table class="min-w-full bg-white border border-gray-200">
                    <thead>
                    <tr class="bg-gray-100 border-b">
                        <th class="py-3 px-6 text-center text-sm font-medium text-gray-700 uppercase tracking-wider">Name</th>
                        <th class="py-3 px-6 text-center text-sm font-medium text-gray-700 uppercase tracking-wider">Email</th>
                        <th class="py-3 px-6 text-center text-sm font-medium text-gray-700 uppercase tracking-wider">Actions</th>
                    </tr>
                    </thead>
                    <tbody class="divide-y divide-gray-200">
                    @foreach($users as $user)
                        <tr>
                            <td class="py-3 px-6 text-center whitespace-nowrap">{{ $user->name }}</td>
                            <td class="py-3 px-6 text-center whitespace-nowrap">{{ $user->email }}</td>
                            <td class="py-3 px-6 text-center whitespace-nowrap">
                                <a href="{{ route('users.edit', $user->id) }}" class="inline-flex items-center px-4 py-2 mr-2 bg-black border border-transparent rounded-md font-semibold text-xs text-white uppercase tracking-widest hover:bg-gray-800 active:bg-gray-900 focus:outline-none focus:ring-2 focus:ring-black focus:ring-offset-2 shadow-lg transition ease-in-out duration-150">Edit</a>
                                <button @click="showDeleteModal = true; userIdToDelete = {{ $user->id }}" class="inline-flex items-center px-4 py-2 bg-red-600 border border-transparent rounded-md font-semibold text-xs text-white uppercase tracking-widest hover:bg-red-700 active:bg-red-800 focus:outline-none focus:ring-2 focus:ring-red-500 focus:ring-offset-2 shadow-lg transition ease-in-out duration-150">Delete</button>
                            </td>
                        </tr>
                    @endforeach
                    </tbody>
                </table>
            </div>
        </div>

        <!-- Delete Confirmation Modal -->
        <div x-show="showDeleteModal" class="fixed inset-0 bg-gray-600 bg-opacity-50 overflow-y-auto h-full w-full flex items-center justify-center">
            <div class="bg-white rounded-lg shadow-md p-6 max-w-sm mx-auto">
                <h3 class="text-xl font-semibold mb-4">Confirm Deletion</h3>
                <p class="mb-4">Are you sure you want to delete this user?</p>
                <div class="flex justify-end">
                    <button @click="showDeleteModal = false" class="px-4 py-2 bg-gray-300 rounded-md font-semibold text-xs text-gray-700 uppercase tracking-widest hover:bg-gray-400 active:bg-gray-500 focus:outline-none focus:ring-2 focus:ring-gray-500 focus:ring-offset-2 shadow-lg transition ease-in-out duration-150 mr-2">Cancel</button>
                    <form :action="`/users/${userIdToDelete}`" method="POST" class="inline-block">
                        @csrf
                        @method('DELETE')
                        <button type="submit" class="px-4 py-2 bg-red-600 border border-transparent rounded-md font-semibold text-xs text-white uppercase tracking-widest hover:bg-red-700 active:bg-red-800 focus:outline-none focus:ring-2 focus:ring-red-500 focus:ring-offset-2 shadow-lg transition ease-in-out duration-150">Delete</button>
                    </form>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>
