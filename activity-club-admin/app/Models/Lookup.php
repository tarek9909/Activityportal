<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Lookup extends Model
{
    use HasFactory;

    // Specify the fillable fields
    protected $fillable = [
        'code', 
        'name', 
        'order',
    ];
}
