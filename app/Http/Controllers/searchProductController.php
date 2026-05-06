<?php

namespace App\Http\Controllers;

use App\Models\Product;
use App\Models\emergencyRequest;

use Illuminate\Http\Request;

class searchProductController extends Controller
{
    public function index(Request $request)
    {

        $searchElement = explode(' ', $request->input('search'));

        // البحث عن المنتجات
        $productQuery = Product::query();

        if ($request->has('search')) {
            $productQuery->where(function ($query) use ($searchElement) {
                foreach ($searchElement as $element) {
                    $query->orWhere('name', 'like', '%' . $element . '%')
                        ->orWhere('description', 'like', '%' . $element . '%');
                }
            });
        }

        $products = $productQuery->get();

        // البحث عن الطلبات الطارئة
        $emergencyQuery = emergencyRequest::query();

        if ($request->has('search')) {
            $emergencyQuery->where(function ($query) use ($searchElement) {
                foreach ($searchElement as $element) {
                    $query->orWhere('type', 'like', '%' . $element . '%')
                        ->orWhere('description', 'like', '%' . $element . '%')
                        ->orWhere('location', 'like', '%' . $element . '%');
                }
            });
        }

        $emergencyRequest = $emergencyQuery->get();

        return view('searchProducts.index', compact('products', 'emergencyRequest'));
    }
}
