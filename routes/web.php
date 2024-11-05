<?php


use App\Imports\LeadsImport;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\AdminController;
use App\Http\Controllers\LeadController;
use App\Http\Controllers\CallingPortalController;
use App\Http\Controllers\ReportController;
use App\Http\Controllers\SettingController;
use App\Http\Controllers\AdvisorController;
use App\Http\Controllers\UserAuthController;
use App\Http\Controllers\UserController;








// Homepage (Choose either index or dashboard, or modify the URLs if both are needed)
// Route::get('/', function () {
//     return view('dashboard');
// })->name('dashboard');


// Homepage (Choose either index or dashboard, or modify the URLs if both are needed)
// Route::get('/dashboard', function () {
//     return view('dashboard');
// })->name('dashboard');


// Calling Portal page
// Route::get('/calling-portal', function () {
//     return view('calling-portal');
// })->name('calling-portal');


// Report page
// Route::get('/report', function () {
//     return view('report');
// })->name('report');


// Settings page
Route::get('/settings', function () {
    return view('settings');
})->name('settings');


// Leads page
// Route::get('/leads', function () {
//     return view('leads');
// })->name('leads');


// Admin page
// Route::get('/admin', function () {
//     return view('admin');
// })->name('admin');


Route::group(['middleware' => ['auth:admin']], function () {
    // Admin routes
});

// // Homepage route directing to dashboard
Route::get('/', [DashboardController::class, 'index'])->name('dashboard');

// // Dashboard route
// Route::get('/dashboard', [DashboardController::class, 'index'])->name('dashboard');

// // Calling Portal page route
// Route::get('/calling-portal', [CallingPortalController::class, 'index'])->name('calling-portal');


Route::get('/calling-portal', [CallingPortalController::class, 'index'])->name('calling-portal');
Route::get('/calling-portal/{id}/edit', [CallingPortalController::class, 'edit'])->name('calling-portal.edit');
Route::put('/calling-portal/{id}', [CallingPortalController::class, 'update'])->name('calling-portal.update');


Route::group(['middleware' => ['auth:advisor,admin']], function () {
    Route::get('/calling-portal', [CallingPortalController::class, 'index'])->name('calling-portal');
    Route::get('/calling-portal/{id}/edit', [CallingPortalController::class, 'edit'])->name('calling-portal.edit');
    Route::put('/calling-portal/{id}', [CallingPortalController::class, 'update'])->name('calling-portal.update');

});



// // Report page route
Route::get('/report', [ReportController::class, 'index'])->name('report');

// // Settings page route
// Route::get('/settings', [SettingController::class, 'index'])->name('settings');

// // Leads page route
// Route::get('/leads', [LeadController::class, 'index'])->name('leads');
// Route::resource('leads', LeadController::class);
// Define individual routes for the leads management system
Route::get('/leads', [LeadController::class, 'index'])->name('leads');
Route::get('/leads/create', [LeadController::class, 'create'])->name('leads.create');
Route::get('/leads/upload', [LeadController::class, 'upload'])->name('leads.upload');
Route::post('/leads', [LeadController::class, 'store'])->name('leads.store');
Route::get('/leads/{lead}', [LeadController::class, 'show'])->name('leads.show');
Route::get('/leads/{lead}/edit', [LeadController::class, 'edit'])->name('leads.edit');
Route::put('/leads/{lead}', [LeadController::class, 'update'])->name('leads.update');
Route::delete('/leads/{lead}', [LeadController::class, 'destroy'])->name('leads.destroy');

// Add these routes for uploading leads
Route::post('/leads/import', [LeadController::class, 'import'])->name('leads.import');
Route::get('/report/export-csv', [ReportController::class, 'exportToCSV'])->name('report.export.csv');
Route::get('/report/export-pdf', [ReportController::class, 'exportToPDF'])->name('report.export.pdf');

// // Admin Routes
// Route::get('/admins', [AdminController::class, 'index'])->name('admins');
// Route::get('/admins/create', [AdminController::class, 'create'])->name('admins.create');
// Route::post('/admins', [AdminController::class, 'store'])->name('admins.store');
// // Route::get('/admins/{admins}', [AdminController::class, 'show'])->name('admins.show');
// Route::get('/admins/{admin}/edit', [AdminController::class, 'edit'])->name('admins.edit');
// Route::put('/admins/{admin}', [AdminController::class, 'update'])->name('admins.update');
// Route::delete('/admins/{admin}', [AdminController::class, 'destroy'])->name('admins.destroy');

// //uesr routes


// // Route::resource('admins', AdminController::class);

// // Advisor Routes
// Route::get('/advisors/create', [AdvisorController::class, 'create'])->name('advisors.create');
// Route::post('/advisors', [AdvisorController::class, 'store'])->name('advisors.store');
// // Route::get('/admins/{admins}', [AdminController::class, 'show'])->name('admins.show');
// Route::get('/advisors/{advisor}/edit', [AdvisorController::class, 'edit'])->name('advisors.edit');
// Route::put('/advisors/{advisor}', [AdvisorController::class, 'update'])->name('advisors.update');
// Route::delete('/advisors/{advisor}', [AdvisorController::class, 'destroy'])->name('advisors.destroy');


// Protecting Admin Routes
Route::group(['middleware' => ['auth:admin']], function () {
    Route::get('/admins', [AdminController::class, 'index'])->name('admins');
    Route::get('/admins/create', [AdminController::class, 'create'])->name('admins.create');
    Route::post('/admins', [AdminController::class, 'store'])->name('admins.store');
    Route::get('/admins/{admin}/edit', [AdminController::class, 'edit'])->name('admins.edit');
    Route::put('/admins/{admin}', [AdminController::class, 'update'])->name('admins.update');
    Route::delete('/admins/{admin}', [AdminController::class, 'destroy'])->name('admins.destroy');

    // Advisor Routes
    Route::get('/advisors/create', [AdvisorController::class, 'create'])->name('advisors.create');
    Route::post('/advisors', [AdvisorController::class, 'store'])->name('advisors.store');
    Route::get('/advisors/{advisor}/edit', [AdvisorController::class, 'edit'])->name('advisors.edit');
    Route::put('/advisors/{advisor}', [AdvisorController::class, 'update'])->name('advisors.update');
    Route::delete('/advisors/{advisor}', [AdvisorController::class, 'destroy'])->name('advisors.destroy');
});


//error 
Route::get('/error', function () {
    return view('admins.error'); // Adjust to your actual error view
})->name('error');

//login
Route::get('/login', function () {
    return view('login');
})->name('login');

Route::post('/login', [UserAuthController::class, 'login']);

//logout
Route::post('/logout', function () {
    if (Auth::guard('admin')->check()) {
        Auth::guard('admin')->logout();
        \Log::info('Admin loggd out');
    } else if (Auth::guard('advisor')->check()) {
        Auth::guard('advisor')->logout();
        \Log::info('Advisor logged out');
    }
    return redirect()->route('login')->with('message', 'Logged out successfully.');
})->name('logout');



//for profile
Route::group(['middleware' => ['auth:advisor,admin']], function () {
    Route::get('/profile', [UserController::class, 'showProfile'])->name('user.showProfile');
    Route::get('/profile/edit', [UserController::class, 'editProfile'])->name('user.editProfile');
    Route::put('/profile', [UserController::class, 'updateProfile'])->name('user.updateProfile');
});




// Route::get('/debug-auth', function () {
//     return response()->json([
//         'admin_guard' => Auth::guard('admin')->check(),
//     ]);
// });










// // Additional routes for CRUD operations for Admin
// Route::post('/admin/create', [AdminController::class, 'create'])->name('admin.create');
// Route::post('/admin/update/{id}', [AdminController::class, 'update'])->name('admin.update');
// Route::post('/admin/delete/{id}', [AdminController::class, 'delete'])->name('admin.delete');

// // CRUD operations for Leads
// Route::post('/lead/create', [LeadController::class, 'create'])->name('lead.create');
// Route::post('/lead/update/{id}', [LeadController::class, 'update'])->name('lead.update');
// Route::post('/lead/delete/{id}', [LeadController::class, 'delete'])->name('lead.delete');

// // Route to update lead status from Calling Portal
// Route::post('/calling-portal/update-lead/{id}', [CallingPortalController::class, 'updateLeadStatus'])->name('lead.status.update');



