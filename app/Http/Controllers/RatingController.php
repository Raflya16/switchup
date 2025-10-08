<?php

namespace App\Http\Controllers;

use App\Models\Barter;
use App\Models\Rating;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class RatingController extends Controller
{
    public function create(Barter $barter)
    {
        // Otorisasi: Pastikan status barter "accepted" dan user terlibat
        if ($barter->status !== 'accepted' || (Auth::id() !== $barter->owner_id && Auth::id() !== $barter->offerer_id)) {
            abort(403, 'Anda tidak bisa memberi ulasan untuk transaksi ini.');
        }

        // Cek apakah user sudah pernah memberi ulasan untuk barter ini
        $existingRating = Rating::where('barter_id', $barter->id)->where('rater_id', Auth::id())->exists();
        if ($existingRating) {
            return redirect()->route('dashboard')->with('error', 'Anda sudah memberikan ulasan untuk transaksi ini.');
        }

        return view('ratings.create', compact('barter'));
    }

    public function store(Request $request, Barter $barter)
    {
        // Otorisasi (cek ulang)
        if ($barter->status !== 'accepted' || (Auth::id() !== $barter->owner_id && Auth::id() !== $barter->offerer_id)) {
            abort(403);
        }
        $existingRating = Rating::where('barter_id', $barter->id)->where('rater_id', Auth::id())->exists();
        if ($existingRating) {
            abort(403, 'Ulasan sudah ada.');
        }

        $request->validate([
            'rating' => 'required|integer|min:1|max:5',
            'comment' => 'nullable|string|max:1000',
        ]);

        // Tentukan siapa yang di-rate
        $ratedId = (Auth::id() === $barter->owner_id) ? $barter->offerer_id : $barter->owner_id;

        Rating::create([
            'barter_id' => $barter->id,
            'rater_id' => Auth::id(),
            'rated_id' => $ratedId,
            'rating' => $request->rating,
            'comment' => $request->comment,
        ]);

        return redirect()->route('users.show', $ratedId)->with('success', 'Ulasan berhasil dikirim!');
    }
}