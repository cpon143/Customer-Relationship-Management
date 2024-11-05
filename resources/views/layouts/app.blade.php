<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Student Consultancy Dashboard</title>
    <!-- <link href="{{ asset('css/app.css') }}" rel="stylesheet"> -->
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@300;400;500;600;700&display=swap" rel="stylesheet">
    <link href="https://cdn.jsdelivr.net/npm/tailwindcss@2.2.19/dist/tailwind.min.css" rel="stylesheet">
    <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>

    <style>
        body {
            font-family: 'Poppins', sans-serif;
        }
    </style>
</head>
<body class="bg-gray-100">
    <div class="min-h-screen flex flex-col">

        <!-- Display Error Message -->
        <!-- @if(session('error'))
            <div class="bg-red-500 text-white p-4 rounded mb-4">
                {{ session('error') }}
            </div>
        @endif -->

        <!-- Navbar -->
        <nav class="bg-green-600 p-4 text-white shadow-lg">
            <div class="container mx-auto flex justify-between items-center">
                <div class="text-xl font-bold">
                    Student’s Choice Consultancy
                </div>
                <div class="flex space-x-4">
                    <a href="{{ url('/') }}" class="{{ Route::currentRouteName() == 'dashboard' ? 'text-yellow-400' : 'hover:text-yellow-400' }}">Dashboard</a>
                    <a href="{{ route('calling-portal') }}" class="{{ Route::currentRouteName() == 'calling-portal' ? 'text-yellow-400' : 'hover:text-yellow-400' }}">Calling Portal</a>
                    <a href="{{ route('report') }}" class="{{ Route::currentRouteName() == 'report' ? 'text-yellow-400' : 'hover:text-yellow-400' }}">Report</a>
                    <!-- <a href="{{ route('settings') }}" class="{{ Route::currentRouteName() == 'settings' ? 'text-yellow-400' : 'hover:text-yellow-400' }}">Settings</a> -->
                    <a href="{{ route('leads') }}" class="{{ Route::currentRouteName() == 'leads' ? 'text-yellow-400' : 'hover:text-yellow-400' }}">Leads</a>
                    <a href="{{ route('admins') }}" class="{{ Route::currentRouteName() == 'admins' ? 'text-yellow-400' : 'hover:text-yellow-400' }}">Admin</a>
                    <a href="{{ route('user.showProfile') }}" class="{{ Route::currentRouteName() == 'user.showProfile' ? 'text-yellow-400' : 'hover:text-yellow-400' }}">Profile</a>
                    
                    <!-- Login/Logout Button -->
                    <!-- @if(Auth::check())
                        <form action="{{ route('logout') }}" method="POST" class="inline">
                            @csrf
                            <button type="submit" class="text-white hover:text-yellow-400">Logout</button>
                        </form>
                    @else
                        <a href="{{ route('login') }}" class="text-white hover:text-yellow-400">Login</a>
                    @endif -->

                    @if(Auth::guard('admin')->check() || Auth::guard('advisor')->check())
                        <form action="{{ route('logout') }}" method="POST" class="inline">
                            @csrf
                            <button type="submit" class="text-white hover:text-yellow-400">Logout</button>
                        </form>
                    @else
                        <a href="{{ route('login') }}" class="text-white hover:text-yellow-400">Login</a>
                    @endif
                </div>
            </div>
        </nav>

        <!-- Sidebar and Main Content -->
        <div class="flex flex-1">
            <!-- Sidebar -->
            <aside class="w-64 bg-white shadow-md">
                <div class="p-6 text-center font-bold text-xl text-green-600">
                    Student’s Choice Consultancy
                </div>
                <nav class="mt-10">
                    <a href="{{ url('/') }}" class="block py-2.5 px-4 {{ Route::currentRouteName() == 'dashboard' ? 'bg-green-200 text-green-700' : 'text-gray-700 hover:bg-green-200 hover:text-green-700' }}">
                        Dashboard
                    </a>
                    <a href="{{ route('calling-portal') }}" class="block py-2.5 px-4 {{ Route::currentRouteName() == 'calling-portal' ? 'bg-green-200 text-green-700' : 'text-gray-700 hover:bg-green-200 hover:text-green-700' }}">
                        Calling Portal
                    </a>
                    <a href="{{ route('report') }}" class="block py-2.5 px-4 {{ Route::currentRouteName() == 'report' ? 'bg-green-200 text-green-700' : 'text-gray-700 hover:bg-green-200 hover:text-green-700' }}">
                        Report
                    </a>
                    
                    
                    <a href="{{ route('leads') }}" class="block py-2.5 px-4 {{ Route::currentRouteName() == 'leads' ? 'bg-green-200 text-green-700' : 'text-gray-700 hover:bg-green-200 hover:text-green-700' }}">
                        Leads
                    </a>
                    <a href="{{ route('admins') }}" class="block py-2.5 px-4 {{ Route::currentRouteName() == 'admins' ? 'bg-green-200 text-green-700' : 'text-gray-700 hover:bg-green-200 hover:text-green-700' }}">
                        Admin
                    </a>

                    <a href="{{ route('user.showProfile') }}" class="block py-2.5 px-4 {{ Route::currentRouteName() == 'user.showProfile' ? 'bg-green-200 text-green-700' : 'text-gray-700 hover:bg-green-200 hover:text-green-700' }}">
                        Profile
                    </a>
                </nav>
            </aside>

            <!-- Main Content -->
            <main class="flex-1 p-6 bg-gray-50">
                @yield('content')
            </main>
        </div>
    </div>
</body>
</html>
