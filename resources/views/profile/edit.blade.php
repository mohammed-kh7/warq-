@extends('layouts.app')
@section('title', 'تعديل الملف الشخصي')

@section('content')
<div class="profile-edit-page">
    <div class="container px-3 py-4">
        <header class="profile-edit-page__hero text-center">
            <p class="profile-edit-page__eyebrow"><i class="fas fa-user-pen ms-1" aria-hidden="true"></i> تحديث البيانات</p>
            <h1 class="profile-edit-page__title">تعديل الملف الشخصي</h1>
        </header>

        <div class="profile-edit-page__layout">
            <aside class="profile-edit-page__aside">
                <div class="profile-edit-page__avatar-ring">
                    <img src="{{ asset('images/' . (Auth::user()->image ?? 'personalPictur.jpg')) }}" alt="" class="profile-edit-page__avatar-preview">
                </div>
            </aside>

            <div class="profile-edit-page__form-wrap">
                <form action="{{ route('profile.update', Auth::user()->id) }}" method="POST" enctype="multipart/form-data" class="profile-edit-page__form">
                    @csrf
                    @method('PUT')

                    <div class="profile-edit-field">
                        <label for="fullName" class="profile-edit-field__label"><i class="fas fa-user" aria-hidden="true"></i> الاسم الكامل</label>
                        <input type="text" name="name" class="form-control profile-edit-field__input" id="fullName" value="{{ old('name', $user->name) }}" placeholder="الاسم كما يظهر في المنصة" required>
                    </div>

                    <div class="profile-edit-field">
                        <label for="email" class="profile-edit-field__label"><i class="fas fa-envelope" aria-hidden="true"></i> البريد الإلكتروني</label>
                        <input type="email" name="email" class="form-control profile-edit-field__input" id="email" value="{{ old('email', $user->email) }}" placeholder="you@example.com" required>
                    </div>

                    <div class="profile-edit-field">
                        <label for="phone" class="profile-edit-field__label"><i class="fas fa-phone-alt" aria-hidden="true"></i> رقم الجوال</label>
                        <input type="text" name="phone" class="form-control profile-edit-field__input" id="phone" value="{{ old('phone', $user->phone) }}" placeholder="رقم التواصل">
                    </div>

                    <div class="profile-edit-field">
                        <label for="location" class="profile-edit-field__label"><i class="fas fa-map-marker-alt" aria-hidden="true"></i> الموقع الجغرافي</label>
                        <input type="text" name="location" class="form-control profile-edit-field__input" id="location" value="{{ old('location', $user->location) }}" placeholder="المنطقة أو المدينة">
                    </div>

                    <div class="profile-edit-field">
                        <label for="current_password" class="profile-edit-field__label"><i class="fas fa-key" aria-hidden="true"></i> كلمة المرور الحالية</label>
                        <input type="password" name="current_password" class="form-control profile-edit-field__input" id="current_password" placeholder="إن أردت تغيير كلمة المرور">
                    </div>
                    @if ($errors->has('current_password'))
                    <div class="alert alert-danger py-2 small">{{ $errors->first('current_password') }}</div>
                    @endif

                    <div class="profile-edit-field">
                        <label for="newPassword" class="profile-edit-field__label"><i class="fas fa-lock" aria-hidden="true"></i> كلمة المرور الجديدة</label>
                        <input type="password" name="new_password" class="form-control profile-edit-field__input" id="newPassword" placeholder="كلمة مرور قوية">
                    </div>

                    <div class="profile-edit-field">
                        <label for="confirmPassword" class="profile-edit-field__label"><i class="fas fa-lock" aria-hidden="true"></i> تأكيد كلمة المرور</label>
                        <input type="password" name="new_password_confirmation" class="form-control profile-edit-field__input" id="confirmPassword" placeholder="تكرار كلمة المرور الجديدة">
                    </div>
                    @if ($errors->has('new_password'))
                    <div class="alert alert-danger py-2 small">{{ $errors->first('new_password') }}</div>
                    @endif

                    <div class="profile-edit-field">
                        <label for="profilePicture" class="profile-edit-field__label"><i class="fas fa-camera" aria-hidden="true"></i> صورة شخصية</label>
                        <input type="file" name="image" class="form-control profile-edit-field__input" id="profilePicture" accept="image/*">
                    </div>

                    <div class="profile-edit-page__actions">
                        <button type="submit" class="btn profile-edit-page__submit">
                            <i class="fas fa-save" aria-hidden="true"></i> حفظ التغييرات
                        </button>
                        <a href="{{ route('profile.show') }}" class="btn profile-edit-page__cancel">إلغاء</a>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>
@endsection
