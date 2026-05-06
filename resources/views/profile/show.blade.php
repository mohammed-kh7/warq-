@extends('layouts.app')
@section('title', 'الملف الشخصي')

@section('content')
<div class="profile-page">
    @if(session()->has('success'))
    <div class="container px-3 pt-3">
        <div class="profile-page__alert alert alert-success d-flex align-items-center gap-2" role="alert">
            <i class="fas fa-check-circle" aria-hidden="true"></i>
            <span>{{ session()->get('success') }}</span>
        </div>
    </div>
    @endif

    <div class="container px-3 py-4">
        <header class="profile-page__hero text-center mb-4">
            <p class="profile-page__eyebrow"><i class="fas fa-id-card ms-1" aria-hidden="true"></i> حسابك</p>
            <h1 class="profile-page__title">الملف الشخصي</h1>
        </header>

        <div class="profile-page__card">
            <div class="profile-page__layout">
                <aside class="profile-page__aside">
                    <div class="profile-page__avatar-ring">
                        <img src="{{ asset('images/' . (Auth::user()->image ?? 'personalPictur.jpg')) }}" alt="صورة الملف الشخصي" class="profile-page__avatar">
                    </div>
                    <p class="profile-page__display-name">{{ Auth::user()->name }}</p>
                    <p class="profile-page__display-email">{{ Auth::user()->email }}</p>
                </aside>

                <div class="profile-page__fields">
                    <div class="profile-field">
                        <span class="profile-field__label"><i class="fas fa-user" aria-hidden="true"></i> الاسم الكامل</span>
                        <div class="profile-field__value">{{ Auth::user()->name }}</div>
                    </div>
                    <div class="profile-field">
                        <span class="profile-field__label"><i class="fas fa-envelope" aria-hidden="true"></i> البريد الإلكتروني</span>
                        <div class="profile-field__value">{{ Auth::user()->email }}</div>
                    </div>
                    <div class="profile-field">
                        <span class="profile-field__label"><i class="fas fa-phone-alt" aria-hidden="true"></i> رقم الجوال</span>
                        <div class="profile-field__value">{{ Auth::user()->phone ?? 'لم يتم تحديده' }}</div>
                    </div>
                    <div class="profile-field">
                        <span class="profile-field__label"><i class="fas fa-map-marker-alt" aria-hidden="true"></i> الموقع الجغرافي</span>
                        <div class="profile-field__value">{{ Auth::user()->location ?? 'لم يتم تحديده' }}</div>
                    </div>

                    <div class="profile-page__actions">
                        <a href="{{ route('profile.edit') }}" class="btn profile-page__edit-btn">
                            <i class="fas fa-edit" aria-hidden="true"></i> تعديل الملف الشخصي
                        </a>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
