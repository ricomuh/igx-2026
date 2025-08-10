<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class ExhibitorController extends Controller
{
    public function __invoke(Request $request)
    {
        $sortBy = $request->sort_by ?? 'latest';

        $exhibitors = \App\Models\Exhibitor::query()
            ->when($request->search, function ($query) use ($request) {
                $query->where('name', 'like', '%' . $request->search . '%');
            })
            ->when($sortBy, function ($query) use ($sortBy) {
                return match ($sortBy) {
                    'latest' => $query->latest(),
                    'oldest' => $query->oldest(),
                    'name_asc' => $query->orderBy('name', 'asc'),
                    'name_desc' => $query->orderBy('name', 'desc'),
                    default => $query,
                };
            })
            ->paginate(9)
            ->withQueryString();
        // ->get();

        return view('exhibitors.index', [
            'exhibitors' => $exhibitors,
            'sortBy' => $sortBy,
            'search' => $request->search,
        ]);
    }
}
