<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class CallingPortal extends Model
{
    use HasFactory;
    protected $fillable = ['phone', 'date', 'amount', 'status'];


    public function getStatusBackgroundColorAttribute()
    {
        switch ($this->status) {
            case 'new':
                return 'bg-yellow-200';
            case 'contacted':
                return 'bg-blue-200';
            case 'completed':
                return 'bg-green-400';
            case 'lost':
                return 'bg-red-200';
            case 'pending':
                return 'bg-gray-200';
            case 'failed':
                return 'bg-purple-200';
            default:
                return 'bg-gray-200';
        }
    }

    public function getStatusColorAttribute()
    {
        switch ($this->status) {
            case 'new':
                return 'yellow';
            case 'contacted':
                return 'blue';
            case 'completed':
                return 'green';
            case 'lost':
                return 'red';
            case 'pending':
                return 'gray';
            case 'failed':
                return 'purple';
            default:
                return 'gray';
        }
    }

}
