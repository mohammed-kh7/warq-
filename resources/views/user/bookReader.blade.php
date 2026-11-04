@extends('layouts.app')

@section('title', 'قراءة: ' . $product->name . ' — ' . config('app.name'))

@push('head')
<style>
.reader-canvas {
    min-height: calc(100vh - 80px);
    background: radial-gradient(circle at 50% 0%, rgba(98, 70, 217, 0.12), transparent 40%), #07080e;
    padding: 30px 0 60px;
}
.reader-shell {
    background: rgba(13, 15, 27, 0.95);
    border: 1px solid var(--border-hover);
    border-radius: 28px;
    overflow: hidden;
    backdrop-filter: blur(25px);
    box-shadow: 0 30px 80px rgba(0, 0, 0, 0.6);
}
.reader-sidebar {
    width: 320px;
    background: rgba(10, 12, 22, 0.9);
    border-left: 1px solid var(--border);
    padding: 28px;
}
.reader-content {
    flex: 1;
    min-width: 0;
    display: flex;
    flex-direction: column;
}
.reader-topbar {
    padding: 20px 28px;
    border-bottom: 1px solid var(--border);
    display: flex;
    justify-content: space-between;
    align-items: center;
    background: rgba(255, 255, 255, 0.02);
}
.reader-display {
    flex: 1;
    padding: 32px;
    display: flex;
    flex-direction: column;
    align-items: center;
    justify-content: center;
}
.reader-paper {
    width: 100%;
    max-width: 780px;
    min-height: 520px;
    background: #0f1220;
    border: 1px solid var(--border);
    border-radius: 20px;
    padding: 40px;
    color: #e2e8f0;
    box-shadow: inset 0 0 40px rgba(0, 0, 0, 0.4);
    display: flex;
    flex-direction: column;
    justify-content: center;
    text-align: center;
}
.bookmark-card {
    padding: 10px 14px;
    border-radius: 12px;
    background: rgba(255, 255, 255, 0.03);
    border: 1px solid var(--border);
    cursor: pointer;
    transition: all 0.2s var(--ease);
}
.bookmark-card:hover {
    background: rgba(98, 70, 217, 0.15);
    border-color: var(--border-hover);
}
</style>
@endpush

@section('content')
<div class="reader-canvas">
    <div class="container-ofuq">
        <!-- Breadcrumb & Reader Navigation -->
        <div class="d-flex justify-content-between align-items-center mb-4">
            <a href="{{ route('myLibrary.index') }}" class="text-link">
                <i class="fas fa-arrow-right me-1"></i>
                <span>العودة لمكتبتي</span>
            </a>
            <div class="platform-pill m-0">
                <i class="fas fa-book-open text-lavender"></i>
                <span>المُشغّل الذكي للكتب والمذكرات</span>
            </div>
        </div>

        <!-- Reader Main Shell -->
        <div class="reader-shell d-flex flex-column flex-lg-row">
            <!-- Sidebar: Book Meta & Tools -->
            <div class="reader-sidebar">
                <!-- Book Meta -->
                <div class="text-center pb-4 border-bottom" style="border-color: var(--border) !important;">
                    @if($product->image_path)
                        <img src="{{ asset('images/' . $product->image_path) }}" alt="{{ $product->name }}" style="width: 90px; height: 125px; object-fit: cover; border-radius: 12px; box-shadow: 0 10px 30px rgba(0,0,0,0.5); margin-bottom: 14px;">
                    @else
                        <div class="d-inline-flex align-items-center justify-content-center p-4 rounded-4 mb-3" style="background: rgba(98, 70, 217, 0.2); color: var(--lavender);">
                            <i class="fas fa-book fa-3x"></i>
                        </div>
                    @endif
                    <h3 class="text-white fw-bold fs-6 mb-1">{{ $product->name }}</h3>
                    <small class="text-muted d-block">{{ $product->user->name ?? 'مؤلف معتمد' }}</small>
                </div>

                <!-- Progress Tracker -->
                <div class="py-4 border-bottom" style="border-color: var(--border) !important;">
                    <div class="d-flex justify-content-between text-muted small mb-2">
                        <span>تقدم القراءة</span>
                        <strong class="text-white">{{ $currentProgress }}%</strong>
                    </div>
                    <div style="height: 6px; background: rgba(255, 255, 255, 0.08); border-radius: 6px; overflow: hidden;">
                        <div style="width: {{ $currentProgress }}%; height: 100%; background: linear-gradient(90deg, var(--purple), var(--blue));"></div>
                    </div>
                </div>

                <!-- AI Copilot Ask Box -->
                <div class="py-4 border-bottom" style="border-color: var(--border) !important;">
                    <h5 class="text-white fw-bold fs-6 mb-2">
                        <i class="fas fa-brain text-lavender me-1"></i> المساعد المعرفي
                    </h5>
                    <p class="text-muted small mb-3">اسأل المساعد الذكي عن أي تلخيص، شرح مفهوم، أو استفسار داخل هذا الكتاب.</p>
                    <button type="button" class="button button--secondary w-100 justify-content-center" onclick="document.getElementById('chatbotToggle')?.click();">
                        <i class="fas fa-comments"></i>
                        <span>فتح المحادثة الذكية</span>
                    </button>
                </div>

                <!-- Bookmarks List -->
                <div class="pt-4">
                    <div class="d-flex justify-content-between align-items-center mb-3">
                        <h5 class="text-white fw-bold fs-6 m-0">
                            <i class="fas fa-flag text-warning me-1"></i> الإشارات المرجعية
                        </h5>
                    </div>

                    @if(empty($bookmarks))
                        <p class="text-muted small">لا توجد إشارات محفوظة بعد.</p>
                    @else
                        <div class="d-flex flex-column gap-2">
                            @foreach($bookmarks as $bm)
                                <div class="bookmark-card d-flex justify-content-between align-items-center" onclick="goToPage({{ $bm['page'] }})">
                                    <div>
                                        <div class="text-white small fw-bold">{{ $bm['label'] ?? 'إشارة صفحة' }}</div>
                                        <small class="text-muted">الصفحة {{ $bm['page'] }}</small>
                                    </div>
                                    <i class="fas fa-arrow-left text-muted" style="font-size: 11px;"></i>
                                </div>
                            @endforeach
                        </div>
                    @endif
                </div>
            </div>

            <!-- Content Area: The Reader -->
            <div class="reader-content">
                <div class="reader-topbar">
                    <h4 class="text-white fw-bold fs-6 m-0">
                        {{ $product->name }} — <span class="text-muted fw-normal">الصفحة {{ $currentPage }}</span>
                    </h4>

                    <div class="d-flex align-items-center gap-2">
                        @auth
                            <button class="button button--ghost" onclick="addBookmark()">
                                <i class="fas fa-bookmark text-warning"></i>
                                <span>إشارة</span>
                            </button>
                            <button class="button button--ghost text-success" onclick="markAsRead()">
                                <i class="fas fa-check-circle"></i>
                                <span>إكمال</span>
                            </button>
                        @endauth
                    </div>
                </div>

                <div class="reader-display">
                    <div class="reader-paper">
                        <i class="fas fa-book-reader fa-4x text-lavender opacity-50 mb-3"></i>
                        <h3 class="text-white fw-bold mb-2">{{ $product->name }}</h3>
                        <p class="text-muted fs-6 lh-lg mb-4" style="max-width: 580px; margin-inline: auto;">
                            {{ $product->description }}
                        </p>
                        <div class="platform-pill mx-auto mb-4" style="background: rgba(36, 117, 233, 0.1); border-color: rgba(36, 117, 233, 0.3); color: var(--sky);">
                            <i class="fas fa-info-circle"></i>
                            <span>نسخة القراءة الرقمية المعتمدة لمكتبة أُفُق وَرَق</span>
                        </div>
                        <div class="d-flex justify-content-center gap-2">
                            <button class="button button--secondary" onclick="updateProgress(25)">
                                <span>تقدم ٢٥٪</span>
                            </button>
                            <button class="button button--secondary" onclick="updateProgress(50)">
                                <span>تقدم ٥٠٪</span>
                            </button>
                            <button class="button button--primary" onclick="updateProgress(100)">
                                <i class="fas fa-check"></i>
                                <span>أنهيت القراءة ١٠٠٪</span>
                            </button>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection

@push('scripts')
<script>
function updateProgress(percent) {
    @if(auth()->check())
    fetch('{{ url('/library/' . $product->id . '/progress') }}', {
        method: 'PUT',
        headers: {
            'X-CSRF-TOKEN': '{{ csrf_token() }}',
            'Content-Type': 'application/json',
        },
        body: JSON.stringify({
            progress: percent,
            page: Math.ceil({{ $currentPage }})
        })
    })
    .then(r => r.json())
    .then(data => {
        if (data.success) location.reload();
    });
    @else
    alert('يرجى تسجيل الدخول لحفظ التقدم');
    @endif
}

function markAsRead() {
    @if(auth()->check())
    fetch('{{ url('/library/' . $product->id . '/reading') }}', {
        method: 'POST',
        headers: {
            'X-CSRF-TOKEN': '{{ csrf_token() }}',
            'Content-Type': 'application/json',
        }
    })
    .then(r => r.json())
    .then(data => {
        if (data.success || data.message) location.reload();
    });
    @else
    alert('يرجى تسجيل الدخول');
    @endif
}

function addBookmark() {
    const page = prompt('أدخل رقم الصفحة لحفظها كإشارة مرجعية:', '{{ $currentPage }}');
    if (page) {
        @if(auth()->check())
        fetch('{{ url('/read/' . ($product->slug ?? $product->id) . '/bookmark') }}', {
            method: 'POST',
            headers: {
                'X-CSRF-TOKEN': '{{ csrf_token() }}',
                'Content-Type': 'application/json',
            },
            body: JSON.stringify({
                page: parseInt(page),
                label: 'ملاحظة'
            })
        })
        .then(r => r.json())
        .then(data => {
            if (data.success) {
                alert('تمت إضافة الإشارة المرجعية بنجاح');
                location.reload();
            }
        });
        @else
        alert('يرجى تسجيل الدخول');
        @endif
    }
}

function goToPage(page) {
    alert('الانتقال إلى الصفحة ' + page);
}
</script>
@endpush
