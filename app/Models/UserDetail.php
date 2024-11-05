<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class UserDetail extends Model
{
    use HasFactory;

    protected $fillable = [
        'user_id',
        'user_type',
        'profile_picture',
        'contact_number',
        'email',
        'dob',
        'name',
    ];
    
    public function user()
    {
        // Adjust this relationship based on the actual user table
        return $this->belongsTo(User::class, 'user_id');
    }
}
