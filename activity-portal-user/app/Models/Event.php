<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Event extends Model
{
    // Define the table name if it doesn't follow the default plural convention
    protected $table = 'events';

    // Define the fillable fields
    protected $fillable = [
        'name',
        'description',
        'category_id',
        'destination',
        'date_from',
        'date_to',
        'cost',
        'status',
    ];
}
