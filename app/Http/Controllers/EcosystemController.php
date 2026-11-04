<?php

namespace App\Http\Controllers;

use App\Models\User;
use App\Models\Product;
use App\Models\emergencyRequest;
use App\Models\RoleApplication;
use App\Models\CommunityPost;
use App\Models\ContentRequest;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;

class EcosystemController extends Controller
{
    /**
     * صفحة أدواري وصلاحياتي (SSO-07)
     */
    public function roles()
    {
        $user = Auth::user();
        $applications = $user ? $user->roleApplications()->latest()->get() : collect();

        return view('account.roles', compact('user', 'applications'));
    }

    /**
     * صفحة إعدادات الحساب والأمان (SSO-06)
     */
    public function security()
    {
        $user = Auth::user();
        return view('account.security', compact('user'));
    }

    /**
     * تحديث كلمة المرور وإعدادات الأمان (SSO-06)
     */
    public function updateSecurity(Request $request)
    {
        $request->validate([
            'current_password' => 'required',
            'new_password' => 'required|min:8|confirmed',
        ], [
            'current_password.required' => 'يرجى إدخال كلمة المرور الحالية',
            'new_password.required' => 'يرجى إدخال كلمة المرور الجديدة',
            'new_password.min' => 'يجب أن لا تقل كلمة المرور عن 8 خانات',
            'new_password.confirmed' => 'تأكيد كلمة المرور غير متطابق',
        ]);

        $user = Auth::user();

        if (!Hash::check($request->current_password, $user->password)) {
            return back()->withErrors(['current_password' => 'كلمة المرور الحالية غير صحيحة']);
        }

        $user->password = Hash::make($request->new_password);
        $user->save();

        return back()->with('success', 'تم تحديث كلمة المرور وإعدادات الأمان بنجاح');
    }

    /**
     * نموذج تقديم طلب دور معلم أو مؤلف (SSO-08)
     */
    public function applyRole()
    {
        $user = Auth::user();
        return view('account.apply', compact('user'));
    }

    /**
     * حفظ طلب الدور (SSO-08)
     */
    public function storeRoleApplication(Request $request)
    {
        $request->validate([
            'role_requested' => 'required|in:author,teacher',
            'experience' => 'required|string|min:20',
            'bio' => 'nullable|string',
        ], [
            'experience.required' => 'يرجى توضيح مؤهلاتك وخبرتك السابقة في المجال',
            'experience.min' => 'يرجى كتابة نبذة تفصيلية لا تقل عن 20 حرفاً',
        ]);

        $user = Auth::user();

        // Check if there is an existing pending application for the same role
        $existing = RoleApplication::where('user_id', $user->id)
            ->where('role_requested', $request->role_requested)
            ->where('status', 'pending')
            ->first();

        if ($existing) {
            return back()->with('error', 'لديك طلب قيد المراجعة بالفعل لهذا الدور');
        }

        RoleApplication::create([
            'user_id' => $user->id,
            'role_requested' => $request->role_requested,
            'experience' => $request->experience,
            'bio' => $request->bio,
            'status' => 'pending',
        ]);

        return redirect()->route('account.applications')->with('success', 'تم إرسال طلبك للإدارة بنجاح وهو الآن قيد المراجعة');
    }

    /**
     * صفحة متابعة حالة طلبات الأدوار (SSO-09)
     */
    public function applications()
    {
        $user = Auth::user();
        $applications = $user->roleApplications()->latest()->get();

        return view('account.applications', compact('user', 'applications'));
    }

    /**
     * لوحة تحكم المؤلف (Author Workspace)
     */
    public function authorWorkspace()
    {
        $user = Auth::user();
        $myBooks = $user->products()->latest()->get();
        $totalDownloads = $myBooks->count() * 42; // KPI محاكاة إحصائيات القراءة والتفاعل

        return view('workspaces.author', compact('user', 'myBooks', 'totalDownloads'));
    }

    /**
     * لوحة الإشراف والمراجعة (Moderation Workspace)
     */
    public function moderationWorkspace()
    {
        $user = Auth::user();
        $pendingProducts = Product::latest()->limit(8)->get();
        $urgentAppeals = emergencyRequest::latest()->limit(5)->get();

        return view('workspaces.moderation', compact('user', 'pendingProducts', 'urgentAppeals'));
    }

    /**
     * لوحة إدارة المنظومة (Admin Workspace)
     */
    public function adminWorkspace()
    {
        $user = Auth::user();
        $usersCount = User::count();
        $booksCount = Product::count();
        $urgentCount = emergencyRequest::count();
        $applications = RoleApplication::with('user')->latest()->get();
        $recentUsers = User::latest()->limit(6)->get();

        return view('workspaces.admin', compact('user', 'usersCount', 'booksCount', 'urgentCount', 'applications', 'recentUsers'));
    }

    /**
     * الموافقة أو رفض طلب الدور من لوحة الإدارة
     */
    public function handleApplicationDecision(Request $request, $id)
    {
        $application = RoleApplication::findOrFail($id);
        $decision = $request->input('decision'); // approved, rejected

        if ($decision === 'approved') {
            $application->status = 'approved';
            $targetUser = $application->user;
            if ($application->role_requested === 'author') {
                $targetUser->is_author = true;
            } elseif ($application->role_requested === 'teacher') {
                $targetUser->is_teacher = true;
            }
            $targetUser->save();
        } else {
            $application->status = 'rejected';
        }

        $application->admin_notes = $request->input('admin_notes', 'تم اتخاذ القرار من إدارة المنظومة');
        $application->save();

        return back()->with('success', 'تم تحديث حالة الطلب بنجاح');
    }

    /**
     * مجتمع القراء والمناقشات التعليمية (Community)
     */
    public function community()
    {
        $posts = CommunityPost::with('user')->latest()->get();
        return view('community.index', compact('posts'));
    }

    /**
     * نشر فكرة أو مراجعة في مجتمع القراء
     */
    public function storeCommunityPost(Request $request)
    {
        $request->validate([
            'title' => 'required|string|max:200',
            'content' => 'required|string|min:10',
            'category' => 'nullable|string',
        ]);

        CommunityPost::create([
            'user_id' => Auth::id(),
            'title' => $request->title,
            'content' => $request->content,
            'category' => $request->category ?? 'مناقشات عامة',
            'likes_count' => 0,
        ]);

        return back()->with('success', 'تم نشر مشاركتك في مجتمع القراء بنجاح');
    }

    /**
     * طلبات الكتب والمحتوى غير المتوفر (Content Requests)
     */
    public function contentRequests()
    {
        $requests = ContentRequest::with('user')->latest()->get();
        return view('requests.index', compact('requests'));
    }

    /**
     * حفظ طلب كتاب غير متوفر
     */
    public function storeContentRequest(Request $request)
    {
        $request->validate([
            'title' => 'required|string|max:200',
            'description' => 'required|string|min:10',
            'type' => 'nullable|string',
        ]);

        ContentRequest::create([
            'user_id' => Auth::id(),
            'title' => $request->title,
            'description' => $request->description,
            'type' => $request->type ?? 'كتاب',
            'votes_count' => 1,
            'status' => 'open',
        ]);

        return back()->with('success', 'تم إدراج طلب الكتاب وسيبدأ المجتمع والإدارة في توفيره');
    }

    /**
     * التصويت لكتاب مطلوب
     */
    public function voteContentRequest($id)
    {
        $req = ContentRequest::findOrFail($id);
        $req->increment('votes_count');

        return back()->with('success', 'تم تسجيل صوتك لدعم توفير هذا الكتاب');
    }
}
