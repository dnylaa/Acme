<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Article;
use App\Models\Category;
use App\Models\Information;
use App\Models\User;
use App\Models\Order;
use App\Models\Product;
use App\Models\Testimonial;
use Illuminate\Support\Facades\Auth;

class DashboardController extends Controller
{
    public function index()
    {
        $articles = collect();
        $latestArticles = collect();
        $orders = collect();
        $products = collect();
        $testimonials = collect();

        if (Auth::check()) {
            $user = Auth::user();

            // 🟣 ADMIN
            if ($user->role === 'admin') {
                $articles = Article::where('status', true)->get();
                $latestArticles = Article::where('status', true)
                    ->latest()
                    ->limit(10)
                    ->get();
                $products = Product::all();
                $testimonials = Testimonial::all();
                $orders = Order::latest()->limit(10)->get();

            // 🟢 author
            } elseif ( $user->role === 'author') {
                $articles = Article::where('user_id', $user->id)
                    ->where('status', true)
                    ->get();

                $latestArticles = Article::where('user_id', $user->id)
                    ->where('status', true)
                    ->latest()
                    ->limit(10)
                    ->get();
                $products = Product::where('user_id', $user->id)->get();
                $testimonials = Testimonial::whereHas('product', function($q) use ($user) {
                    $q->where('user_id', $user->id);
                })->get();
                $orders = Order::latest()->limit(10)->get(); // author bisa lihat semua order

            // 🔵 USER
            } elseif ($user->role === 'user') {
                $orders = Order::where('user_id', $user->id)
                    ->latest()
                    ->get(); // User cuma bisa lihat order miliknya
            }
        }

        return view('admin.dashboard', [
            'articles'        => $articles,
            'categories'      => Category::all(),
            'users'           => User::all(),
            'information'     => Information::all(),
            'latest_articles' => $latestArticles,
            'orders'          => $orders,
        ]);
    }
}
