<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Report extends Model
{
    use HasFactory;

    // Define the fillable attributes to protect against mass assignment vulnerabilities
    protected $fillable = ['advisor_name', 'total_leads', 'conversions', 'revenue_generated', 'date_joined'];

    // Specify the table if it's not the plural form of the class name (optional)
    protected $table = 'reports'; 

    // You can also define any relationships here, for example, to link it with the Advisor
    public function advisor()
    {
        return $this->belongsTo(Advisor::class, 'advisor_id');
    }
}
