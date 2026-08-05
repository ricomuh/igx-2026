<?php

namespace App\Http\Controllers\Ticket;

use App\Http\Controllers\Controller;
use App\Models\Order;
use App\Models\Payment;
use Illuminate\Http\Request;

class PaymentController extends Controller
{
    public function show(Order $order)
    {
        $order->load(['items', 'payments']);

        return view('ticket.payment', ['order' => $order]);
    }

    public function upload(Request $request, Order $order)
    {
        if ($order->status !== Order::STATUS_PENDING) {
            return back()->with('error', 'Pembayaran order ini sudah diproses.');
        }

        $validated = $request->validate([
            'reference_number' => ['required', 'string', 'max:64'],
            'proof' => ['required', 'image', 'mimes:jpg,jpeg,png,webp', 'max:2048'],
        ]);

        $path = $request->file('proof')->store('', 'proofs');

        Payment::create([
            'order_id' => $order->id,
            'method' => 'transfer',
            'reference_number' => $validated['reference_number'],
            'amount' => $order->total_amount,
            'proof_path' => basename($path),
            'status' => Payment::STATUS_PENDING,
        ]);

        $order->update(['status' => Order::STATUS_WAITING_CONFIRMATION]);

        return redirect()
            ->route('ticket.payment', $order->order_number)
            ->with('success', 'Bukti pembayaran diterima. Menunggu verifikasi admin.');
    }
}
