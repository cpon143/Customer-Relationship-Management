<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;
use App\Models\Lead;
use App\Models\Admin;
use App\Models\Advisor;
use Carbon\Carbon;

class DashboardController extends Controller
{
    public function index()
    {
        // $totalUsers = User::count();
        // $activeUsers = User::where('status', 'active')->count();
        // $newLeads = Lead::where('status', 'new')->count();
        // $monthlyRevenue = Lead::sum('revenue');

        $totalAdmins = Admin::count();
        $totalAdvisors = Advisor::count();
        $totalLeads = Lead::count();
        $monthlyRevenue = Lead::sum('amount');

        // Fetch data for the chart
        // $userCounts = User::selectRaw('COUNT(*) as count, MONTH(created_at) as month')
        //     ->groupBy('month')
        //     ->orderBy('month')
        //     ->pluck('count', 'month')
        //     ->toArray();

        $leadCounts = Lead::selectRaw('COUNT(*) as count, MONTH(created_at) as month')
            ->groupBy('month')
            ->orderBy('month')
            ->pluck('count', 'month')
            ->toArray();

        $revenueData = Lead::selectRaw('SUM(amount) as total, MONTH(created_at) as month')
            ->groupBy('month')
            ->orderBy('month')
            ->pluck('total', 'month')
            ->toArray();

        // Ensure data arrays have 12 months
        // $userCounts = $this->fillMissingMonths($userCounts);
        // $revenueData = $this->fillMissingMonths($revenueData);

        $leadCounts = $this->fillMissingMonths($leadCounts);
        $revenueData = $this->fillMissingMonths($revenueData);

        return view('dashboard', compact('totalAdmins', 'totalAdvisors', 'totalLeads', 'monthlyRevenue', 'leadCounts', 'revenueData'));
    }

    private function fillMissingMonths($data)
    {
        $filledData = array_fill(1, 12, 0);
        foreach ($data as $month => $value) {
            $filledData[$month] = $value;
        }
        return array_values($filledData);
    }
}