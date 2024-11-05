<?php
namespace App\Http\Controllers;

use App\Models\Advisor;
use App\Models\Report;
use Illuminate\Http\Request;
use PDF;

class ReportController extends Controller
{
    public function index(Request $request)
    {
        // Fetch advisors
        $advisors = Advisor::all();

        // Handle filters
        $query = Report::query();

        if ($request->has('advisor') && $request->advisor != '') {
            $query->where('advisor_id', $request->advisor);
        }

        if ($request->has('metric') && $request->metric != '') {
            $query->orderBy($request->metric, 'desc');
        }

        if ($request->has('date') && $request->date != '') {
            $query->whereDate('created_at', $request->date);
        }

        $reports = $query->paginate(10);

        return view('report', compact('reports', 'advisors'));
    }

    // Export to CSV
    public function exportToCsv(Request $request)
    {
        $fileName = 'advisor_reports.csv';
        $reports = Report::all();

        $headers = array(
            "Content-type"        => "text/csv",
            "Content-Disposition" => "attachment; filename=$fileName",
            "Pragma"              => "no-cache",
            "Cache-Control"       => "must-revalidate, post-check=0, pre-check=0",
            "Expires"             => "0"
        );

        $columns = ['Advisor Name', 'Total Leads', 'Conversions', 'Revenue Generated', 'Date Joined'];

        $callback = function() use($reports, $columns) {
            $file = fopen('php://output', 'w');
            fputcsv($file, $columns);

            foreach ($reports as $report) {
                $row['Advisor Name']  = $report->advisor->name;
                $row['Total Leads']    = $report->total_leads;
                $row['Conversions']    = $report->conversions;
                $row['Revenue Generated']  = $report->revenue_generated;
                $row['Date Joined']  = $report->created_at->format('d-M-Y');

                fputcsv($file, array($row['Advisor Name'], $row['Total Leads'], $row['Conversions'], $row['Revenue Generated'], $row['Date Joined']));
            }

            fclose($file);
        };

        return response()->stream($callback, 200, $headers);
    }

    // Export to PDF
    public function exportToPdf()
    {
        $reports = Report::all();
        $pdf = PDF::loadView('reports.pdf', compact('reports'));

        return $pdf->download('advisor_reports.pdf');
    }
}
