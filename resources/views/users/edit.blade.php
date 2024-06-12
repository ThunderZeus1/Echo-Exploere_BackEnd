<!-- resources/views/users/edit.blade.php -->

<x-app-layout>
    <div class="container mx-auto p-6">
        <div class="bg-white text-gray-800 rounded-lg shadow-md p-6">
            <h3 class="text-2xl font-semibold mb-4">Edit User</h3>

            <form action="{{ route('users.update', $user->id) }}" method="POST">
                @csrf
                @method('PUT')

                <div class="mb-4">
                    <label class="block text-gray-700 text-sm font-bold mb-2">Name</label>
                    <input type="text" name="name" value="{{ $user->name }}" class="w-full p-3 border border-gray-300 rounded-lg shadow-sm focus:outline-none focus:ring-2 focus:ring-blue-500 focus:border-transparent">
                </div>

                <div class="mb-4">
                    <label class="block text-gray-700 text-sm font-bold mb-2">Email</label>
                    <input type="email" name="email" value="{{ $user->email }}" class="w-full p-3 border border-gray-300 rounded-lg shadow-sm focus:outline-none focus:ring-2 focus:ring-blue-500 focus:border-transparent">
                </div>

                <!-- Add more fields as necessary -->

                <div class="flex justify-end">
                    <a href="{{ route('users.manage-users') }}" class="bg-gray-500 text-white py-2 px-4 rounded-lg shadow-md hover:bg-gray-700 transition duration-300 mr-2">Cancel</a>
                    <button type="submit" class="bg-blue-500 text-white py-2 px-4 rounded-lg shadow-md hover:bg-blue-700 transition duration-300">Update User</button>
                </div>
            </form>
        </div>
    </div>
</x-app-layout>
