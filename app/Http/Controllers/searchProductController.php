<?php

namespace App\Http\Controllers;

use App\Models\Product;
use App\Models\emergencyRequest;
use Illuminate\Http\Request;

class searchProductController extends Controller
{
    public function index(Request $request)
    {
        $search = trim($request->input('search', ''));
        $category = $request->input('category', 'الكل');
        $sort = $request->input('sort', 'latest');

        // Query for Books / Products
        $productQuery = Product::with('user');

        // Search filter
        if (!empty($search)) {
            $terms = array_filter(explode(' ', $search));
            $productQuery->where(function ($query) use ($terms) {
                foreach ($terms as $term) {
                    $query->orWhere('name', 'like', '%' . $term . '%')
                          ->orWhere('description', 'like', '%' . $term . '%')
                          ->orWhere('location', 'like', '%' . $term . '%');
                }
            });
        }

        // Category filter
        if ($category !== 'الكل' && !empty($category)) {
            $productQuery->where('category', $category);
        }

        // Sorting
        if ($sort === 'oldest') {
            $productQuery->orderBy('created_at', 'asc');
        } else {
            $productQuery->orderBy('created_at', 'desc');
        }

        $products = $productQuery->get();

        // Urgent requests query (only if searching or when specifically requested)
        $emergencyQuery = emergencyRequest::with('user');
        if (!empty($search)) {
            $terms = array_filter(explode(' ', $search));
            $emergencyQuery->where(function ($query) use ($terms) {
                foreach ($terms as $term) {
                    $query->orWhere('description', 'like', '%' . $term . '%')
                          ->orWhere('location', 'like', '%' . $term . '%');
                }
            });
            $emergencyRequest = $emergencyQuery->orderBy('created_at', 'desc')->get();
        } else {
            $emergencyRequest = collect();
        }

        // Predefined Categories matching Figma
        $categories = [
            'الكل' => 'الكل',
            'التقنية' => 'التقنية',
            'التنمية' => 'التنمية',
            'التصميم' => 'التصميم',
            'سلايدات جامعية' => 'سلايدات جامعية',
            'عام' => 'عام',
        ];

        return view('searchProducts.index', compact(
            'products',
            'emergencyRequest',
            'search',
            'category',
            'sort',
            'categories'
        ));
    }
}
