@extends('layouts.app')

@section('content')
<div class="p-8">
    <!-- Page Heading -->
    <div class="mb-4 flex justify-between items-center">
        <h1 class="text-3xl font-semibold text-gray-700">Dashboard</h1>
        <div class="text-sm text-gray-500">Today: {{ \Carbon\Carbon::now()->toFormattedDateString() }}</div>
    </div>

    <!-- Stats Section -->
    <div class="grid grid-cols-1 md:grid-cols-4 gap-6 mb-6">
        <!-- Card: Total Users -->
        <div class="bg-white p-6 rounded-lg shadow-lg">
            <div class="flex items-center">
                <div class="bg-blue-500 p-3 rounded-full text-white">
                    <i class="fas fa-users"></i>
                </div>
                <div class="ml-4">
                    <h3 class="text-lg font-semibold">Total Admins</h3>
                    <p class="text-gray-600 text-xl">{{$totalAdmins}}</p>
                </div>
            </div>
        </div>

        <!-- Card: Active Users -->
        <div class="bg-white p-6 rounded-lg shadow-lg">
            <div class="flex items-center">
                <div class="bg-green-500 p-3 rounded-full text-white">
                    <i class="fas fa-user-check"></i>
                </div>
                <div class="ml-4">
                    <h3 class="text-lg font-semibold">Total Advisors</h3>
                    <p class="text-gray-600 text-xl">{{$totalAdvisors}}</p>
                </div>
            </div>
        </div>

        <!-- Card: New Leads -->
        <div class="bg-white p-6 rounded-lg shadow-lg">
            <div class="flex items-center">
                <div class="bg-yellow-500 p-3 rounded-full text-white">
                    <i class="fas fa-chart-line"></i>
                </div>
                <div class="ml-4">
                    <h3 class="text-lg font-semibold">Total Leads</h3>
                    <p class="text-gray-600 text-xl">{{$totalLeads}}</p>
                </div>
            </div>
        </div>

        <!-- Card: Monthly Revenue -->
        <div class="bg-white p-6 rounded-lg shadow-lg">
            <div class="flex items-center">
                <div class="bg-red-500 p-3 rounded-full text-white">
                    <i class="fas fa-dollar-sign"></i>
                </div>
                <div class="ml-4">
                    <h3 class="text-lg font-semibold">Monthly Revenue</h3>
                    <p class="text-gray-600 text-xl">₹{{number_format($monthlyRevenue, 2)}}</p>
                </div>
            </div>
        </div>
    </div>

    <!-- Graphs/Reports Section -->
    <div class="grid grid-cols-1 lg:grid-cols-2 gap-6">
        <!-- Graph: Users Growth -->
        <div class="bg-white p-6 rounded-lg shadow-lg">
            <h3 class="text-lg font-semibold mb-4">User Growth</h3>
            <canvas id="userGrowthChart"></canvas>
        </div>

        <!-- Graph: Revenue Growth -->
        <div class="bg-white p-6 rounded-lg shadow-lg">
            <h3 class="text-lg font-semibold mb-4">Revenue Growth</h3>
            <canvas id="revenueGrowthChart"></canvas>
        </div>
    </div>

    <!-- Recent Activity -->
    <div class="mt-8">
        <h3 class="text-lg font-semibold mb-4">Recent Activity</h3>
        <div class="bg-white p-6 rounded-lg shadow-lg">
            <ul class="divide-y divide-gray-200">
                <li class="py-4 flex">
                    <div class="text-green-500 p-3 rounded-full bg-green-100">
                        <i class="fas fa-user-plus"></i>
                    </div>
                    <div class="ml-4">
                        <p class="text-gray-700">New user <span class="font-semibold">John Doe</span> registered.</p>
                        <p class="text-sm text-gray-500">2 hours ago</p>
                    </div>
                </li>
                <li class="py-4 flex">
                    <div class="text-yellow-500 p-3 rounded-full bg-yellow-100">
                        <i class="fas fa-envelope"></i>
                    </div>
                    <div class="ml-4">
                        <p class="text-gray-700">Lead <span class="font-semibold">Jane Smith</span> has sent an inquiry.</p>
                        <p class="text-sm text-gray-500">5 hours ago</p>
                    </div>
                </li>
                <li class="py-4 flex">
                    <div class="text-blue-500 p-3 rounded-full bg-blue-100">
                        <i class="fas fa-money-check-alt"></i>
                    </div>
                    <div class="ml-4">
                        <p class="text-gray-700">Revenue from <span class="font-semibold">Project X</span> has been updated.</p>
                        <p class="text-sm text-gray-500">1 day ago</p>
                    </div>
                </li>
                <!-- Add more activities as needed -->
            </ul>
        </div>
    </div>
</div>

<script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
    <script>
        var ctx1 = document.getElementById('userGrowthChart').getContext('2d');
        var userGrowthChart = new Chart(ctx1, {
            type: 'line',
            data: {
                labels: ['Jan', 'Feb', 'Mar', 'Apr', 'May', 'Jun', 'Jul', 'Aug', 'Sep', 'Oct', 'Nov', 'Dec'],
                datasets: [{
                    label: 'Leads',
                    data: @json($leadCounts),
                    backgroundColor: 'rgba(54, 162, 235, 0.2)',
                    borderColor: 'rgba(54, 162, 235, 1)',
                    borderWidth: 1,
                    fill: false,
                }]
            },
            options: {
                responsive: true,
                scales: {
                    x: {
                        display: true,
                        title: {
                            display: true,
                            text: 'Month'
                        }
                    },
                    y: {
                        display: true,
                        title: {
                            display: true,
                            text: 'Value'
                        }
                    }
                }
            }
        });

        var ctx2 = document.getElementById('revenueGrowthChart').getContext('2d');
        var revenueGrowthChart = new Chart(ctx2, {
            type: 'bar',
            data: {
                labels: ['Jan', 'Feb', 'Mar', 'Apr', 'May', 'Jun', 'Jul', 'Aug', 'Sep', 'Oct', 'Nov', 'Dec'],
                datasets: [{
                    label: 'Revenue ($)',
                    data: @json($revenueData),
                    backgroundColor: 'rgba(255, 99, 132, 0.2)',
                    borderColor: 'rgba(255, 99, 132, 1)',
                    borderWidth: 1,
                    fill: false,
                }]
            },
            options: {
                responsive: true,
                scales: {
                    x: {
                        display: true,
                        title: {
                            display: true,
                            text: 'Month'
                        }
                    },
                    y: {
                        display: true,
                        title: {
                            display: true,
                            text: 'Value'
                        }
                    }
                }
            }
        });

       

    </script>


@endsection



