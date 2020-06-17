<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Buildings extends Model
{
    protected $fillable = [
        'city', 'town', 'type', 'price', 'description', 'approverd', 'user_id'
    ];

    /**
     * Get the user that owns the building.
     */
    public function user()
    {
        return $this->belongsTo('App\User', 'foreign_key', 'other_key');
    }
}
