<?php

namespace App\Models;

use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Advisor extends Authenticatable
{
    use HasFactory;

    // Specify the table if it's not the plural form of the class name (optional)
    protected $table = 'advisors'; 

    // Define the fillable attributes to protect against mass assignment vulnerabilities
    protected $fillable = ['name', 'email', 'password', 'role'];
}
