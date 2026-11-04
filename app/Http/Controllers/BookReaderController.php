<?php

namespace App\Http\Controllers;

use App\Models\Product;
use App\Models\UserBook;
use Illuminate\Http\Request;
use Illuminate\Support\Str;

class BookReaderController extends Controller
{
    public function show($slug, Request $request)
    {
        $product = Product::where('slug', $slug)->orWhere('name', 'like', Str::slug($slug))->firstOrFail();
        $user = auth()->user();

        $userBook = null;
        if ($user) {
            $userBook = UserBook::where('user_id', $user->id)
                ->where('book_id', $product->id)
                ->first();

            if (!$userBook) {
                $userBook = UserBook::create([
                    'user_id' => $user->id,
                    'book_id' => $product->id,
                    'status' => 'reading',
                    'progress' => 0,
                    'slug' => Str::slug($user->id . '-' . $product->id . '-' . time()),
                ]);
            }

            $currentProgress = $userBook->progress ?? 0;
            $currentPage = $userBook->last_page ?? 1;
            $bookmarks = $userBook->bookmarks ?? [];
        } else {
            $currentProgress = 0;
            $currentPage = 1;
            $bookmarks = [];
        }

        return view('user.bookReader', compact('product', 'userBook', 'currentProgress', 'currentPage', 'bookmarks'));
    }

    public function updateProgress(Request $request, $slug)
    {
        $product = Product::where('slug', $slug)->firstOrFail();
        $user = auth()->user();

        if (!$user) {
            return response()->json(['error' => 'يجب تسجيل الدخول'], 401);
        }

        $userBook = UserBook::where('user_id', $user->id)
            ->where('book_id', $product->id)
            ->firstOrFail();

        $progress = $request->input('progress', 0);
        $page = $request->input('page', 1);

        $userBook->update([
            'progress' => $progress,
            'status' => $progress >= 100 ? 'completed' : 'reading',
            'last_page' => $page,
        ]);

        return response()->json(['success' => true, 'message' => 'تم تحديث التقدم']);
    }

    public function addBookmark(Request $request, $slug)
    {
        $product = Product::where('slug', $slug)->firstOrFail();
        $user = auth()->user();

        if (!$user) {
            return response()->json(['error' => 'يجب تسجيل الدخول'], 401);
        }

        $userBook = UserBook::where('user_id', $user->id)
            ->where('book_id', $product->id)
            ->firstOrFail();

        $bookmarks = $userBook->bookmarks ?? [];
        $bookmarks[] = [
            'page' => $request->input('page'),
            'label' => $request->input('label', 'إشارة مرجعية'),
            'created_at' => now(),
        ];

        $userBook->update(['bookmarks' => $bookmarks]);

        return response()->json(['success' => true, 'message' => 'تمت الإشارة المرجعية']);
    }
}