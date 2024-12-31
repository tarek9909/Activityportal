<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Event extends Model
{
    use HasFactory;

    protected $fillable = [
        'name', 'description', 'category_id', 'destination', 'date_from', 'date_to', 'cost', 'status',  'max_seats','is_published',  'enrolled_users',
    ];

    // Define relationship to Lookup for category
    public function category()
    {
        return $this->belongsTo(Lookup::class, 'category_id');
    }
}
