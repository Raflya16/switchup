<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Token extends Model
{
    use HasFactory;

    protected $table = 'token_histories';

    protected $fillable = [
        'user_id',
        'token_amount',
        'price',
        'payment_method',
        'order_id',
        'transaction_id',
        'status',
        'paid_at',
    ];

    public function user()
    {
        return $this->belongsTo(User::class);
    }
}
