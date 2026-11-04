<?php

namespace App\Http\Controllers;

use App\Models\Product;
use Illuminate\Http\Request;

class FavoritesController extends Controller
{
    public function store($id)
    {
        $product = Product::findOrFail($id);
        $user = auth()->user();

        if ($user->favorites()->where('product_id', $id)->exists()) {
            return back()->with('error', 'الكتاب موجود في المفضلة بالفعل');
        }

        $user->favorites()->attach($id);

        return back()->with('message', 'تم إضافة الكتاب إلى المفضلات');
    }

    public function destroy($id)
    {
        $user = auth()->user();
        $user->favorites()->detach($id);

        return back()->with('message', 'تم حذف الكتاب من المفضلات');
    }

    public function index()
    {
        $user = auth()->user();
        $favorites = $user->favorites()->get();

        return view('user.myFavorites', compact('favorites'));
    }
}