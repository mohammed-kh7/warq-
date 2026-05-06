@extends('layouts.app')
@section('title', 'إضافة كتاب')

@section('content')
<div class="main-content form-page form-page--teal">
    <div class="container px-3 py-4">
        <header class="form-page__hero">
            <p class="form-page__eyebrow"><i class="fas fa-book-open ms-1" aria-hidden="true"></i> تبرع بمعرفة</p>
            <h1 class="form-page__title">أضف كتابًا يصل لمن يحتاجه</h1>
        </header>

        <div class="form-page__card-wrap">
            <div class="card form-page__card border-0">
                <div class="card-body p-4">
                    <form action="/products" method="POST" enctype="multipart/form-data">
                        @csrf

                        <div class="mb-3 position-relative">
                            <label for="product_name">اسم الكتاب</label>
                            <input
                                type="text"
                                name="name"
                                id="product_name"
                                class="form-control input-with-icon @error('name') is-invalid @enderror"
                                placeholder="مثال: كتاب، مرجع، مادة تعليمية…"
                                value="{{ old('name') }}"
                                required>
                            <i class="fas fa-book icon-right" aria-hidden="true"></i>
                            @error('name')
                            <div class="invalid-feedback d-block">{{ $message }}</div>
                            @enderror
                        </div>

                        <div class="mb-3 position-relative">
                            <label for="description">وصف الكتاب</label>
                            <textarea
                                name="description"
                                id="description"
                                class="form-control input-with-icon @error('description') is-invalid @enderror"
                                placeholder="صف الحالة، الطبعة، أو أي تفاصيل تسهل على المستفيد القرار"
                                rows="3"
                                required>{{ old('description') }}</textarea>
                            <i class="fas fa-clipboard icon-right icon-right--textarea" aria-hidden="true"></i>
                            @error('description')
                            <div class="invalid-feedback d-block">{{ $message }}</div>
                            @enderror
                        </div>

                        <div class="mb-3 position-relative">
                            <label for="quantity">الكمية</label>
                            <input
                                type="number"
                                name="quantity"
                                id="quantity"
                                class="form-control input-with-icon @error('quantity') is-invalid @enderror"
                                placeholder="عدد النسخ أو الوحدات المتاحة"
                                value="{{ old('quantity') }}"
                                required>
                            <i class="fas fa-sort-numeric-up icon-right" aria-hidden="true"></i>
                            @error('quantity')
                            <div class="invalid-feedback d-block">{{ $message }}</div>
                            @enderror
                        </div>

                        <div class="mb-3 position-relative">
                            <label for="location">الموقع</label>
                            <input
                                type="text"
                                name="location"
                                id="location"
                                class="form-control input-with-icon @error('location') is-invalid @enderror"
                                placeholder="منطقة التسليم أو الاستلام التقريبية"
                                value="{{ old('location') }}"
                                required>
                            <i class="fas fa-map-marker-alt icon-right" aria-hidden="true"></i>
                            @error('location')
                            <div class="invalid-feedback d-block">{{ $message }}</div>
                            @enderror
                        </div>

                        <div class="mb-3 position-relative">
                            <label for="whatsapp">رقم الواتساب</label>
                            <input
                                type="text"
                                name="whatsapp"
                                id="whatsapp"
                                class="form-control input-with-icon @error('whatsapp') is-invalid @enderror"
                                placeholder="للتواصل عند الاهتمام بالكتاب"
                                value="{{ old('whatsapp') }}"
                                required>
                            <i class="fab fa-whatsapp icon-right" aria-hidden="true"></i>
                            @error('whatsapp')
                            <div class="invalid-feedback d-block">{{ $message }}</div>
                            @enderror
                        </div>

                        <div class="mb-3 position-relative">
                            <label for="image">صورة الكتاب</label>
                            <input
                                type="file"
                                name="image_path"
                                id="image"
                                class="form-control input-with-icon @error('image_path') is-invalid @enderror">
                            <i class="fas fa-image icon-right" aria-hidden="true"></i>
                            @if ($errors->has('image_path'))
                            <span class="text-danger d-block small mt-1">{{ $errors->first('image_path') }}</span>
                            @endif
                        </div>

                        <button type="submit" class="btn btn-primary w-100 mt-3 form-page__submit">
                            <i class="fas fa-plus-circle icon_add" aria-hidden="true"></i> نشر الكتاب
                        </button>
                    </form>
                </div>
            </div>
        </div>

        <p class="form-page__footnote mb-0">شكرًا لمشاركتك — تبرعك بكتاب يفيد أحدهم اليوم.</p>
    </div>
</div>
@endsection
