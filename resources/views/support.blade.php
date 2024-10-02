<x-app-layout>
    <x-slot name="header">
        <div class="flex items-center justify-between">
            <h2 class="font-semibold text-3xl text-gray-900 leading-tight">
                {{ __('Support Center') }}
            </h2>
        </div>
    </x-slot>

    <div class="py-12 bg-gradient-to-r from-blue-100 via-indigo-100 to-purple-100 min-h-screen">
        <div class="max-w-5xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white shadow-xl sm:rounded-lg p-8 hover:shadow-2xl transition duration-300 ease-in-out">
                <h3 class="text-4xl font-extrabold text-gray-900 mb-6">We're Here to Help!</h3>
                <p class="text-xl text-gray-700 mb-8 leading-relaxed">Have questions or need assistance? Feel free to contact our Sri Lankan support team, and we'll be happy to assist you. We're committed to providing you with the support you need.</p>

                <!-- Contact Information Section -->
                <div class="mb-12">
                    <h4 class="text-2xl font-semibold text-indigo-700 flex items-center">📞 Hotline</h4>
                    <p class="text-lg text-gray-600 mt-2">Our customer support is available from Monday to Friday, 9 AM to 5 PM:</p>
                    <div class="mt-4 space-y-2">
                        <p class="text-lg text-gray-800 hover:text-blue-600 transition">👥 <strong>General Inquiries:</strong> <a href="tel:+94112345678" class="underline">+94 11 234 5678</a></p>
                        <p class="text-lg text-gray-800 hover:text-blue-600 transition">🛠 <strong>Technical Support:</strong> <a href="tel:+94719876543" class="underline">+94 71 987 6543</a></p>
                    </div>
                </div>

                <!-- Email Support Section -->
                <div class="mb-12">
                    <h4 class="text-2xl font-semibold text-indigo-700 flex items-center">📧 Email Support</h4>
                    <p class="text-lg text-gray-600 mt-2">Email us anytime, and we'll respond within 24 hours:</p>
                    <div class="mt-4 space-y-2">
                        <p class="text-lg text-gray-800 hover:text-blue-600 transition">📩 <strong>General Support:</strong> <a href="mailto:support.lk@example.com" class="underline">support.lk@example.com</a></p>
                        <p class="text-lg text-gray-800 hover:text-blue-600 transition">🔧 <strong>Technical Issues:</strong> <a href="mailto:techsupport.lk@example.com" class="underline">techsupport.lk@example.com</a></p>
                    </div>
                </div>

                <!-- Office Location Section -->
                <div class="mb-12">
                    <h4 class="text-2xl font-semibold text-indigo-700 flex items-center">🏢 Our Office</h4>
                    <p class="text-lg text-gray-600 mt-2">Visit us at our office in Colombo during business hours:</p>
                    <div class="mt-4">
                        <p class="text-lg text-gray-800 hover:text-blue-600 transition">📍 <strong>Office Address:</strong> 123, Main Street, Colombo 07, Sri Lanka</p>
                    </div>
                </div>

                <!-- Support Availability Section -->
                <div class="mb-12">
                    <h4 class="text-2xl font-semibold text-indigo-700 flex items-center">🕑 Working Hours</h4>
                    <p class="text-lg text-gray-600 mt-2">Our support team is available during the following times:</p>
                    <ul class="list-disc pl-6 mt-4 text-lg text-gray-800">
                        <li><strong>Monday - Friday:</strong> 9 AM - 5 PM</li>
                        <li><strong>Saturday & Sunday:</strong> Closed</li>
                        <li><strong>Public Holidays:</strong> Closed</li>
                    </ul>
                    <p class="text-lg text-gray-600 mt-4">You can still email us outside working hours, and we’ll respond as soon as possible.</p>
                </div>

                <!-- Encouraging Final Note -->
                <div class="bg-blue-50 p-6 rounded-lg shadow-md hover:shadow-lg transition duration-200 ease-in-out">
                    <p class="text-lg text-gray-800">💡 <strong>Need help?</strong> Our team is just a phone call or email away. No matter your concern, we're always here to support you and provide the assistance you need.</p>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>
