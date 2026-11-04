@extends('layouts.dashboard')

@section('title', 'مكتبتي — ' . config('app.name'))
@section('dashboard_title', 'مكتبتي')
@section('dashboard_subtitle', 'كل تفاصيل رحلتك محفوظة ومنظمة في مكان واحد.')

@section('content')
@php
    $sampleBooks = [
        [
            'title' => 'البدايات الصغيرة',
            'author' => 'سارة الحربي',
            'category' => 'التنمية',
            'color' => 'violet',
            'progress' => 22,
            'slug' => 'al-bidayat-al-saghirah'
        ],
        [
            'title' => 'دليل المنتج العربي',
            'author' => 'مازن علي',
            'category' => 'الإدارة',
            'color' => 'blue',
            'progress' => 35,
            'slug' => 'dalil-al-muntaj'
        ],
        [
            'title' => 'مسافة بين فكرتين',
            'author' => 'نور العتيبي',
            'category' => 'الأدب',
            'color' => 'violet',
            'progress' => 48,
            'slug' => 'masafah-bayn-fikratayn'
        ],
        [
            'title' => 'التعليم المرن',
            'author' => 'ريم خالد',
            'category' => 'التعليم',
            'color' => 'deep',
            'progress' => 81,
            'slug' => 'al-taaleem-al-marn'
        ],
        [
            'title' => 'ما بعد المستقبل',
            'author' => 'د. سامر فؤاد',
            'category' => 'التقنية',
            'color' => 'violet',
            'progress' => 15,
            'slug' => 'ma-baad-al-mustaqbal'
        ],
        [
            'title' => 'هندسة الأفكار',
            'author' => 'نور العتيبي',
            'category' => 'الفلسفة',
            'color' => 'blue',
            'progress' => 60,
            'slug' => 'handasat-al-afkar'
        ],
        [
            'title' => 'لغة الأشياء',
            'author' => 'مازن علي',
            'category' => 'التصميم',
            'color' => 'lavender',
            'progress' => 40,
            'slug' => 'lughat-al-ashyaa'
        ],
        [
            'title' => 'كيف نتعلّم؟',
            'author' => 'ريم خالد',
            'category' => 'المعرفة',
            'color' => 'deep',
            'progress' => 90,
            'slug' => 'kayfa-nataallam'
        ],
    ];

    $colors = ['violet', 'blue', 'lavender', 'deep'];
    $displayItems = collect();

    // If user has books in DB, put them first
    if (isset($books) && $books->count() > 0) {
        foreach ($books as $idx => $b) {
            $displayItems->push([
                'title' => $b->name,
                'author' => 'مؤلف معتمد',
                'category' => $b->category ?? 'معرفة عامة',
                'color' => $colors[$idx % 4],
                'progress' => $b->progress ?? 50,
                'slug' => $b->slug ?? ($b->id ?? 1)
            ]);
        }
    }

    // Fill up to at least 8 with sampleBooks
    foreach ($sampleBooks as $sb) {
        if ($displayItems->count() < 8) {
            $displayItems->push($sb);
        }
    }
@endphp

<div class="dashboard-panel">
    <!-- Panel Header: 1:1 Figma -->
    <div class="dashboard-panel__header">
        <div>
            <span class="eyebrow" style="color: var(--lavender); font-size: 11px; font-weight: 600; display: block; margin-bottom: 6px;">مكتبتك الشخصية</span>
            <h2 style="color: #fff; margin: 0; font-size: 24px; font-weight: 800;">تابع القراءة</h2>
        </div>
        <a href="{{ route('searchProducts.index') }}" class="button button--primary" style="padding: 10px 22px; font-size: 13px; border-radius: 999px; text-decoration: none; display: inline-flex; align-items: center; gap: 8px;">
            <span>اكتشف كتباً</span>
            <i class="fas fa-arrow-left"></i>
        </a>
    </div>

    @if(session()->has('message'))
        <div class="alert alert-success mt-3 mb-0" style="background: rgba(34, 197, 94, 0.15); border: 1px solid rgba(34, 197, 94, 0.3); color: #86efac; border-radius: 12px; font-size: 13px;">
            <i class="fas fa-check-circle me-1"></i>
            <span>{{ session()->get('message') }}</span>
        </div>
    @endif

    <!-- Library Grid: 4 columns matching Figma screenshot -->
    <div class="dashboard-library">
        @foreach($displayItems as $book)
            <article>
                <a href="{{ url('/products/' . $book['slug']) }}" class="book book--{{ $book['color'] }}">
                    <span class="book__mark">
                        <img src="{{ asset('images/waraq-logo.png') }}" alt="أُفُق">
                    </span>
                    <small>{{ $book['category'] }}</small>
                    <strong>{{ $book['title'] }}</strong>
                    <em>{{ $book['author'] }}</em>
                </a>
                <div>
                    <span>{{ $book['progress'] }}٪ مقروء</span>
                    <a href="{{ url('/products/' . $book['slug']) }}">
                        <span>متابعة القراءة</span>
                        <i class="fas fa-arrow-left"></i>
                    </a>
                </div>
            </article>
        @endforeach
    </div>
</div>
@endsection
