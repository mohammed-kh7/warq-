@extends('layouts.app')

@section('title', 'تعديل الملف الشخصي — ' . config('app.name'))

@section('content')
<div class="form-shell-page position-relative">
    <!-- Ambient Glows & Grid -->
    <div class="glow glow--one" aria-hidden="true"></div>
    <div class="glow glow--two" aria-hidden="true"></div>
    <div class="grid-bg" aria-hidden="true"></div>

    <div class="container-ofuq position-relative py-5" style="z-index: 5;">
        <!-- Header -->
        <div class="form-header text-center mb-5">
            <div class="platform-pill mx-auto mb-3">
                <i class="fas fa-user-edit text-lavender"></i>
                <span>تحديث البيانات الشخصية</span>
            </div>
            <h1 class="form-title">
                تعديل <span class="gradient-text">الملف الشخصي</span>
            </h1>
            <p class="form-subtitle">
                حدّث بياناتك الشخصية، رقم التواصل، أو قم بتغيير كلمة المرور الخاصة بحسابك.
            </p>
        </div>

        <div class="row justify-content-center">
            <div class="col-lg-8">
                <div class="glass-form-card">
                    <form action="{{ route('profile.update', Auth::user()->id) }}" method="POST" enctype="multipart/form-data">
                        @csrf
                        @method('PUT')

                        <!-- Basic Info Heading -->
                        <h4 class="text-white fw-bold mb-4 fs-6">
                            <i class="fas fa-id-badge text-lavender me-2"></i> البيانات العامة
                        </h4>

                        <!-- Name -->
                        <div class="form-group-custom">
                            <label for="fullName" class="form-label-custom">الاسم الكامل</label>
                            <div class="input-with-icon-wrap">
                                <i class="fas fa-user input-icon-inner"></i>
                                <input
                                    type="text"
                                    name="name"
                                    id="fullName"
                                    class="form-input-custom @error('name') is-invalid @enderror"
                                    value="{{ old('name', $user->name) }}"
                                    placeholder="اكتب اسمك الكامل"
                                    required
                                >
                            </div>
                            @error('name')
                                <div class="error-msg-custom">{{ $message }}</div>
                            @enderror
                        </div>

                        <!-- Email & Phone Row -->
                        <div class="row g-3">
                            <div class="col-md-6">
                                <div class="form-group-custom">
                                    <label for="email" class="form-label-custom">البريد الإلكتروني</label>
                                    <div class="input-with-icon-wrap">
                                        <i class="fas fa-envelope input-icon-inner"></i>
                                        <input
                                            type="email"
                                            name="email"
                                            id="email"
                                            class="form-input-custom @error('email') is-invalid @enderror"
                                            value="{{ old('email', $user->email) }}"
                                            placeholder="name@example.com"
                                            required
                                        >
                                    </div>
                                    @error('email')
                                        <div class="error-msg-custom">{{ $message }}</div>
                                    @enderror
                                </div>
                            </div>

                            <div class="col-md-6">
                                <div class="form-group-custom">
                                    <label for="phone" class="form-label-custom">رقم الجوال للتواصل</label>
                                    <div class="input-with-icon-wrap">
                                        <i class="fas fa-phone-alt input-icon-inner"></i>
                                        <input
                                            type="text"
                                            name="phone"
                                            id="phone"
                                            class="form-input-custom @error('phone') is-invalid @enderror"
                                            value="{{ old('phone', $user->phone) }}"
                                            placeholder="059xxxxxxx"
                                        >
                                    </div>
                                    @error('phone')
                                        <div class="error-msg-custom">{{ $message }}</div>
                                    @enderror
                                </div>
                            </div>
                        </div>

                        <!-- Location -->
                        <div class="form-group-custom">
                            <label for="location" class="form-label-custom">الموقع أو المدينة</label>
                            <div class="input-with-icon-wrap">
                                <i class="fas fa-map-marker-alt input-icon-inner"></i>
                                <input
                                    type="text"
                                    name="location"
                                    id="location"
                                    class="form-input-custom @error('location') is-invalid @enderror"
                                    value="{{ old('location', $user->location) }}"
                                    placeholder="مثال: غزة، الرمال"
                                >
                            </div>
                            @error('location')
                                <div class="error-msg-custom">{{ $message }}</div>
                            @enderror
                        </div>

                        <!-- Avatar Upload -->
                        <div class="form-group-custom">
                            <label class="form-label-custom">الصورة الشخصية</label>
                            <div class="d-flex align-items-center gap-3 mb-3">
                                <img
                                    src="{{ asset('images/' . (Auth::user()->image ?? 'personalPictur.jpg')) }}"
                                    alt="{{ Auth::user()->name }}"
                                    style="width: 55px; height: 55px; object-fit: cover; border-radius: 50%; border: 2px solid var(--border-hover);"
                                >
                                <input type="file" name="image" id="profilePicture" class="form-input-custom" accept="image/*">
                            </div>
                            @error('image')
                                <div class="error-msg-custom">{{ $message }}</div>
                            @enderror
                        </div>

                        <hr class="my-4" style="border-color: var(--border);">

                        <!-- Security & Password -->
                        <h4 class="text-white fw-bold mb-3 fs-6">
                            <i class="fas fa-lock text-lavender me-2"></i> تغيير كلمة المرور (اختياري)
                        </h4>
                        <p class="text-muted small mb-4">اترك الحقول أدناه فارغة إذا كنت لا ترغب في تغيير كلمة مرورك الحالية.</p>

                        <div class="form-group-custom">
                            <label for="current_password" class="form-label-custom">كلمة المرور الحالية</label>
                            <div class="input-with-icon-wrap">
                                <i class="fas fa-key input-icon-inner"></i>
                                <input
                                    type="password"
                                    name="current_password"
                                    id="current_password"
                                    class="form-input-custom @error('current_password') is-invalid @enderror"
                                    placeholder="أدخل كلمة المرور الحالية للتحقق"
                                >
                            </div>
                            @error('current_password')
                                <div class="error-msg-custom">{{ $message }}</div>
                            @enderror
                        </div>

                        <div class="row g-3">
                            <div class="col-md-6">
                                <div class="form-group-custom">
                                    <label for="newPassword" class="form-label-custom">كلمة المرور الجديدة</label>
                                    <div class="input-with-icon-wrap">
                                        <i class="fas fa-lock input-icon-inner"></i>
                                        <input
                                            type="password"
                                            name="new_password"
                                            id="newPassword"
                                            class="form-input-custom @error('new_password') is-invalid @enderror"
                                            placeholder="٨ خانات على الأقل"
                                        >
                                    </div>
                                    @error('new_password')
                                        <div class="error-msg-custom">{{ $message }}</div>
                                    @enderror
                                </div>
                            </div>

                            <div class="col-md-6">
                                <div class="form-group-custom">
                                    <label for="confirmPassword" class="form-label-custom">تأكيد كلمة المرور</label>
                                    <div class="input-with-icon-wrap">
                                        <i class="fas fa-lock input-icon-inner"></i>
                                        <input
                                            type="password"
                                            name="new_password_confirmation"
                                            id="confirmPassword"
                                            class="form-input-custom"
                                            placeholder="أعد كتابة كلمة المرور"
                                        >
                                    </div>
                                </div>
                            </div>
                        </div>

                        <!-- Actions -->
                        <div class="d-flex flex-wrap gap-3 mt-4">
                            <button type="submit" class="button button--primary flex-grow-1 justify-content-center">
                                <i class="fas fa-save"></i>
                                <span>حفظ التعديلات</span>
                            </button>
                            <a href="{{ route('profile.show') }}" class="button button--secondary">
                                <span>إلغاء</span>
                            </a>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
