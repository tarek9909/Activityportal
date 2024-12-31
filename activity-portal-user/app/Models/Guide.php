<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Guide extends Model
{
    use HasFactory;

    // Define the table if it's not the plural of the model name
    protected $table = 'guides';

    // Define the fillable columns to allow mass assignment
    protected $fillable = [
        'member_id',
        'joining_date',
        'event_id',
    ];

    // Define the relationships

    /**
     * Get the member associated with the guide.
     */
    public function member()
    {
        return $this->belongsTo(Member::class, 'member_id');
    }

    /**
     * Get the event associated with the guide.
     */
    public function event()
    {
        return $this->belongsTo(Event::class, 'event_id');
    }

    /**
     * Get the user through the member.
     */
    public function user()
    {
        return $this->hasOneThrough(User::class, Member::class, 'id', 'id', 'member_id', 'user_id');
    }
}
