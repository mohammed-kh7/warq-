@extends('layouts.app')
@section('title', 'حسابي')

@section('content')
<div class="account-page main-content">
    <div class="container px-3 py-4">
        <header class="account__hero text-center">
            <p class="account__eyebrow"><i class="fas fa-user-circle me-2" aria-hidden="true"></i> حسابي</p>
            <h1 class="account__title">تفاصيل الحساب</h1>
        </header>

        <div class="row g-4 mb-4">
            <div class="col-lg-4">
                <div class="card">
                    <div class="card-body text-center">
                        <div class="avatar mb-3">
                            @if(auth()->user()->profile_picture)
                            <img src="{{ asset('storage/' . auth()->user()->profile_picture) }}" class="rounded-circle avatar-img" alt="الصورة الشخصية">
                            @else
                            <div class="avatar-placeholder rounded-circle mx-auto mb-2">
                                <i class="fas fa-user fa-2x"></i>
                            </div>
                            @endif
                        </div>
                        <h4>{{ auth()->user()->name }}</h4>
                        <p class="text-muted">{{ auth()->user()->email }}</p>
                    </div>
                </div>
            </div>

            <div class="col-lg-8">
                <div class="card">
                    <div class="card-header">
                        <h5 class="mb-0"><i class="fas fa-edit me-2" aria-hidden="true"></i> تعديل البيانات الشخصية</h5>
                    </div>
                    <div class="card-body">
                        <form action="{{ route('profile.update', auth()->user()->id) }}" method="POST" enctype="multipart/form-data">
                            @csrf
                            @method('PUT')

                            <div class="row g-3">
                                <div class="col-md-6">
                                    <label for="name" class="form-label">الاسم الكامل</label>
                                    <input type="text" name="name" id="name" class="form-control @error('name') is-invalid @enderror" value="{{ old('name', auth()->user()->name) }}" required>
                                    @error('name')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                    @enderror
                                </div>
                                <div class="col-md-6">
                                    <label for="phone" class="form-label">رقم الهاتف</label>
                                    <input type="text" name="phone" id="phone" class="form-control @error('phone') is-invalid @enderror" value="{{ old('phone', auth()->user()->phone ?? '') }}">
                                    @error('phone')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                    @enderror
                                </div>
                            </div>

                            <div class="row g-3 mt-3">
                                <div class="col-md-6">
                                    <label for="image" class="form-label">تغيير الصورة الشخصية</label>
                                    <input type="file" name="profile_picture" id="image" class="form-control @error('profile_picture') is-invalid @enderror" accept="image/*">
                                    @if(auth()->user()->profile_picture)
                                    <small class="text-muted">الصورة الحالية: تغييرها لا تؤثر على حسابات أخرى</small>
                                    @endif
                                    @error('profile_picture')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                    @enderror
                                </div>
                            </div>

                            <div class="mt-4">
                                <button type="submit" class="btn btn-primary">
                                    <i class="fas fa-save me-2" aria-hidden="true"></i> حفظ التغييرات
                                </button>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>

        <div class="row g-4 mb-4">
            <div class="col-lg-6">
                <div class="card">
                    <div class="card-header">
                        <h5 class="mb-0"><i class="fas fa-lock me-2" aria-hidden="true"></i> تغيير كلمة المرور</h5>
                    </div>
                    <div class="card-body">
                        <form action="{{ route('password.update') }}" method="POST">
                            @csrf
                            @method('PUT')

                            <div class="mb-3">
                                <label for="current_password" class="form-label">كلمة المرور الحالية</label>
                                <input type="password" name="current_password" id="current_password" class="form-control" required>
                            </div>

                            <div class="row g-3">
                                <div class="col-md-6">
                                    <label for="password" class="form-label">كلمة المرور الجديدة</label>
                                    <input type="password" name="password" id="password" class="form-control @error('password') is-invalid @enderror" required>
                                    @error('password')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                    @enderror
                                </div>
                                <div class="col-md-6">
                                    <label for="password_confirmation" class="form-label">تأكيد كلمة المرور الجديدة</label>
                                    <input type="password" name="password_confirmation" id="password_confirmation" class="form-control" required>
                                </div>
                            </div>

                            <div class="mt-3">
                                <button type="submit" class="btn btn-outline-primary btn-sm">
                                    <i class="fas fa-key me-2" aria-hidden="true"></i> تغيير كلمة المرور
                                </button>
                            </div>
                        </form>
                    </div>
                </div>
            </div>

            <div class="col-lg-6">
                <div class="card">
                    <div class="card-header">
                        <h5 class="mb-0"><i class="fas fa-shield-alt me-2" aria-hidden="true"></i> الأمان</h5>
                    </div>
                    <div class="card-body">
                        <div class="security-info">
                            <div class="d-flex justify-content-between align-items-center mb-3">
                                <div>
                                    <strong>مفتاح التحقق الثنائي</strong>
                                    <br><small>حماية إضافية لحسابك</small>
                                </div>
                                <button class="btn btn-outline-success btn-sm">
                                    تفعيل
                                </button>
                            </div>
                            <div class="d-flex justify-content-between align-items-center mb-3">
                                <div>
                                    <strong>الجلسات النشطة</strong>
                                    <br><small>3 جلسات مفتوحة حالياً</small>
                                </div>
                                <button class="btn btn-outline-danger btn-sm">
                                    إغلاق الجميع
                                </button>
                            </div>
                            <div class="d-flex justify-content-between align-items-center">
                                <div>
                                    <strong>ملف التعريف</strong>
                                    <br><small>تم إنشاء الحساب في 2024</small>
                                </div>
                                <span class="badge bg-success">مُوثّق</span>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <div class="text-center mt-4">
            <a href="{{ route('homePage') }}" class="home-btn"><span>العودة للصفحة الرئيسية</span> <i class="fas fa-arrow-left" aria-hidden="true"></i></a>
        </div>
    </div>
</div>
@endsection