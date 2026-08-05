<?php

namespace App\Http\Controllers\Ticket;

use App\Http\Controllers\Controller;
use App\Models\Order;
use App\Models\OrderItem;
use App\Models\TicketType;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Str;

class CheckoutController extends Controller
{
    public function index(Request $request)
    {
        $ticketTypes = TicketType::active()->get();
        $selected = $request->query('type')
            ? $ticketTypes->firstWhere('slug', $request->query('type'))
            : null;

        return view('ticket.checkout', [
            'ticketTypes' => $ticketTypes,
            'selected' => $selected,
        ]);
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'customer_name' => ['required', 'string', 'max:255'],
            'customer_email' => ['required', 'email', 'max:255'],
            'customer_phone' => ['nullable', 'string', 'max:32'],
            'items' => ['required', 'array', 'min:1'],
            'items.*.ticket_type_id' => ['required', 'integer', 'exists:ticket_types,id'],
            'items.*.qty' => ['required', 'integer', 'min:1', 'max:10'],
        ]);

        $items = collect($validated['items']);

        // Resolve ticket types once, reject inactive/sold-out
        $types = TicketType::whereIn('id', $items->pluck('ticket_type_id'))->get()->keyBy('id');
        foreach ($items as $item) {
            $type = $types->get($item['ticket_type_id']);
            if (! $type || ! $type->is_active) {
                return back()->withErrors(['items.0.ticket_type_id' => 'Tiket tidak tersedia.'])->withInput();
            }
            if ($type->isSoldOut()) {
                return back()->withErrors(['items.0.ticket_type_id' => $type->name . ' sudah habis terjual.'])->withInput();
            }
        }

        $order = DB::transaction(function () use ($items, $types, $validated) {
            $order = Order::create([
                'order_number' => self::generateOrderNumber(),
                'customer_name' => $validated['customer_name'],
                'customer_email' => $validated['customer_email'],
                'customer_phone' => $validated['customer_phone'] ?? null,
                'total_amount' => 0,
                'status' => Order::STATUS_PENDING,
                'payment_method' => 'transfer',
            ]);

            $total = 0;
            foreach ($items as $item) {
                $type = $types->get($item['ticket_type_id']);
                $subtotal = $type->price * $item['qty'];
                $total += $subtotal;
                OrderItem::create([
                    'order_id' => $order->id,
                    'ticket_type_id' => $type->id,
                    'ticket_name' => $type->name,
                    'unit_price' => $type->price,
                    'qty' => $item['qty'],
                    'subtotal' => $subtotal,
                ]);
            }

            $order->update(['total_amount' => $total]);

            return $order;
        });

        return redirect()
            ->route('ticket.payment', $order->order_number)
            ->with('success', 'Order berhasil dibuat. Silakan selesaikan pembayaran.');
    }

    public static function generateOrderNumber(): string
    {
        do {
            $number = 'IGX-' . now()->format('Ymd') . '-' . strtoupper(Str::random(6));
        } while (Order::where('order_number', $number)->exists());

        return $number;
    }
}
