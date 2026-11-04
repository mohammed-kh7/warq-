@extends('layouts.app')

@section('title', 'مجتمع القرّاء والمناقشات — ' . config('app.name'))

@section('content')
<main class="workspace-page">
    <div class="container-ofuq workspace-shell">
        <div class="workspace-heading">
            <div>
                <span class="platform-pill">
                    <i class="fas fa-users text-lavender"></i>
                    <span>أُفُق صِلة — مجتمع المعرفة</span>
                </span>
                <h1>مجتمع <span class="gradient-text">القرّاء والنقاشات</span></h1>
                <p>مساحة عربية هادئة لتبادل الأفكار، مراجعات الكتب، ومناقشة المناهج والمذكرات الأكاديمية.</p>
            </div>
            @auth
                <button type="button" class="button button--primary" onclick="document.getElementById('newPostModal').scrollIntoView({behavior: 'smooth'});">
                    <i class="fas fa-pen"></i>
                    <span>مشاركة فكرة أو مراجعة</span>
                </button>
            @else
                <a href="{{ route('login') }}" class="button button--primary">
                    <span>انضم للنقاش</span>
                    <i class="fas fa-arrow-left"></i>
                </a>
            @endauth
        </div>

        @if(session()->has('success'))
            <div class="workspace-notice mt-4">
                <i class="fas fa-check-circle"></i>
                <span>{{ session()->get('success') }}</span>
            </div>
        @endif

        <div class="workspace-grid mt-5">
            <div class="workspace-main">
                <!-- Add New Post Form (if authenticated) -->
                @auth
                <div class="glass-form-card mb-5" id="newPostModal" style="border: 1px solid var(--border-hover);">
                    <h4 class="text-white fw-bold mb-3 fs-6">
                        <i class="fas fa-feather-alt text-lavender me-2"></i> شارك رأيك أو مراجعتك لكتاب مع المجتمع
                    </h4>
                    <form action="{{ route('community.store') }}" method="POST">
                        @csrf
                        <div class="form-group-custom">
                            <input
                                type="text"
                                name="title"
                                class="form-input-custom"
                                placeholder="عنوان الفكرة أو اسم الكتاب موضوع النقاش..."
                                required
                            >
                        </div>
                        <div class="form-group-custom">
                            <textarea
                                name="content"
                                class="form-input-custom form-textarea-custom"
                                rows="3"
                                placeholder="اكتب تحليلك، رأيك في الكتاب، أو سؤالك للنقاش..."
                                required
                            ></textarea>
                        </div>
                        <div class="d-flex justify-content-between align-items-center mt-3">
                            <select name="category" class="form-input-custom" style="width: auto; height: 42px; padding-inline: 12px; font-size: 11px;">
                                <option value="مناقشات عامة">مناقشات عامة</option>
                                <option value="مراجعات كتب">مراجعات كتب</option>
                                <option value="سلايدات وأكاديميا">سلايدات وأكاديميا</option>
                                <option value="اقتباسات ملهمة">اقتباسات ملهمة</option>
                            </select>
                            <button type="submit" class="button button--primary">
                                <i class="fas fa-paper-plane"></i>
                                <span>نشر المشاركة</span>
                            </button>
                        </div>
                    </form>
                </div>
                @endauth

                <!-- Posts Feed -->
                <h3 class="text-white fw-bold fs-5 mb-4">أحدث النقاشات في المجتمع</h3>

                @if($posts->isEmpty())
                    <div class="text-center py-5">
                        <i class="fas fa-comments fa-3x text-muted mb-3"></i>
                        <h4 class="text-white fw-bold mb-2">لا توجد مناقشات بعد</h4>
                        <p class="text-muted small mb-3">كن أول من يبدأ حواراً ثقافياً أو مراجعة لكتاب مفضل.</p>
                    </div>
                @else
                    <div class="d-flex flex-column gap-4">
                        @foreach($posts as $post)
                            <div class="p-4 rounded-4" style="background: rgba(255, 255, 255, 0.02); border: 1px solid var(--border);">
                                <div class="d-flex justify-content-between align-items-center mb-3">
                                    <div class="d-flex align-items-center gap-3">
                                        <div class="rounded-circle d-flex align-items-center justify-content-center" style="width: 42px; height: 42px; background: rgba(98, 70, 217, 0.2); color: var(--lavender); font-weight: bold;">
                                            {{ mb_substr($post->user->name ?? 'م', 0, 1) }}
                                        </div>
                                        <div>
                                            <strong class="text-white d-block fs-6">{{ $post->user->name ?? 'مستخدم' }}</strong>
                                            <small class="text-muted">{{ $post->created_at->diffForHumans() }}</small>
                                        </div>
                                    </div>
                                    <span class="badge" style="background: rgba(98, 70, 217, 0.2); color: var(--lavender); border: 1px solid var(--border-hover); font-size: 11px;">
                                        {{ $post->category }}
                                    </span>
                                </div>
                                <h4 class="text-white fw-bold mb-2 fs-5">{{ $post->title }}</h4>
                                <p class="text-muted fs-6 lh-lg mb-3">{{ $post->content }}</p>

                                <div class="d-flex align-items-center gap-3 pt-3 border-top" style="border-color: var(--border) !important;">
                                    <span class="text-muted small"><i class="far fa-heart me-1 text-danger"></i> {{ $post->likes_count }} إعجاب</span>
                                    <span class="text-muted small"><i class="far fa-comment me-1 text-sky"></i> مناقشة نشطة</span>
                                </div>
                            </div>
                        @endforeach
                    </div>
                @endif
            </div>

            <div class="workspace-summary">
                <small class="text-muted">نشاط المجتمع</small>
                <strong>{{ $posts->count() }}</strong>
                <p>مشاركات ومراجعات فكرية تم نشرها من القراء.</p>

                <div><span>تصنيفات النقاش:</span> <b>٤ مجالات</b></div>
                <div><span>أجواء المنصة:</span> <b class="text-success">هادئة وتفاعلية</b></div>
                <div><span>المساعد الذكي:</span> <b class="text-sky">متاح للمساعدة</b></div>

                <button type="button" class="button button--secondary mt-4 w-100 justify-content-center" onclick="document.getElementById('chatbotToggle')?.click();">
                    <i class="fas fa-brain text-lavender"></i>
                    <span>اسأل مساعد أُفُق الذكي</span>
                </button>
            </div>
        </div>
    </div>
</main>
@endsection
