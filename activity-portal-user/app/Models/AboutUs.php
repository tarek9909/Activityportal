<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class AboutUs extends Model
{
    // Table name
    protected $table = 'about_us';

    // Fillable fields
    protected $fillable = ['brief', 'vision', 'mission'];
}
