<?php

namespace App\Http\Controllers\Ticket;

use App\Http\Controllers\Controller;
use App\Models\Order;

class PaymentController extends Controller
{
    public function show(Order $order)
    {
        $order->load(['items']);

        return view('ticket.payment', ['order' => $order]);
    }
}
