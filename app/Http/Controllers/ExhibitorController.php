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

        return view('exhibitors.index', [
            'exhibitors' => $exhibitors,
            'sortBy' => $sortBy,
            'search' => $request->search,
        ]);
    }
}
