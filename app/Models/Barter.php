<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Barter extends Model
{
    use HasFactory;

    protected $guarded = [];

    public function requestedItem()
    {
        return $this->belongsTo(Item::class, 'requested_item_id');
    }

    public function offeredItem()
    {
        return $this->belongsTo(Item::class, 'offered_item_id');
    }

    public function owner()
    {
        return $this->belongsTo(User::class, 'owner_id');
    }

    public function offerer()
    {
        return $this->belongsTo(User::class, 'offerer_id');
    }
    
    public function messages()
    {
        return $this->hasMany(Message::class);
    }

        public function ratings()
    {
        return $this->hasMany(Rating::class);
    }

}