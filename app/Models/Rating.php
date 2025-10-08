<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Rating extends Model
{
    use HasFactory;

    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        'barter_id',
        'rater_id',
        'rated_id',
        'rating',
        'comment',
    ];

    public function rater()
    {
        return $this->belongsTo(User::class, 'rater_id');
    }
}