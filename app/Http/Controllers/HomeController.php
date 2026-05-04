<?php

namespace App\Http\Controllers;

use App\Models\Product;
use App\Models\User;
use Illuminate\View\View;

class HomeController extends Controller
{
    public function index(): View
    {
        // Ambil 6 produk terbaru untuk featured
        $featured = Product::latest()->take(6)->get();

        // Hitung total untuk stats
        $totalIem = Product::count();
        $totalUser = User::where('role', 'user')->count();

        return view('home', compact('featured', 'totalIem', 'totalUser'));
    }
}