<?php




namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Lead;
use Maatwebsite\Excel\Facades\Excel;
use App\Imports\LeadsImport; // Import the LeadsImport class

class LeadController extends Controller
{
    public function index(Request $request)
    {
        $query = Lead::query();

        if ($request->has('search')) {
            $query->where('name', 'like', '%' . $request->search . '%')
                  ->orWhere('phone', 'like', '%' . $request->search . '%')
                  ->orWhere('occupation', 'like', '%' . $request->search . '%');
        }

        if ($request->has('occupation')) {
            $query->where('occupation', $request->occupation);
        }

        if ($request->has('status')) {
            $query->where('status', $request->status);
        }

        $leads = $query->paginate(10);

        return view('leads', compact('leads'));
    }

    public function create()
    {
        return view('leads.create');
    }

    public function upload()
    {
        return view('leads.upload');
    }

    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required|string|max:100',
            'phone' => 'required|string|max:20',
            'email' => 'required|email|max:100',
            'occupation' => 'required|string|max:255', // Ensure occupation is validated
            'status' => 'required|string|in:new,contacted,completed,lost,pending,failed',
            'amount' => 'nullable|decimal', // Added validation for amount
        ]);

        Lead::create($request->all());

        return redirect()->route('leads')->with('success', 'Lead created successfully.');
    }

    public function show(Lead $lead)
    {
        return view('leads.show', compact('lead'));
    }

    public function edit(Lead $lead)
    {
        return view('leads.edit', compact('lead'));
    }

    public function update(Request $request, Lead $lead)
    {
        $request->validate([
            'name' => 'required|string|max:100',
            'phone' => 'required|string|max:20',
            'email' => 'required|email|max:100',
            'occupation' => 'required|string|max:255', // Ensure occupation is validated
            'status' => 'required|string|in:new,contacted,completed,lost,pending,failed',
            'amount' => 'nullable|numeric', // Added validation for amount
        ]);

        $lead->update($request->all());

        return redirect()->route('leads')->with('success', 'Lead updated successfully.');
    }

    public function destroy(Lead $lead)
    {
        $lead->delete();

        return redirect()->route('leads')->with('success', 'Lead deleted successfully.');
    }

    // to upload lead using excel file 
    // public function upload()
    // {
    //     return view('leads.upload');
    // }

    public function import(Request $request)
    {
        $request->validate([
            'file' => 'required|mimes:xlsx,xls,csv',
        ]);

        Excel::import(new LeadsImport, $request->file('file'));

        return redirect()->route('leads')->with('success', 'Leads imported successfully.');
    }

    

}