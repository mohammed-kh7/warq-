@extends('layouts.app')

@section('title', 'أضف كتاباً للتبرع — أُفُق وَرَق')

@section('content')

<div class="form-shell-page">
    <!-- Ambient Glows & Grid -->
    <div class="glow glow--one" aria-hidden="true"></div>
    <div class="glow glow--two" aria-hidden="true"></div>
    <div class="grid-bg" aria-hidden="true"></div>

    <div class="container-ofuq position-relative" style="z-index: 5;">
        <!-- Header -->
        <div class="form-header-center">
            <div class="eyebrow-badge">
                <i class="fas fa-book-open"></i>
                <span>تبرع بمعرفة</span>
            </div>
            <h1>أضف كتابًا يصل لمن يحتاجه</h1>
            <p>شارك كتبك ومراجعك الدراسية مع مجتمع القراء والطلاب لتعم الفائدة</p>
        </div>

        <!-- Glass Card Form -->
        <div class="form-glass-card">
            <form action="{{ url('/products') }}" method="POST" enctype="multipart/form-data">
                @csrf

                <!-- Book Name -->
                <div class="form-group-ofuq">
                    <label for="product_name" class="form-label-ofuq">اسم الكتاب أو المرجع</label>
                    <div class="input-wrap-ofuq">
                        <i class="fas fa-book"></i>
                        <input
                            type="text"
                            name="name"
                            id="product_name"
                            class="input-ofuq"
                            placeholder="...مثال: كتاب، مرجع، مادة تعليمية"
                            value="{{ old('name') }}"
                            required
                        >
                    </div>
                    @error('name')
                        <small class="text-danger mt-1 d-block">{{ $message }}</small>
                    @enderror
                </div>

                <!-- Category -->
                <div class="form-group-ofuq">
                    <label for="category" class="form-label-ofuq">تصنيف الكتاب</label>
                    <div class="input-wrap-ofuq">
                        <i class="fas fa-tag"></i>
                        <select name="category" id="category" class="input-ofuq" required>
                            <option value="التقنية" {{ old('category') == 'التقنية' ? 'selected' : '' }}>التقنية والبرمجة</option>
                            <option value="التنمية" {{ old('category') == 'التنمية' ? 'selected' : '' }}>تطوير الذات والتنمية</option>
                            <option value="التصميم" {{ old('category') == 'التصميم' ? 'selected' : '' }}>التصميم والفنون</option>
                            <option value="سلايدات جامعية" {{ old('category') == 'سلايدات جامعية' ? 'selected' : '' }}>سلايدات ومذكرات جامعية</option>
                            <option value="عام" {{ old('category') == 'عام' ? 'selected' : '' }}>عام</option>
                        </select>
                    </div>
                </div>

                <!-- Description -->
                <div class="form-group-ofuq">
                    <label for="description" class="form-label-ofuq">وصف الكتاب وحالته</label>
                    <div class="input-wrap-ofuq">
                        <i class="fas fa-file-alt input-textarea-icon"></i>
                        <textarea
                            name="description"
                            id="description"
                            class="input-ofuq"
                            placeholder="صف الحالة، الطبعة، أو أي تفاصيل تسهل على المستفيد القرار..."
                            rows="3"
                            required
                        >{{ old('description') }}</textarea>
                    </div>
                    @error('description')
                        <small class="text-danger mt-1 d-block">{{ $message }}</small>
                    @enderror
                </div>

                <div class="row g-3">
                    <!-- Quantity -->
                    <div class="col-sm-6">
                        <div class="form-group-ofuq">
                            <label for="quantity" class="form-label-ofuq">الكمية المتاحة</label>
                            <div class="input-wrap-ofuq">
                                <i class="fas fa-sort-numeric-up"></i>
                                <input
                                    type="number"
                                    name="quantity"
                                    id="quantity"
                                    class="input-ofuq"
                                    placeholder="عدد النسخ المتاحة"
                                    value="{{ old('quantity', 1) }}"
                                    min="1"
                                    required
                                >
                            </div>
                            @error('quantity')
                                <small class="text-danger mt-1 d-block">{{ $message }}</small>
                            @enderror
                        </div>
                    </div>

                    <!-- Location -->
                    <div class="col-sm-6">
                        <div class="form-group-ofuq">
                            <label for="location" class="form-label-ofuq">الموقع / الاستلام</label>
                            <div class="input-wrap-ofuq">
                                <i class="fas fa-map-marker-alt"></i>
                                <input
                                    type="text"
                                    name="location"
                                    id="location"
                                    class="input-ofuq"
                                    placeholder="منطقة التسليم التقريبية"
                                    value="{{ old('location') }}"
                                    required
                                >
                            </div>
                            @error('location')
                                <small class="text-danger mt-1 d-block">{{ $message }}</small>
                            @enderror
                        </div>
                    </div>
                </div>

                <!-- WhatsApp Contact -->
                <div class="form-group-ofuq">
                    <label for="whatsapp" class="form-label-ofuq">رقم الواتساب للتواصل</label>
                    <div class="input-wrap-ofuq">
                        <i class="fab fa-whatsapp text-success"></i>
                        <input
                            type="text"
                            name="whatsapp"
                            id="whatsapp"
                            class="input-ofuq"
                            placeholder="للتواصل عند الاهتمام بالكتاب (مثال: 0599000000)"
                            value="{{ old('whatsapp') }}"
                            required
                        >
                    </div>
                    @error('whatsapp')
                        <small class="text-danger mt-1 d-block">{{ $message }}</small>
                    @enderror
                </div>

                <!-- Image Upload -->
                <div class="form-group-ofuq">
                    <label class="form-label-ofuq">صورة الكتاب / المرجع</label>
                    <div class="file-input-wrapper">
                        <input type="file" name="image_path" id="book_image" accept="image/*" required onchange="handleFileSelected(this)">
                        <i class="fas fa-cloud-upload-alt fa-2x text-lavender mb-2"></i>
                        <div class="text-white fw-bold small" id="fileNameDisplay">انقر هنا لاختيار صورة الكتاب</div>
                        <small class="text-muted d-block mt-1">يدعم JPG, PNG بحد أقصى 2MB</small>
                    </div>
                    @error('image_path')
                        <small class="text-danger mt-1 d-block">{{ $message }}</small>
                    @enderror
                </div>

                <!-- Submit Button -->
                <button type="submit" class="button button--primary w-100 py-3 mt-3" style="font-size: 16px;">
                    <i class="fas fa-plus-circle"></i>
                    <span>نشر الكتاب للتبرع</span>
                </button>
            </form>
        </div>

        <p class="form-footer-note">
            شكراً لمشاركتك — تبرعك بكتاب يفيد أحدهم اليوم ويساهم في نشر المعرفة.
        </p>
    </div>
</div>

<script>
    function handleFileSelected(input) {
        const display = document.getElementById('fileNameDisplay');
        if (input.files && input.files[0]) {
            display.textContent = 'تم اختيار: ' + input.files[0].name;
            display.classList.add('text-sky');
        }
    }
</script>
@endsection
