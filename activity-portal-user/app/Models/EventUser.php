<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class EventUser extends Model
{
    protected $table = 'event_user'; // Custom table name if needed (if not following the default Laravel naming convention for pivot tables)

    protected $fillable = ['user_id', 'event_id'];

    public $timestamps = false; // Assuming you don't need timestamps in the pivot table

    /**
     * Define the relationship with the `User` model.
     */
    public function user()
    {
        return $this->belongsTo(User::class);
    }

    /**
     * Define the relationship with the `Event` model.
     */
    public function event()
    {
        return $this->belongsTo(Event::class);
    }
}
