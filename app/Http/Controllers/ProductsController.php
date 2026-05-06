<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Str;

use App\Models\Product;
use App\Models\emergencyRequest;

class ProductsController extends Controller
{
    public function index()
    {
        $products = Product::orderBy('created_at', 'desc')->get();

        return view('products.index', compact('products'));
    }

    public function create()
    {
        return view('products.create');
    }

    public function store(Request $request)
    {
        // التحقق من صحة البيانات المدخلة
        $request->validate([
            'name' => 'required',
            'description' => 'required',
            'quantity' => 'required',
            'location' => 'required',
            'whatsapp' => ['required', 'regex:/^[0-9\s\-\+]+$/'],
            'image_path' => 'required|image|mimes:jpeg,png,jpg,gif|max:2048',
        ], [
            'whatsapp.regex' => 'يرجى إدخال رقم واتساب صالح .',
            'image_path.required' => 'يجب رفع صورة للكتاب.', // رسالة الخطأ الخاصة بالصورة
            'image_path.image' => 'الملف يجب أن يكون صورة.',
            'image_path.mimes' => 'الملف يجب أن يكون من نوع: jpeg, png, jpg, gif.',
            'image_path.max' => 'حجم الصورة يجب أن لا يتجاوز 2 ميجابايت.',
        ]);

        // إنشاء slug فريد
        $slug = Str::slug($request->name, '-') . '-' . uniqid();

        // معالجة الصورة فقط إذا تم رفعها
        if ($request->hasFile('image_path')) {
            $newImageName = uniqid() . '-' . $slug . '.' . $request->image_path->extension();
            $request->image_path->move(public_path('images'), $newImageName);
        }

        // إنشاء المنتج
        Product::create([
            'name' => $request->input('name'),
            'slug' => $slug,
            'category' => 'عام',
            'description' => $request->input('description'),
            'quantity' => $request->input('quantity'),
            'location' => $request->input('location'),
            'whatsapp' => $request->input('whatsapp'),
            'image_path' => $newImageName, // تأكد من أنه يجب رفع صورة
            'user_id' => auth()->user()->id
        ]);

        return redirect('/products')->with('message', 'تم إضافة الكتاب بنجاح!');
    }


    public function show($slug)
    {
        return view('products.show')->with('product', Product::where('slug', $slug)->first());
    }

    public function edit($slug)
    {
        return view('products.edit')->with('product', Product::where('slug', $slug)->first());
    }

    public function update(Request $request, $slug)
    {
        // جلب المنتج
        $product = Product::where('slug', $slug)->firstOrFail();

        // التحقق من صلاحيات المستخدم
        if (auth()->user()->id !== $product->user_id) {
            return redirect()->back()->with('error', 'ليس لديك صلاحية لتعديل هذا الكتاب');
        }

        // التحقق من صحة البيانات المدخلة
        $validated = $request->validate([
            'name' => 'required|string|max:255',
            'description' => 'required|string',
            'quantity' => 'required|integer|min:1',
            'location' => 'required|string|max:255',
            'whatsapp' => ['required', 'regex:/^[0-9\s\-\+]+$/'],
            'image_path' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048',
        ], [
            'whatsapp.regex' => 'يرجى إدخال رقم واتساب صالح .',
        ]);

        // الاحتفاظ باسم الصورة القديمة
        $newImageName = $product->image_path;

        // التحقق مما إذا كان هناك صورة جديدة مرفوعة
        if ($request->hasFile('image_path')) {
            // حذف الصورة القديمة إذا وجدت
            if ($product->image_path) {
                $oldImagePath = public_path('images/' . $product->image_path);
                if (file_exists($oldImagePath)) {
                    unlink($oldImagePath);
                }
            }

            // رفع الصورة الجديدة
            $newImageName = uniqid() . '-' . Str::slug($request->name, '-') . '.' . $request->image_path->extension();
            $request->image_path->move(public_path('images'), $newImageName);
        }

        // تحديث بيانات المنتج
        $updated = $product->update([
            'name' => $request->input('name'),
            'slug' => Str::slug($request->input('name'), '-'),
            'category' => $product->category,
            'description' => $request->input('description'),
            'quantity' => $request->input('quantity'),
            'location' => $request->input('location'),
            'whatsapp' => $request->input('whatsapp'),
            'image_path' => $newImageName,
        ]);

        if (!$updated) {
            return redirect()->back()->with('error', 'حدث خطأ أثناء تحديث الكتاب');
        }

        return redirect()->route('products.show', $product->slug)->with('message', 'تم تعديل الكتاب بنجاح');
    }

    public function destroy($slug)
    {
        Product::where('slug', $slug)->delete();
        return redirect('/products')->with('message', 'تم حذف الكتاب');
    }

    public function showUserData()
    {
        $user = auth()->user(); // الحصول على المستخدم الحالي
        $products = $user->products; // جلب المنتجات الخاصة بالمستخدم
        $emergencyRequests = $user->emergencyRequests; // جلب الطلبات الطارئة الخاصة بالمستخدم

        return view('user.myProducts', compact('products', 'emergencyRequests'));
    }
}
