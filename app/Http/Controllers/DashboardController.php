<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\Barter;

class DashboardController extends Controller
{
    public function index()
    {
        $user = Auth::user();

        // Ambil data untuk kartu statistik
        $activeItemsCount = $user->items()->where('status', 'available')->count();
        $incomingOffersCount = Barter::where('owner_id', $user->id)->where('status', 'pending')->count();
        $sentOffersCount = Barter::where('offerer_id', $user->id)->where('status', 'pending')->count();

        // Ambil daftar barang milik user
        $userItems = $user->items()->latest()->get();

        return view('dashboard', compact(
            'userItems', 
            'activeItemsCount', 
            'incomingOffersCount', 
            'sentOffersCount'
        ));
    }
}