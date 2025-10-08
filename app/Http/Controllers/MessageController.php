<?php

namespace App\Http\Controllers;

use App\Models\Barter;
use App\Models\Message;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class MessageController extends Controller
{
    /**
     * Menampilkan inbox dengan daftar percakapan.
     */
    public function inbox()
    {
        $userId = auth()->id();

        $barters = Barter::where(function ($query) use ($userId) {
                $query->where('owner_id', $userId)
                      ->orWhere('offerer_id', $userId);
            })
            ->whereHas('messages')
            ->with(['requestedItem', 'offeredItem', 'owner', 'offerer'])

            ->withCount(['messages as unread_messages_count' => function ($query) use ($userId) {
                $query->where('receiver_id', $userId)->whereNull('read_at');
            }])
            ->orderBy('unread_messages_count', 'desc') 
            ->latest('updated_at') 
            ->get();

        return view('messages.inbox', compact('barters'));
    }

    /**
     * Menampilkan percakapan spesifik.
     */
    public function index(Barter $barter)
    {

        if (Auth::id() !== $barter->owner_id && Auth::id() !== $barter->offerer_id) {
            abort(403);
        }

        $barter->messages()
               ->where('receiver_id', auth()->id())
               ->whereNull('read_at')
               ->update(['read_at' => now()]);

        $messages = $barter->messages()->orderBy('created_at', 'asc')->get();

        return view('messages.show', compact('barter', 'messages'));
    }

    /**
     * Menyimpan pesan baru.
     */
    public function store(Request $request, Barter $barter)
    {

        if (Auth::id() !== $barter->owner_id && Auth::id() !== $barter->offerer_id) {
            abort(403);
        }

        $request->validate(['body' => 'required|string']);

        $receiverId = (Auth::id() === $barter->owner_id) ? $barter->offerer_id : $barter->owner_id;

        Message::create([
            'barter_id' => $barter->id,
            'sender_id' => Auth::id(),
            'receiver_id' => $receiverId,
            'body' => $request->body,
        ]);
        
        $barter->touch();

        return back();
    }
}