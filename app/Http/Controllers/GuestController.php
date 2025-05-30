<?php

namespace App\Http\Controllers;

use App\Models\Guest;
use Illuminate\Http\Request;

class GuestController extends Controller
{
    public function __invoke(Request $request)
    {
        $sortBy = $request->sort_by ?? 'latest';

        $guests = Guest::query()
            ->when($request->search, function ($query) use ($request) {
                $query->where('name', 'like', '%' . $request->search . '%');
            })
            ->when($sortBy, function ($query) use ($sortBy) {
                return match($sortBy) {
                    'latest' => $query->latest(),
                    'oldest' => $query->oldest(),
                    'name_asc' => $query->orderBy('name', 'asc'),
                    'name_desc' => $query->orderBy('name', 'desc'),
                    default => $query,
                };
            })
            ->paginate(9)
            ->withQueryString();
        return view('guests.index', compact('guests', 'sortBy'));
    }

}
