<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\Auth;
use App\Models\Product;
use App\Models\emergencyRequest;

class PagesController extends Controller
{
    /**
     * صفحة الترحيب للزوار: هيرو فقط (بدون سلايدر).
     * إذا كان المستخدم مسجّلًا، يُوجَّه لصفحة المنصة الكاملة.
     */
    public function index()
    {
        try {
            $latestProducts = Product::query()->orderBy('created_at', 'desc')->limit(4)->get();
            $latestRequests = emergencyRequest::query()->orderBy('created_at', 'desc')->limit(4)->get();
        } catch (\Throwable $e) {
            $latestProducts = collect();
            $latestRequests = collect();
        }

        return view('homePage', compact('latestProducts', 'latestRequests'));
    }

    /**
     * الصفحة الرئيسية بعد تسجيل الدخول: عن المنصة، البحث، الموارد، النداءات، الأسئلة…
     */
    public function homepage()
    {
        try {
            $latestProducts = Product::query()->orderBy('created_at', 'desc')->limit(3)->get();
            $latestRequests = emergencyRequest::query()->orderBy('created_at', 'desc')->limit(3)->get();
        } catch (\Throwable $e) {
            $latestProducts = collect();
            $latestRequests = collect();
        }

        return view('homePage', compact('latestProducts', 'latestRequests'));
    }
}
