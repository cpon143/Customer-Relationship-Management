@extends('layouts.app')

@section('content')
<div class="p-8">
    <!-- Page Heading -->
    <div class="mb-6 flex justify-between items-center">
        <h1 class="text-3xl font-semibold text-gray-700">Settings</h1>
    </div>

    <!-- Tabs for Sections -->
    <div class="bg-white shadow-lg rounded-lg">
        <ul class="flex border-b border-gray-200">
            <li class="w-1/4">
                <a href="#user-management" class="block py-4 text-center text-gray-600 hover:bg-gray-100 hover:text-gray-800 font-medium">User Management</a>
            </li>
            <li class="w-1/4">
                <a href="#general-settings" class="block py-4 text-center text-gray-600 hover:bg-gray-100 hover:text-gray-800 font-medium">General Settings</a>
            </li>
            <li class="w-1/4">
                <a href="#notifications" class="block py-4 text-center text-gray-600 hover:bg-gray-100 hover:text-gray-800 font-medium">Notifications</a>
            </li>
            <li class="w-1/4">
                <a href="#other" class="block py-4 text-center text-gray-600 hover:bg-gray-100 hover:text-gray-800 font-medium">Other</a>
            </li>
        </ul>
    </div>

    <!-- Content for User Management -->
    <div id="user-management" class="bg-white shadow-lg rounded-lg mt-6 p-6">
        <h2 class="text-2xl font-semibold mb-4">User Management</h2>
        <div class="mb-4 flex justify-between items-center">
            <button class="bg-blue-500 text-white px-4 py-2 rounded-md hover:bg-blue-600">
                Add New User
            </button>
            <input 
                type="text" 
                placeholder="Search users..." 
                class="border border-gray-300 p-2 rounded-lg w-1/3 focus:outline-none focus:ring-2 focus:ring-blue-500"
            />
        </div>

        <!-- Users Table -->
        <div class="overflow-x-auto">
            <table class="min-w-full bg-white">
                <thead>
                    <tr>
                        <th class="py-3 px-4 border-b border-gray-200 text-gray-700 text-left">Name</th>
                        <th class="py-3 px-4 border-b border-gray-200 text-gray-700 text-left">Email</th>
                        <th class="py-3 px-4 border-b border-gray-200 text-gray-700 text-left">Role</th>
                        <th class="py-3 px-4 border-b border-gray-200 text-gray-700 text-left">Actions</th>
                    </tr>
                </thead>
                <tbody>
                    <!-- Example User Row -->
                    <tr>
                        <td class="py-3 px-4 border-b border-gray-200">John Doe</td>
                        <td class="py-3 px-4 border-b border-gray-200">john.doe@example.com</td>
                        <td class="py-3 px-4 border-b border-gray-200">Admin</td>
                        <td class="py-3 px-4 border-b border-gray-200">
                            <button class="bg-yellow-500 text-white px-3 py-1 rounded-md hover:bg-yellow-600">Edit</button>
                            <button class="bg-red-500 text-white px-3 py-1 rounded-md hover:bg-red-600">Delete</button>
                        </td>
                    </tr>
                    <!-- Add more users as needed -->
                </tbody>
            </table>
        </div>
    </div>

    <!-- Content for General Settings -->
    <div id="general-settings" class="bg-white shadow-lg rounded-lg mt-6 p-6 hidden">
        <h2 class="text-2xl font-semibold mb-4">General Settings</h2>
        <form action="#" method="POST">
            @csrf
            <div class="mb-4">
                <label for="site-name" class="block text-sm font-medium text-gray-700">Site Name</label>
                <input type="text" id="site-name" name="site-name" value="CMS Dashboard" class="mt-1 block w-full border border-gray-300 rounded-md shadow-sm focus:ring-blue-500 focus:border-blue-500 sm:text-sm">
            </div>
            <div class="mb-4">
                <label for="site-email" class="block text-sm font-medium text-gray-700">Site Email</label>
                <input type="email" id="site-email" name="site-email" value="info@cmsdashboard.com" class="mt-1 block w-full border border-gray-300 rounded-md shadow-sm focus:ring-blue-500 focus:border-blue-500 sm:text-sm">
            </div>
            <div class="mb-4">
                <label for="timezone" class="block text-sm font-medium text-gray-700">Timezone</label>
                <select id="timezone" name="timezone" class="mt-1 block w-full border border-gray-300 rounded-md shadow-sm focus:ring-blue-500 focus:border-blue-500 sm:text-sm">
                    <option>UTC</option>
                    <option>America/New_York</option>
                    <option>Europe/London</option>
                    <option>Asia/Tokyo</option>
                    <!-- Add more timezones as needed -->
                </select>
            </div>
            <button type="submit" class="bg-blue-500 text-white px-4 py-2 rounded-md hover:bg-blue-600">Save Changes</button>
        </form>
    </div>

    <!-- Content for Notifications -->
    <div id="notifications" class="bg-white shadow-lg rounded-lg mt-6 p-6 hidden">
        <h2 class="text-2xl font-semibold mb-4">Notifications</h2>
        <form action="#" method="POST">
            @csrf
            <div class="mb-4">
                <label for="email-notifications" class="block text-sm font-medium text-gray-700">Email Notifications</label>
                <input type="checkbox" id="email-notifications" name="email-notifications" checked class="mr-2">
                <label for="email-notifications" class="text-sm text-gray-600">Receive notifications via email</label>
            </div>
            <div class="mb-4">
                <label for="sms-notifications" class="block text-sm font-medium text-gray-700">SMS Notifications</label>
                <input type="checkbox" id="sms-notifications" name="sms-notifications" class="mr-2">
                <label for="sms-notifications" class="text-sm text-gray-600">Receive notifications via SMS</label>
            </div>
            <button type="submit" class="bg-blue-500 text-white px-4 py-2 rounded-md hover:bg-blue-600">Save Changes</button>
        </form>
    </div>

    <!-- Content for Other Settings -->
    <div id="other" class="bg-white shadow-lg rounded-lg mt-6 p-6 hidden">
        <h2 class="text-2xl font-semibold mb-4">Other Settings</h2>
        <!-- Add any other settings or configuration options here -->
    </div>
</div>

<script>
    // JavaScript to handle tab switching
    document.querySelectorAll('ul > li > a').forEach(tab => {
        tab.addEventListener('click', function(event) {
            event.preventDefault();
            const targetId = this.getAttribute('href').substring(1);
            
            document.querySelectorAll('.bg-white.shadow-lg.rounded-lg > div').forEach(section => {
                section.classList.add('hidden');
            });

            document.getElementById(targetId).classList.remove('hidden');
        });
    });
</script>
@endsection
