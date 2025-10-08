<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Token;
use Illuminate\Support\Facades\Auth;
use App\Models\User;
use Midtrans\Config;
use Midtrans\Snap;

class TokenController extends Controller
{
    public function index(Request $request)
    {
        $user = Auth::user();

        $query = Token::where('user_id', $user->id);

        if ($search = $request->input('search')) {
            $query->where(function ($q) use ($search) {
                $q->where('token_amount', 'like', "%{$search}%")
                    ->orWhere('price', 'like', "%{$search}%")
                    ->orWhere('status', 'like', "%{$search}%");
            });
        }

        $histories = $query->orderByDesc('created_at')->paginate(5);

        $saldoToken = $user->tokens ?? 0;

        if ($request->ajax()) {
            return view('token.index', compact('histories', 'saldoToken'))->render();
        }

        return view('token.index', compact('histories', 'saldoToken'));
    }

    public function checkout(Request $request)
    {
        $user = Auth::user();

        $validated = $request->validate([
            'token_amount' => 'required|integer',
            'price' => 'required|integer',
        ]);

        $orderId = 'TOPUP-' . $user->id . '-' . time();

        $tokenTopup = Token::create([
            'user_id' => $user->id,
            'token_amount' => $validated['token_amount'],
            'price' => $validated['price'],
            'status' => 'pending',
            'order_id' => $orderId,
        ]);

        Config::$serverKey = config('services.midtrans.server_key');
        Config::$isProduction = config('services.midtrans.is_production');
        Config::$isSanitized = true;
        Config::$is3ds = true;

        $params = [
            'transaction_details' => [
                'order_id' => $orderId,
                'gross_amount' => $validated['price'],
            ],
            'customer_details' => [
                'first_name' => $user->name,
                'email' => $user->email,
            ],
            'item_details' => [
                [
                    'id' => 'token-' . $validated['token_amount'],
                    'price' => $validated['price'],
                    'quantity' => 1,
                    'name' => $validated['token_amount'] . ' Token',
                ],
            ],
        ];

        $snapToken = Snap::getSnapToken($params);

        return response()->json([
            'snapToken' => $snapToken,
            'order_id' => $orderId,
        ]);
    }

    public function callback(Request $request)
    {
        Config::$serverKey = config('services.midtrans.server_key');
        Config::$isProduction = config('services.midtrans.is_production');
        Config::$isSanitized = true;
        Config::$is3ds = true;

        $notification = new \Midtrans\Notification();

        $status = $notification->transaction_status ?? $request->input('transaction_status');
        $orderId = $notification->order_id ?? $request->input('order_id');
        $paymentType = $notification->payment_type ?? $request->input('payment_type');

        $paidAt = now();

        $tokenHistory = Token::where('order_id', $request->input('order_id'))->first();

        if ($tokenHistory) {
            $tokenHistory->update([
                'transaction_id' => $request->input('transaction_id'),
                'status' => match ($request->input('transaction_status')) {
                    'capture', 'settlement' => 'success',
                    'pending' => 'pending',
                    'deny', 'cancel', 'expire' => 'failed',
                    default => $tokenHistory->status,
                },
                'payment_method' => $request->input('payment_type'),
                'paid_at' => $request->input('transaction_status') === 'settlement' ? now() : null,
            ]);

            if ($tokenHistory->status === 'success') {
                $user = User::find($tokenHistory->user_id);
                if ($user) {
                    $user->tokens = ($user->tokens ?? 0) + $tokenHistory->token_amount;
                    $user->save();
                }
            }
        }

        return response()->json(['message' => 'Callback processed']);
    }

    public function getSaldo()
    {
        $saldo = Auth::user()->tokens ?? 0;
        return response()->json(['saldo' => $saldo]);
    }
}
