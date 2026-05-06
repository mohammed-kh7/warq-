@extends('layouts.app')
@section('title', 'تعديل الكتاب')

@section('content')

<div class="main-content container_h2">
    <div class="description">
        <h2>تعديل الكتاب</h2>
    </div>

    <div class="container">
        <div class="card">
            <div class="card-body">
                <form action="/products/{{$product->slug}}" method="POST" enctype="multipart/form-data">
                    @csrf
                    @method('PUT')
                    <div class="mb-3 position-relative">
                        <label for="product_name">اسم الكتاب</label>
                        <input
                            type="text"
                            name="name"
                            id="product_name"
                            class="form-control input-with-icon"
                            value="{{$product->name}}"
                            required>
                        <i class="fas fa-book icon-right"></i>
                    </div>

                    <div class="mb-3 position-relative">
                        <label for="description">وصف الكتاب</label>
                        <textarea
                            name="description"
                            id="description"
                            class="form-control input-with-icon"
                            rows="3"
                            required>
                        {{$product->description}}</textarea>
                        <i class="fas fa-clipboard icon-right" style="margin-top: -37px;"></i>
                    </div>

                    <div class="mb-3 position-relative">
                        <label for="quantity">الكمية</label>
                        <input
                            type="number"
                            name="quantity"
                            id="quantity"
                            class="form-control input-with-icon"
                            value="{{$product->quantity}}"
                            required>
                        <i class="fas fa-sort-numeric-up icon-right"></i>
                    </div>
                    <div class="mb-3 position-relative">
                        <label for="location">الموقع</label>
                        <input
                            type="text"
                            name="location"
                            id="location"
                            class="form-control input-with-icon"
                            value="{{$product->location}}"
                            required>
                        <i class="fas fa-map-marker-alt icon-right"></i>
                    </div>

                    <div class="mb-3 position-relative">
                        <label for="whatsapp">رقم الواتساب</label>
                        <input
                            type="text"
                            name="whatsapp"
                            id="whatsapp"
                            class="form-control input-with-icon"
                            value="{{$product->whatsapp}}"
                            required>
                        <i class="fab fa-whatsapp icon-right"></i>
                    </div>
                    @error('whatsapp')
                    <div class="invalid-feedback d-block">{{ $message }}</div>
                    @enderror

                    <div class="mb-3 position-relative">
                        <label for="image">صورة الكتاب</label>
                        <input
                            type="file"
                            name="image_path"
                            id="image"
                            class="form-control input-with-icon">
                        <i class="fas fa-image icon-right"></i>
                    </div>
                    @error('image_path')
                    <div class="invalid-feedback d-block">{{ $message }}</div>
                    @enderror
                    <button type="submit" class="btn btn-primary w-100 mt-3" style="font-size: 22px;"> <i class="fas fa-plus-circle icon_add"></i> حفظ تعديلات الكتاب</button>
                </form>
            </div>
        </div>
    </div>
    <div class="image-container">
        <p class="encouraging-message">تبرعك يصنع الفرق – شكرًا لكرمك!</p>
    </div>
</div>

@endsection
