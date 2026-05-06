@extends('layouts.app')
@section('title', 'تعديل الطلب الطارئ')

@section('content')
<div class="main-content form-page form-page--urgent">
    <div class="container px-3 py-4">
        <header class="form-page__hero text-center">
            <p class="form-page__eyebrow"><i class="fas fa-pen ms-1" aria-hidden="true"></i> تعديل</p>
            <h1 class="form-page__title">تحديث طلبك الطارئ</h1>
        </header>

        <div class="form-page__card-wrap">
            <div class="card form-page__card border-0">
                <div class="card-body p-4">
                    <form action="/emergancyRequest/{{ $emergancyRequest->id }}" method="POST">
                        @csrf
                        @method('PUT')

                        <div class="mb-3 position-relative">
                            <label for="request-description" class="form-label">وصف الطلب</label>
                            <div class="input-group position-relative">
                                <textarea name="description" id="request-description" class="form-control" rows="4" required style="padding-right: 2.5rem;">{{ old('description', $emergancyRequest->description) }}</textarea>
                                <i class="fas fa-pencil-alt icon-right2 icon-right2--textarea" aria-hidden="true"></i>
                            </div>
                            @error('description')
                            <div class="text-danger small mt-1">{{ $message }}</div>
                            @enderror
                        </div>

                        <div class="mb-3 position-relative">
                            <label for="location" class="form-label">الموقع</label>
                            <div class="input-group position-relative">
                                <input type="text" name="location" id="location" class="form-control" value="{{ old('location', $emergancyRequest->location) }}" required>
                                <i class="fas fa-map-marker-alt icon-right2" aria-hidden="true"></i>
                            </div>
                            @error('location')
                            <div class="text-danger small mt-1">{{ $message }}</div>
                            @enderror
                        </div>

                        <div class="mb-3 position-relative">
                            <label for="whatsapp" class="form-label">رقم الواتساب</label>
                            <div class="input-group position-relative">
                                <input type="text" name="whatsapp" id="whatsapp" class="form-control" value="{{ old('whatsapp', $emergancyRequest->whatsapp) }}" required>
                                <i class="fab fa-whatsapp icon-right2" aria-hidden="true"></i>
                            </div>
                            @error('whatsapp')
                            <div class="text-danger small mt-1">{{ $message }}</div>
                            @enderror
                        </div>

                        <button type="submit" class="btn btn-primary w-100 mt-3 form-page__submit form-page__submit--urgent">
                            <i class="fas fa-save icon_add" aria-hidden="true"></i> حفظ التعديلات
                        </button>
                    </form>
                </div>
            </div>
        </div>

        <p class="form-page__footnote mb-0 text-center">
            <a href="{{ url('/emergancyRequest/' . $emergancyRequest->id) }}">العودة لتفاصيل الطلب</a>
        </p>
    </div>
</div>
@endsection
