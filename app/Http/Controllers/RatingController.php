<?php

namespace App\Http\Controllers;

use App\Models\Rating;
use App\Models\Barter;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class RatingController extends Controller
{
    public function create(Barter $barter)
    {
        // 1. Cek Otorisasi: Apakah user yang login terlibat dalam barter ini?
        if (Auth::id() !== $barter->owner_id && Auth::id() !== $barter->offerer_id) {
            abort(403, 'ANDA TIDAK BISA MEMBERI ULASAN UNTUK TRANSAKSI INI.');
        }

        // 2. Cek Status: Hanya boleh ulas jika status 'accepted' ATAU 'completed'
        if (!in_array($barter->status, ['accepted', 'completed'])) {
            abort(403, 'Transaksi belum selesai, Anda belum bisa memberikan ulasan.');
        }

        // 3. Cek Duplikat: Apakah user ini sudah pernah memberi ulasan sebelumnya?
        $alreadyRated = Rating::where('barter_id', $barter->id)
                              ->where('rater_id', Auth::id())
                              ->exists();

        if ($alreadyRated) {
            return redirect()->route('barters.index')->with('error', 'Anda sudah memberikan ulasan untuk transaksi ini.');
        }

        return view('ratings.create', compact('barter'));
    }

    public function store(Request $request, Barter $barter)
    {
        // Validasi Input
        $request->validate([
            'rating' => 'required|integer|min:1|max:5',
            'comment' => 'nullable|string',
        ]);

        // Cek Otorisasi lagi untuk keamanan
        if (Auth::id() !== $barter->owner_id && Auth::id() !== $barter->offerer_id) {
            abort(403, 'Akses Ditolak.');
        }

        // Tentukan siapa yang dinilai (Lawan Bicara)
        $ratedId = (Auth::id() === $barter->owner_id) ? $barter->offerer_id : $barter->owner_id;

        // Simpan Rating
        Rating::create([
            'barter_id' => $barter->id,
            'rater_id' => Auth::id(),
            'rated_id' => $ratedId,
            'rating' => $request->rating,
            'comment' => $request->comment,
        ]);

        return redirect()->route('barters.index')->with('success', 'Ulasan berhasil dikirim! Terima kasih.');
    }
}