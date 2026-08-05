<?php

namespace App\Http\Controllers\Ticket;

use App\Http\Controllers\Controller;
use App\Models\TicketType;

class LandingController extends Controller
{
    public function __invoke()
    {
        $ticketTypes = TicketType::active()->get();

        return view('ticket.landing', [
            'ticketTypes' => $ticketTypes,
        ]);
    }
}
