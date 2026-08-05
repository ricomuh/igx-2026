<?php

namespace App\Http\Controllers\Ticket;

use App\Http\Controllers\Controller;
use App\Models\Order;
use Illuminate\Http\Request;

class StatusController extends Controller
{
    public function index()
    {
        return view('ticket.status');
    }

    public function lookup(Request $request)
    {
        $validated = $request->validate([
            'order_number' => ['required', 'string', 'max:32'],
            'customer_email' => ['required', 'email', 'max:255'],
        ]);

        $order = Order::where('order_number', $validated['order_number'])
            ->where('customer_email', $validated['customer_email'])
            ->first();

        if (! $order) {
            return back()
                ->withErrors(['order_number' => 'Order tidak ditemukan. Cek kembali nomor order dan email.'])
                ->withInput();
        }

        return redirect()->route('ticket.payment', $order->order_number);
    }
}
