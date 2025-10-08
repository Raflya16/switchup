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
    public function makeOffer(Request $request)
    {
        $request->validate([
            'requested_item_id' => 'required|exists:items,id',
            'offered_item_id' => 'required|exists:items,id',
        ]);

        $requestedItem = Item::findOrFail($request->requested_item_id);

        if ($requestedItem->user_id == Auth::id()) {
            return back()->with('error', 'Anda tidak bisa menawar barang Anda sendiri.');
        }

        $barter = Barter::create([
            'owner_id' => $requestedItem->user_id,
            'requested_item_id' => $request->requested_item_id,
            'offerer_id' => Auth::id(),
            'offered_item_id' => $request->offered_item_id,
        ]);

        $itemOwner = User::find($requestedItem->user_id);
        if ($itemOwner) {
            $itemOwner->notify(new NewBarterOffer($barter));
        }

        return redirect()->route('home')->with('success', 'Penawaran berhasil dikirim!');
    }

    public function respondOffer(Request $request, Barter $barter)
    {
        $request->validate(['status' => 'required|in:accepted,rejected']);

        if ($barter->owner_id !== Auth::id()) {
            abort(403);
        }

        if ($request->status == 'accepted') {
            $offerer = $barter->offerer;
            $owner = $barter->owner;

            if ($offerer->tokens < 1 || $owner->tokens < 1) {
                return redirect()->route('barters.index')->with('error', 'Penawaran tidak bisa diterima karena salah satu pengguna tidak memiliki token.');
            }

            $offerer->decrement('tokens');
            $owner->decrement('tokens');

            $barter->requestedItem->update(['status' => 'unavailable']);
            $barter->offeredItem->update(['status' => 'unavailable']);

            Barter::where('requested_item_id', $barter->requested_item_id)
                ->where('id', '!=', $barter->id)
                ->where('status', 'pending')
                ->update(['status' => 'rejected']);

            Barter::where('offered_item_id', $barter->offered_item_id)
                ->where('id', '!=', $barter->id)
                ->where('status', 'pending')
                ->update(['status' => 'rejected']);
        }

        $barter->status = $request->status;
        $barter->save();

        return redirect()->route('barters.index')->with('success', 'Penawaran telah direspon.');
    }

    public function index()
    {
        $userId = auth()->id();

        $incomingOffers = Barter::where('owner_id', $userId)
            ->with([
                'offerer.ratingsReceived',
                'offeredItem',
                'requestedItem',
                'ratings' => fn($query) => $query->where('rater_id', $userId)
            ])
            ->latest()->get();

        $sentOffers = Barter::where('offerer_id', $userId)
            ->with([
                'owner.ratingsReceived',
                'offeredItem',
                'requestedItem',
                'ratings' => fn($query) => $query->where('rater_id', $userId)
            ])
            ->latest()->get();

        return view('barters.index', compact('incomingOffers', 'sentOffers'));
    }
}
