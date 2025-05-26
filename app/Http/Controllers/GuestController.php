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
                if ($sortBy === 'latest') {
                    $query->latest();
                } elseif ($sortBy === 'oldest') {
                    $query->oldest();
                } elseif ($sortBy === 'name_asc') {
                    $query->orderBy('name', 'asc');
                } elseif ($sortBy === 'name_desc') {
                    $query->orderBy('name', 'desc');
                }
            })
            ->paginate(10)
            ->withQueryString();

        return view('guests.index', [
            'guests' => $guests,
            'sortBy' => $sortBy,
            'search' => $request->search,
        ]);
    }
}
