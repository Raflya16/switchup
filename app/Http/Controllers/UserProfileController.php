<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;

class UserProfileController extends Controller
{
    public function show(User $user)
    {
        $items = $user->items()->where('status', 'available')->latest()->get();
        
        $ratings = $user->ratingsReceived()->latest()->get();
        $averageRating = $ratings->count() > 0 ? $ratings->avg('rating') : 0;

        return view('users.show', compact('user', 'items', 'ratings', 'averageRating'));
    }
}