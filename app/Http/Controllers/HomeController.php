<?php

namespace App\Http\Controllers;

use App\Models\Product;
use App\Models\Category;
use App\Models\Deal;

class HomeController extends Controller
{
    public function index()
    {
        // Cache home data for 30 minutes — eager load only active products with selected columns
        $homeData = \Illuminate\Support\Facades\Cache::remember('home_page_data', 1800, function() {
            return [
                'categories' => Category::with(['products' => function($q) {
                    $q->where('is_active', true)
                      ->select('id', 'name', 'price', 'old_price', 'image', 'category_id')
                      ->latest()
                      ->take(8);
                }])->select('id', 'name', 'background_image')->get(),

                'recommended' => Product::where('is_active', true)
                    ->select('id', 'name', 'price', 'old_price', 'image', 'category_id')
                    ->latest()
                    ->take(10)
                    ->get(),
            ];
        });

        // Always check for all active deals fresh (outside cache)
        $activeDeals = Deal::where('is_active', true)
            ->where('end_date', '>', now())
            ->with(['product' => function($q) {
                $q->select('id', 'name', 'price', 'image');
            }])
            ->select('id', 'title', 'description', 'discount_percent', 'end_date', 'product_id', 'is_active')
            ->orderBy('end_date', 'asc')
            ->take(6)
            ->get();

        $activeDeal = $activeDeals->first();

        return view('pages.home', [
            'categories' => $homeData['categories'],
            'recommended' => $homeData['recommended'],
            'deals' => $activeDeals,
            'activeDeal' => $activeDeal
        ]);
    }
}
