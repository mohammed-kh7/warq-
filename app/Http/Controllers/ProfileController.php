<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\User;
use Illuminate\Support\Facades\Hash;

class ProfileController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        //
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     */
    public function show()
    {
        $user = Auth::user();  // استرجاع بيانات المستخدم
        return view('profile.show', compact('user'));  // تمرير بيانات المستخدم إلى الـ view
    }



    /**
     * Show the form for editing the specified resource.
     */
    public function edit()
    {
        return view('profile.edit', ['user' => Auth::user()]);  // تمرير بيانات المستخدم إلى الصفحة
    }


    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, $id)
    {
        $user = User::findOrFail($id);

        // التحقق من البيانات المدخلة
        $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|string|email|max:255|unique:users,email,' . $user->id,
            'phone' => 'nullable|string|max:15',
            'location' => 'nullable|string|max:255',
            'image' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048',
            'current_password' => 'nullable|string',
            'new_password' => 'nullable|string|min:8|confirmed', // لا تجعلها `required_with`
        ]);

        // تحديث البيانات الأساسية
        $user->name = $request->name;
        $user->email = $request->email;
        $user->phone = $request->phone;
        $user->location = $request->location;

        // تحديث كلمة المرور إذا تم إدخالها
        if ($request->filled('new_password')) {
            if (!$request->filled('current_password')) {
                return back()->withErrors(['current_password' => 'يجب إدخال كلمة المرور الحالية لتحديث كلمة المرور.']);
            }

            if (!Hash::check($request->current_password, $user->password)) {
                return back()->withErrors(['current_password' => ' كلمة المرور التي ادخلتها غير صحيحة، تأكد أنك أدخلتها بشكل صحيح']);
            }

            // تحديث كلمة المرور بعد التحقق
            $user->password = Hash::make($request->new_password);
        }

        // تحديث الصورة الشخصية إذا وُجدت
        if ($request->hasFile('image')) {
            // حذف الصورة القديمة إذا كانت موجودة
            if (!empty($user->image) && file_exists(public_path('images/' . $user->image))) {
                unlink(public_path('images/' . $user->image));
            }

            // رفع الصورة الجديدة
            $imageName = time() . '.' . $request->image->extension();
            $request->image->move(public_path('images'), $imageName);

            // تحديث اسم الصورة في قاعدة البيانات
            $user->image = $imageName;
        }

        // حفظ جميع التغييرات
        $user->save();

        return redirect()->route('profile.show')->with('success', 'تم تحديث بروفايلك بنجاح!');
    }



    public function destroy(string $id)
    {
        //
    }
}
