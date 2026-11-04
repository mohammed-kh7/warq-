<?php

namespace App\Http\Controllers;

use App\Models\UserBook;
use App\Models\Product;
use Illuminate\Http\Request;
use Illuminate\Support\Str;

class MyLibraryController extends Controller
{
    public function index()
    {
        $user = auth()->user();

        $userBooks = UserBook::with('book')
            ->where('user_id', $user->id)
            ->orderBy('created_at', 'desc')
            ->get();

        $books = $userBooks->map(function ($item) {
            return (object) [
                'id' => $item->book->id,
                'slug' => Str::slug($item->book->name) . '-' . $item->book->id,
                'name' => $item->book->name,
                'description' => $item->book->description,
                'image_path' => $item->book->image_path,
                'status' => $item->status ?? 'completed',
                'progress' => $item->progress ?? 0,
                'bookmarks' => $item->bookmarks ?? [],
            ];
        });

        $favorites = $user->favorites()->get();

        return view('user.myLibrary', compact('userBooks', 'books', 'favorites'));
    }

    public function addToLibrary($productId, Request $request)
    {
        $user = auth()->user();
        $product = Product::findOrFail($productId);

        UserBook::firstOrCreate(
            ['user_id' => $user->id, 'book_id' => $product->id],
            ['status' => 'completed', 'slug' => Str::slug($user->id . '-' . $product->id)]
        );

        return back()->with('message', 'تم إضافة الكتاب إلى مكتبتك بنجاح!');
    }

    public function markAsReading($id)
    {
        $userBook = UserBook::where('user_id', auth()->id())
            ->where('book_id', $id)
            ->firstOrFail();

        $userBook->update(['status' => 'reading', 'progress' => 0]);

        return back()->with('message', 'تم تحديد الكتاب كقيد القراءة');
    }

    public function updateProgress(Request $request, $id)
    {
        $userBook = UserBook::where('user_id', auth()->id())
            ->where('book_id', $id)
            ->firstOrFail();

        $progress = $request->input('progress', 0);
        $status = $progress >= 100 ? 'completed' : 'reading';

        $userBook->update([
            'progress' => $progress,
            'status' => $status,
        ]);

        return back()->with('message', 'تم تحديث التقدم');
    }

    public function addBookmark(Request $request, $id)
    {
        $userBook = UserBook::where('user_id', auth()->id())
            ->where('book_id', $id)
            ->firstOrFail();

        $bookmarks = $userBook->bookmarks ?? [];
        $bookmarks[] = [
            'page' => $request->input('page'),
            'label' => $request->input('label'),
            'created_at' => now(),
        ];

        $userBook->update(['bookmarks' => $bookmarks]);

        return back()->with('message', 'تم إضافة الإشارة المرجعية');
    }
}