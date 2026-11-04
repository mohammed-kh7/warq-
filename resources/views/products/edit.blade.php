@extends('layouts.app')

@section('title', 'تعديل الكتاب — ' . config('app.name'))

@section('content')
<div class="form-shell-page">
    <!-- Ambient Glows & Grid -->
    <div class="glow glow--one" aria-hidden="true"></div>
    <div class="glow glow--two" aria-hidden="true"></div>
    <div class="grid-bg" aria-hidden="true"></div>

    <div class="container-ofuq position-relative" style="z-index: 5;">
        <!-- Header -->
        <div class="form-header">
            <div class="platform-pill mx-auto mb-3">
                <i class="fas fa-edit text-lavender"></i>
                <span>إدارة الكتب والمشاركات</span>
            </div>
            <h1 class="form-title">
                تعديل بيانات <span class="gradient-text">الكتاب</span>
            </h1>
            <p class="form-subtitle">
                حدّث بيانات الكتاب أو المرجع والموقع ليسهل على المهتمين التواصل معك.
            </p>
        </div>

        <!-- Form Card Container -->
        <div class="form-card-container">
            <div class="glass-form-card">
                <form action="/products/{{ $product->slug }}" method="POST" enctype="multipart/form-data" id="editBookForm">
                    @csrf
                    @method('PUT')

                    <!-- Book Name -->
                    <div class="form-group-custom">
                        <label for="product_name" class="form-label-custom">اسم الكتاب أو المرجع</label>
                        <div class="input-with-icon-wrap">
                            <i class="fas fa-book input-icon-inner"></i>
                            <input
                                type="text"
                                name="name"
                                id="product_name"
                                class="form-input-custom @error('name') is-invalid @enderror"
                                value="{{ old('name', $product->name) }}"
                                placeholder="مثال: مقدمة في علوم الحاسوب"
                                required
                            >
                        </div>
                        @error('name')
                            <div class="error-msg-custom">{{ $message }}</div>
                        @enderror
                    </div>

                    <!-- Category & Quantity Row -->
                    <div class="row g-3">
                        <div class="col-md-7">
                            <div class="form-group-custom">
                                <label for="category" class="form-label-custom">التصنيف</label>
                                <div class="input-with-icon-wrap">
                                    <i class="fas fa-layer-group input-icon-inner"></i>
                                    <select name="category" id="category" class="form-input-custom" style="padding-right: 44px;">
                                        <option value="عام" {{ old('category', $product->category) === 'عام' ? 'selected' : '' }}>عام</option>
                                        <option value="سلايدات جامعية" {{ old('category', $product->category) === 'سلايدات جامعية' ? 'selected' : '' }}>سلايدات جامعية ومذكرات</option>
                                        <option value="الروايات والأدب" {{ old('category', $product->category) === 'الروايات والأدب' ? 'selected' : '' }}>الروايات والأدب</option>
                                        <option value="العلوم والتكنولوجيا" {{ old('category', $product->category) === 'العلوم والتكنولوجيا' ? 'selected' : '' }}>العلوم والتكنولوجيا</option>
                                        <option value="الفلسفة والفكر" {{ old('category', $product->category) === 'الفلسفة والفكر' ? 'selected' : '' }}>الفلسفة والفكر</option>
                                        <option value="التاريخ والحضارة" {{ old('category', $product->category) === 'التاريخ والحضارة' ? 'selected' : '' }}>التاريخ والحضارة</option>
                                        <option value="تطوير الذات" {{ old('category', $product->category) === 'تطوير الذات' ? 'selected' : '' }}>تطوير الذات</option>
                                        <option value="إسلاميات" {{ old('category', $product->category) === 'إسلاميات' ? 'selected' : '' }}>إسلاميات</option>
                                    </select>
                                </div>
                            </div>
                        </div>

                        <div class="col-md-5">
                            <div class="form-group-custom">
                                <label for="quantity" class="form-label-custom">الكمية المتوفرة</label>
                                <div class="input-with-icon-wrap">
                                    <i class="fas fa-sort-numeric-up input-icon-inner"></i>
                                    <input
                                        type="number"
                                        name="quantity"
                                        id="quantity"
                                        class="form-input-custom @error('quantity') is-invalid @enderror"
                                        value="{{ old('quantity', $product->quantity) }}"
                                        min="1"
                                        required
                                    >
                                </div>
                                @error('quantity')
                                    <div class="error-msg-custom">{{ $message }}</div>
                                @enderror
                            </div>
                        </div>
                    </div>

                    <!-- Description -->
                    <div class="form-group-custom">
                        <label for="description" class="form-label-custom">وصف الكتاب أو المحتوى</label>
                        <div class="input-with-icon-wrap">
                            <i class="fas fa-align-right input-icon-inner" style="top: 18px;"></i>
                            <textarea
                                name="description"
                                id="description"
                                class="form-input-custom form-textarea-custom @error('description') is-invalid @enderror"
                                rows="3"
                                placeholder="صف حالة الكتاب، النسخة، أو محتوى السلايدات الأكاديمية..."
                                required
                            >{{ old('description', $product->description) }}</textarea>
                        </div>
                        @error('description')
                            <div class="error-msg-custom">{{ $message }}</div>
                        @enderror
                    </div>

                    <!-- Location & WhatsApp Row -->
                    <div class="row g-3">
                        <div class="col-md-6">
                            <div class="form-group-custom">
                                <label for="location" class="form-label-custom">الموقع / المدينة</label>
                                <div class="input-with-icon-wrap">
                                    <i class="fas fa-map-marker-alt input-icon-inner"></i>
                                    <input
                                        type="text"
                                        name="location"
                                        id="location"
                                        class="form-input-custom @error('location') is-invalid @enderror"
                                        value="{{ old('location', $product->location) }}"
                                        placeholder="مثال: غزة، الرمال / خان يونس"
                                        required
                                    >
                                </div>
                                @error('location')
                                    <div class="error-msg-custom">{{ $message }}</div>
                                @enderror
                            </div>
                        </div>

                        <div class="col-md-6">
                            <div class="form-group-custom">
                                <label for="whatsapp" class="form-label-custom">رقم الواتساب للتواصل</label>
                                <div class="input-with-icon-wrap">
                                    <i class="fab fa-whatsapp input-icon-inner"></i>
                                    <input
                                        type="text"
                                        name="whatsapp"
                                        id="whatsapp"
                                        class="form-input-custom @error('whatsapp') is-invalid @enderror"
                                        value="{{ old('whatsapp', $product->whatsapp) }}"
                                        placeholder="059xxxxxxx أو 970xxxxxxx"
                                        required
                                    >
                                </div>
                                @error('whatsapp')
                                    <div class="error-msg-custom">{{ $message }}</div>
                                @enderror
                            </div>
                        </div>
                    </div>

                    <!-- Current & New Image Upload -->
                    <div class="form-group-custom">
                        <label class="form-label-custom">صورة الغلاف الحالية أو تحديثها</label>
                        @if($product->image_path)
                            <div class="mb-3 d-flex align-items-center gap-3 p-3 rounded-4" style="background: rgba(255, 255, 255, 0.04); border: 1px solid var(--border);">
                                <img src="{{ asset('images/' . $product->image_path) }}" alt="{{ $product->name }}" style="width: 50px; height: 65px; object-fit: cover; border-radius: 8px;">
                                <div class="text-muted small">الغلاف المرفق حالياً. يمكنك اختيار صورة جديدة لاستبدالها.</div>
                            </div>
                        @endif

                        <label for="image_path" class="file-upload-zone" id="fileUploadZone">
                            <i class="fas fa-cloud-upload-alt file-upload-icon"></i>
                            <div class="file-upload-title" id="fileUploadTitle">اضغط لاختيار صورة غلاف جديدة</div>
                            <div class="file-upload-hint">PNG أو JPG (الحد الأقصى: 4 ميغابايت)</div>
                            <input type="file" name="image_path" id="image_path" class="d-none" accept="image/*" onchange="previewFileName(this)">
                        </label>
                        @error('image_path')
                            <div class="error-msg-custom">{{ $message }}</div>
                        @enderror
                    </div>

                    <!-- Submit Actions -->
                    <div class="d-flex flex-wrap gap-3 mt-4">
                        <button type="submit" class="button button--primary flex-grow-1 justify-content-center">
                            <i class="fas fa-check-circle"></i>
                            <span>حفظ التعديلات</span>
                        </button>
                        <a href="{{ url('/products/' . $product->slug) }}" class="button button--secondary">
                            <span>إلغاء</span>
                        </a>
                    </div>
                </form>
            </div>

            <!-- Side Note -->
            <div class="form-footer-note">
                <i class="fas fa-shield-alt me-1 text-lavender"></i>
                <span>يتم تحديث بيانات الكتاب فوراً في فهرس المكتبة العام.</span>
            </div>
        </div>
    </div>
</div>

<script>
function previewFileName(input) {
    if (input.files && input.files[0]) {
        document.getElementById('fileUploadTitle').textContent = 'تم اختيار: ' + input.files[0].name;
        document.getElementById('fileUploadZone').style.borderColor = 'var(--sky)';
        document.getElementById('fileUploadZone').style.background = 'rgba(36, 117, 233, 0.08)';
    }
}
</script>
@endsection
