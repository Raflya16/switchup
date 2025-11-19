<?php

namespace App\Http\Controllers;

use App\Models\Barter;
use App\Models\Item;
use App\Models\User;
use App\Notifications\NewBarterOffer;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;

class BarterController extends Controller
{
    // TAHAP 2: Pengajuan Penawaran (Token B Ditahan)
    public function makeOffer(Request $request)
    {
        $request->validate([
            'requested_item_id' => 'required|exists:items,id',
            'offered_item_id' => 'required|exists:items,id',
        ]);

        // Cek Token Penawar (B)
        if (Auth::user()->tokens < 1) {
            return back()->with('error', 'Anda memerlukan minimal 1 Token untuk mengajukan penawaran resmi.');
        }

        DB::transaction(function () use ($request) {
            // 1. Tahan (Kurangi) 1 Token dari Penawar
            Auth::user()->decrement('tokens');

            // 2. Buat Barter (Status Pending)
            $barter = Barter::create([
                'owner_id' => Item::find($request->requested_item_id)->user_id,
                'requested_item_id' => $request->requested_item_id,
                'offerer_id' => Auth::id(),
                'offered_item_id' => $request->offered_item_id,
                'status' => 'pending'
            ]);

            // Notifikasi ke Pemilik (A)
            $itemOwner = User::find($barter->owner_id);
            if ($itemOwner) {
                $itemOwner->notify(new NewBarterOffer($barter));
            }
        });

        return redirect()->route('home')->with('success', 'Penawaran resmi dikirim! 1 Token Anda ditahan sebagai jaminan.');
    }

    // TAHAP 3: Respon Penawaran (Terima = Kunci 2 Token, Tolak = Kembalikan Token B)
    public function respondOffer(Request $request, Barter $barter)
    {
        if ($barter->owner_id !== Auth::id()) abort(403);

        // Skenario TOLAK: Kembalikan Token B
        if ($request->status == 'rejected') {
            DB::transaction(function () use ($barter) {
                // Kembalikan 1 Token ke Penawar (B)
                $barter->offerer->increment('tokens');
                $barter->update(['status' => 'rejected']);
            });
            return redirect()->route('barters.index')->with('success', 'Penawaran ditolak. Token penawar telah dikembalikan.');
        }

        // Skenario TERIMA: Tahan Token A (Total 2 Token Terkunci)
        if ($request->status == 'accepted') {
            if (Auth::user()->tokens < 1) {
                return back()->with('error', 'Anda memerlukan 1 Token untuk menerima penawaran ini (Biaya Layanan).');
            }

            DB::transaction(function () use ($barter) {
                // 1. Tahan (Kurangi) 1 Token dari Pemilik (A)
                $barter->owner->decrement('tokens');

                // 2. Update Status jadi Accepted (Terkunci)
                $barter->update(['status' => 'accepted']);

                // 3. Update Status Barang jadi Unavailable
                $barter->requestedItem->update(['status' => 'unavailable']);
                $barter->offeredItem->update(['status' => 'unavailable']);
                
                // 4. Tolak otomatis penawaran lain (dan kembalikan token mereka jika ada)
                // (Logic pengembalian token massal bisa ditambahkan di sini jika perlu)
            });

            return redirect()->route('barters.index')->with('success', 'Penawaran diterima! Transaksi terkunci. Silakan masukkan nomor resi.');
        }
    }

    // TAHAP 4: Input Resi (Logistik)
    public function updateResi(Request $request, Barter $barter)
    {
        $request->validate(['resi' => 'required|string']);
        $user = Auth::user();

        if ($user->id == $barter->owner_id) {
            $barter->update(['resi_owner' => $request->resi]);
        } elseif ($user->id == $barter->offerer_id) {
            $barter->update(['resi_offerer' => $request->resi]);
        } else {
            abort(403);
        }

        return back()->with('success', 'Nomor resi berhasil disimpan.');
    }

    // TAHAP 5: Konfirmasi Penerimaan (Penyelesaian)
    public function confirmTransaction(Request $request, Barter $barter)
    {
        $user = Auth::user();

        DB::transaction(function () use ($barter, $user) {
            if ($user->id == $barter->owner_id) {
                $barter->update(['confirmed_owner' => true]);
            } elseif ($user->id == $barter->offerer_id) {
                $barter->update(['confirmed_offerer' => true]);
            }

            // Cek apakah KEDUANYA sudah konfirmasi
            // Kita perlu refresh model untuk dapat data terbaru
            $barter->refresh();
            
            if ($barter->confirmed_owner && $barter->confirmed_offerer) {
                $barter->update(['status' => 'completed']);
                // Token sudah ditarik di awal, jadi tidak perlu aksi token lagi.
                // Transaksi selesai, token hangus sebagai biaya layanan.
            }
        });

        return back()->with('success', 'Konfirmasi berhasil diterima.');
    }

    // Method Index (Tidak Berubah, hanya memuat data)
    public function index()
    {
        $userId = auth()->id();
        $incomingOffers = Barter::where('owner_id', $userId)
            ->with(['offerer.ratingsReceived', 'offeredItem', 'requestedItem', 'ratings'])
            ->latest()->get();
        $sentOffers = Barter::where('offerer_id', $userId)
            ->with(['owner.ratingsReceived', 'offeredItem', 'requestedItem', 'ratings'])
            ->latest()->get();
        return view('barters.index', compact('incomingOffers', 'sentOffers'));
    }
}