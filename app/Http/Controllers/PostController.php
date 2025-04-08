<?php

namespace App\Http\Controllers;

use App\Models\Post;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class PostController extends Controller
{
    public function index(Request $request)
    {
        $latest_posts = Post::query()
            ->when(function ($query) use ($request) {
                if ($request->has('search')) {
                    $query->where('title', 'like', '%' . $request->input('search') . '%');
                }
            })
            ->latest()
            ->paginate(10);

        // get popular posts by views over the last 7 days, if the post amount doesn't get into 5, then get it over the last 30 days, if it still doesn't get into 5, then get it over the last 90 days, if it still doesn't get into 5, then get it over the last year, if it still doesn't get into 5, then get it all time by views, the 'views' is another model that contains the views of the post, and it's increased in only one data in one day, if it's new day, then it create new data with the current date and the views of the post, if it's not new day, then it just increase the views of the current date, so we can get the views of the post by date, and we can get the popular posts by views over a period of time.

        $days = [7, 30, 90, 365];
        $popular_posts = collect();

        foreach ($days as $day) {
            $posts = Post::with('views')
                ->whereHas('views', function ($query) use ($day) {
                    $query->whereBetween('date', now()->subDays($day), now());
                })
                ->orderByDesc('views.views')
                ->take(5)
                ->get();

            if ($posts->count() >= 5) {
                $popular_posts = $posts;
                break;
            }
        }
        if ($popular_posts->count() < 5) {
            $popular_posts = Post::with('views')
                ->orderByDesc('views.views')
                ->take(5)
                ->get();
        }

        return view('posts.index', [
            'latest_posts' => $latest_posts,
            'popular_posts' => $popular_posts,
        ]);
    }

    public function show(Post $post)
    {
        $post->load('views');
        $post->views()->updateOrCreate(
            ['date' => now()->format('Y-m-d')],
            ['views' => DB::raw('views + 1')]
        );

        return view('posts.show', [
            'post' => $post,
        ]);
    }
}
