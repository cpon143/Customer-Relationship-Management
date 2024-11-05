<?php
namespace App\Http\Controllers;


use App\Models\Lead;
use App\Models\CallingPortal;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class CallingPortalController extends Controller
{
    public function index()
    {

        // Fetch the logged-in advisor
        $advisor = Auth::user();
        // Fetch updated rows from calling_portal table
        $updatedRows = CallingPortal::pluck('id')->toArray();

        // Fetch leads from both tables: updated from calling_portal, others from leads
        $leads = Lead::whereNotIn('id', $updatedRows)->get();  // Unchanged rows
        $updatedLeads = CallingPortal::all();  // Updated rows

        // Merge both results into one collection for display
        $allLeads = $updatedLeads->merge($leads);

        return view('calling-portal', compact('allLeads'));
    }

    public function edit($id)
    {
        // Check if the row exists in calling_portal; if not, fetch from leads
        $lead = CallingPortal::find($id) ?? Lead::findOrFail($id);

        return view('calling-portal.edit', compact('lead'));
    }

    public function update(Request $request, $id)
    {
        // Validate the request
        $request->validate([
            'phone' => 'required|string|max:20',
            'amount' => 'nullable|numeric', // Added validation for amount
            'status' => 'required|string|in:new,contacted,completed,lost,pending,failed',
            // 'status' => 'required|in:new,contacted,completed,lost,pending,failed',
        ]);


        // Check if the lead exists in the calling_portal table
        $callingPortalLead = CallingPortal::find($id);

        if ($callingPortalLead) {
            // Update the existing record in calling_portal
            $callingPortalLead->update([
                'phone' => $request->input('phone'),
                'lead_date' => $request->input('lead_date'),
                'amount' => $request->input('amount'),
                'status' => $request->input('status'),
            ]);
        } else {
            // Find the lead in the leads table and store the updated version in calling_portal
            $lead = Lead::findOrFail($id);

            // Prepare the data for update
            $data = [
                'phone' => $request->input('phone', $lead->phone),
                'lead_date' => $request->input('lead_date', $lead->date), // Use the new column name
                'amount' => $request->input('amount', $lead->amount),
                'status' => $request->input('status', $lead->status),
            ];

            // Move the lead to calling_portal with the new data
            CallingPortal::updateOrCreate(
                ['id' => $lead->id],  // Match by ID
                $data
            );


            // Find the lead in the leads table and store the updated version in calling_portal
            // $lead = Lead::findOrFail($id);

            // Move the lead to calling_portal with the new status

            //  // Prepare the data for update
            //  $data = [
            //     'phone' => $request->input('phone', $lead->phone),
            //     'date' => $lead->date,
            //     'amount' => $request->input('amount', $lead->amount),
            //     'status' => $request->input('status', $lead->status),
            // ];

            // // Move the lead to calling_portal with the new data
            // CallingPortal::updateOrCreate(
            //     ['id' => $lead->id],  // Match by ID
            //     $data
            // );
                    ///keep it if error occur
            // CallingPortal::updateOrCreate(
            //     ['id' => $lead->id],  // Match by ID
            //     $lead->only(['phone', 'date', 'amount']) + ['status' => $request->status]
            // );

            //  the phone_number if it's provided
            if ($request->filled('phone')) {
                $requestData['phone'] = $request->input('phone'); // Hash the new password
            } else {
                // If no phone_number is provided, retain the current phone_number
                $requestData['phone'] = $lead->phone;
            }

            // Optionally, remove the lead from the original table if needed
            $lead->delete();

        }

        return redirect()->route('calling-portal')->with('success', 'Lead updated successfully.');
    }
}
