@extends('layouts.app')

@section('title', 'إرسال طلب عاجل — أُفُق وَرَق')

@section('content')

<div class="form-shell-page">
    <!-- Ambient Glows & Grid -->
    <div class="glow glow--one" aria-hidden="true" style="background: radial-gradient(circle, rgba(239, 68, 68, 0.2), transparent 70%);"></div>
    <div class="glow glow--two" aria-hidden="true"></div>
    <div class="grid-bg" aria-hidden="true"></div>

    <div class="container-ofuq position-relative" style="z-index: 5;">
        <!-- Header -->
        <div class="form-header-center">
            <div class="eyebrow-badge" style="background: rgba(239, 68, 68, 0.15); border-color: rgba(239, 68, 68, 0.3); color: #fca5a5;">
                <i class="fas fa-bolt text-danger"></i>
                <span>طلب عاجل</span>
            </div>
            <h1>صف طلبك</h1>
            <p>أرسل نداءً عاجلاً لتوفير مرجع دراسي، كتاب نادر، أو ملخص تحتاجه بشكل طارئ</p>
        </div>

        <!-- Glass Card Form -->
        <div class="form-glass-card" style="box-shadow: 0 25px 70px rgba(0, 0, 0, 0.6), 0 0 40px rgba(239, 68, 68, 0.12); border-color: rgba(239, 68, 68, 0.25);">
            <form action="{{ url('/emergancyRequest') }}" method="POST">
                @csrf

                <!-- Description -->
                <div class="form-group-ofuq">
                    <label for="request-description" class="form-label-ofuq">وصف الطلب والاحتياج</label>
                    <div class="input-wrap-ofuq">
                        <i class="fas fa-pencil-alt input-textarea-icon"></i>
                        <textarea
                            name="description"
                            id="request-description"
                            class="input-ofuq"
                            placeholder="اشرح ما تحتاجه بوضوح — المادة، الموقف، وأي معلومة تساعد من يستطيع المساعدة..."
                            rows="4"
                            required
                        >{{ old('description') }}</textarea>
                    </div>
                    @error('description')
                        <small class="text-danger mt-1 d-block">{{ $message }}</small>
                    @enderror
                </div>

                <!-- Location -->
                <div class="form-group-ofuq">
                    <label for="location" class="form-label-ofuq">الموقع التقريبي</label>
                    <div class="input-wrap-ofuq">
                        <i class="fas fa-map-marker-alt"></i>
                        <input
                            type="text"
                            name="location"
                            id="location"
                            class="input-ofuq"
                            placeholder="المنطقة أو المعالم القريبة لتسهيل التسليم"
                            value="{{ old('location') }}"
                            required
                        >
                    </div>
                    @error('location')
                        <small class="text-danger mt-1 d-block">{{ $message }}</small>
                    @enderror
                </div>

                <!-- WhatsApp -->
                <div class="form-group-ofuq">
                    <label for="whatsapp" class="form-label-ofuq">رقم الواتساب للتواصل السريع</label>
                    <div class="input-wrap-ofuq">
                        <i class="fab fa-whatsapp text-success"></i>
                        <input
                            type="text"
                            name="whatsapp"
                            id="whatsapp"
                            class="input-ofuq"
                            placeholder="رقم يمكن التواصل عليه بسرعة (مثال: 0599000000)"
                            value="{{ old('whatsapp') }}"
                            required
                        >
                    </div>
                    @error('whatsapp')
                        <small class="text-danger mt-1 d-block">{{ $message }}</small>
                    @enderror
                </div>

                <!-- Submit Button -->
                <button type="submit" class="button w-100 py-3 mt-3 fw-bold" style="background: linear-gradient(135deg, #dc2626, #b91c1c); box-shadow: 0 10px 30px rgba(220, 38, 38, 0.4); font-size: 16px;">
                    <i class="fas fa-plus-circle"></i>
                    <span>إرسال الطلب العاجل</span>
                </button>
            </form>
        </div>

        <p class="form-footer-note text-center mt-4">
            نحن معك — سيصل طلبك لمجتمع المنصة قدر الإمكان.
        </p>
    </div>
</div>
@endsection
