@extends('layouts.dashboard')

@section('title', 'المفضلة — ' . config('app.name'))
@section('dashboard_title', 'المفضلة')
@section('dashboard_subtitle', 'قائمتك المختارة من الدورات والكتب المحفوظة للرجوع إليها لاحقاً.')

@section('content')
@php
    $favoritesList = $favorites ?? collect();
    $sampleFavorites = [
        [
            'id' => 1,
            'title' => 'أساسيات تصميم واجهات المواقع',
            'type' => 'دورة محفوظة',
            'meta' => 'سارة الحربي · ٨ ساعات',
            'tone' => 'blue',
            'url' => route('searchProducts.index'),
        ],
        [
            'id' => 2,
            'title' => 'هندسة الأفكار المعاصرة',
            'type' => 'كتاب محفوظ',
            'meta' => 'نور العتيبي · ٢٤٠ صفحة',
            'tone' => 'purple',
            'url' => route('searchProducts.index'),
        ]
    ];
@endphp

<div class="dashboard-panel">
    <div class="dashboard-panel__header">
        <div>
            <span class="eyebrow" style="color: var(--lavender); font-size: 11px; font-weight: 600; display: block; margin-bottom: 6px;">محفوظاتك</span>
            <h2 style="color: #fff; margin: 0; font-size: 24px; font-weight: 800;">المفضلة</h2>
        </div>
        <a href="{{ route('searchProducts.index') }}" class="button button--primary" style="padding: 10px 22px; font-size: 13px; border-radius: 999px; text-decoration: none; display: inline-flex; align-items: center; gap: 8px;">
            <span>استكشف المزيد</span>
            <i class="fas fa-arrow-left"></i>
        </a>
    </div>

    @if(session()->has('message'))
        <div class="alert alert-success mt-3 mb-0" style="background: rgba(34, 197, 94, 0.15); border: 1px solid rgba(34, 197, 94, 0.3); color: #86efac; border-radius: 12px; font-size: 13px;">
            <i class="fas fa-check-circle me-1"></i>
            <span>{{ session()->get('message') }}</span>
        </div>
    @endif

    @if($favoritesList->count() > 0)
        <div class="dashboard-content-list" style="padding-top: 18px;">
            @foreach($favoritesList as $fav)
                <article>
                    <div class="dashboard-content-thumb course-cover--purple">
                        <i class="fas fa-heart text-danger"></i>
                    </div>
                    <div>
                        <small style="color: var(--sky); font-size: 11px; font-weight: 600;">كتاب محفوظ</small>
                        <h3 style="color: #fff; margin: 4px 0 6px; font-size: 15px; font-weight: 700;">{{ $fav->name }}</h3>
                        <p style="color: var(--muted); font-size: 12px; margin: 0;">{{ \Illuminate\Support\Str::limit($fav->description, 70) }}</p>
                    </div>
                    <div class="d-flex align-items-center gap-2">
                        <a href="{{ url('/products/' . $fav->slug) }}" class="button button--secondary" style="padding: 8px 16px; font-size: 12px; text-decoration: none;">
                            عرض
                        </a>
                        <form action="{{ route('favorites.destroy', $fav->id) }}" method="POST" class="d-inline">
                            @csrf
                            @method('DELETE')
                            <button type="submit" class="button button--ghost text-danger" style="padding: 8px 12px; font-size: 12px;" title="إزالة">
                                <i class="fas fa-trash-alt"></i>
                            </button>
                        </form>
                    </div>
                </article>
            @endforeach
        </div>
    @else
        <!-- Sample Favorites matching 1:1 Figma -->
        <div class="dashboard-content-list" style="padding-top: 18px;">
            @foreach($sampleFavorites as $item)
                <article>
                    <div class="dashboard-content-thumb course-cover--{{ $item['tone'] }}">
                        <i class="fas fa-heart" style="color: var(--lavender);"></i>
                    </div>
                    <div>
                        <small style="color: var(--sky); font-size: 11px; font-weight: 600;">{{ $item['type'] }}</small>
                        <h3 style="color: #fff; margin: 4px 0 6px; font-size: 15px; font-weight: 700;">{{ $item['title'] }}</h3>
                        <p style="color: var(--muted); font-size: 12px; margin: 0;">{{ $item['meta'] }}</p>
                    </div>
                    <div class="d-flex align-items-center gap-2">
                        <a href="{{ $item['url'] }}" class="button button--secondary" style="padding: 8px 16px; font-size: 12px; text-decoration: none;">
                            عرض
                        </a>
                        <button type="button" class="button button--ghost text-danger" style="padding: 8px 12px; font-size: 12px;" onclick="this.closest('article').remove();">
                            <i class="fas fa-times me-1"></i> إزالة
                        </button>
                    </div>
                </article>
            @endforeach
        </div>
    @endif
</div>
@endsection
