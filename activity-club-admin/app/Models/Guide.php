<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model; // Add this

class Guide extends Model
{
    use HasFactory;

    protected $fillable = ['member_id', 'event_id', 'joining_date','profession'];

    public function member()
    {
        return $this->belongsTo(Member::class);
    }

    public function event()
    {
        return $this->belongsTo(Event::class);
    }


}
