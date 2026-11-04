@extends('layouts.app')
@section('title', 'نظرة عامة')

@section('content')
@php
    $readingStats = [
        'total_days' => 0,
        'active_books' => 0,
        'weekly_data' => []
    ];

    $readingChart = [
        'labels' => ['إثنين', 'ثلاثاء', 'أربعاء', 'خميس', 'جمعة', 'سبت', 'أحد'],
        'data' => [120, 190, 150, 180, 220, 280, 240],
    ];
@endphp

<div class="overview-page main-content">
    <div class="container px-3 py-4">
        <header class="overview__hero text-center">
            <p class="overview__eyebrow"><i class="fas fa-chart-line me-2" aria-hidden="true"></i> نظرة عامة</p>
            <h1 class="overview__title">إحصائيات القراءة</h1>
            <p class="overview__stat"><span class="overview__stat-num">{{ $totalPages ?? 1250 }}</span> صفحة مقروءة</p>
        </header>

        <div class="row g-4 mb-4">
            <div class="col-md-4">
                <div class="stats-card">
                    <div class="stats-card__icon bg-primary bg-gradient">
                        <i class="fas fa-book-reader" aria-hidden="true"></i>
                    </div>
                    <div class="stats-card__body">
                        <h3 class="stats-card__value">{{ $readingStats['active_books'] ?? 12 }}</h3>
                        <p class="stats-card__label">كتب نشطة</p>
                    </div>
                </div>
            </div>
            <div class="col-md-4">
                <div class="stats-card">
                    <div class="stats-card__icon bg-success bg-gradient">
                        <i class="fas fa-check-circle" aria-hidden="true"></i>
                    </div>
                    <div class="stats-card__body">
                        <h3 class="stats-card__value">{{ $totalCompleted ?? 5 }}</h3>
                        <p class="stats-card__label">منتهية</p>
                    </div>
                </div>
            </div>
            <div class="col-md-4">
                <div class="stats-card">
                    <div class="stats-card__icon bg-warning bg-gradient">
                        <i class="fas fa-clock" aria-hidden="true"></i>
                    </div>
                    <div class="stats-card__body">
                        <h3 class="stats-card__value">{{ $readingStats['total_days'] ?? 28 }}</h3>
                        <p class="stats-card__label">أيام القراءة هذا الأسبوع</p>
                    </div>
                </div>
            </div>
        </div>

        <div class="card mb-4">
            <div class="card-header">
                <h5 class="mb-0"><i class="fas fa-chart-bar me-2" aria-hidden="true"></i> نشاط القراءة الأسبوعي</h5>
            </div>
            <div class="card-body">
                <canvas id="readingChart" height="200"></canvas>
            </div>
        </div>

        <div class="row g-4">
            <div class="col-lg-6">
                <div class="card">
                    <div class="card-header">
                        <h5 class="mb-0"><i class="fas fa-book me-2" aria-hidden="true"></i> آخر ما قرأته</h5>
                    </div>
                    <div class="card-body">
                        @if($recentBooks->count() > 0)
                        <div class="recent-books">
                            @foreach($recentBooks as $book)
                            <div class="recent-book-item d-flex gap-3 mb-3">
                                <div class="book-cover">
                                    <i class="fas fa-book" aria-hidden="true"></i>
                                </div>
                                <div class="book-info flex-grow-1">
                                    <h6 class="mb-1">{{ $book->name }}</h6>
                                    <p class="text-muted small mb-1">{{ \Illuminate\Support\Str::limit($book->description, 80) }}</p>
                                    <small class="text-muted">الصفحات: {{ $book->progress }}%</small>
                                </div>
                                <a href="{{ url('/read/' . $book->slug) }}" class="btn btn-sm btn-outline-primary">
                                    <i class="fas fa-book-reader" aria-hidden="true"></i>
                                </a>
                            </div>
                            @endforeach
                        </div>
                        @else
                        <p class="text-muted">لا توجد كتب مقروءة مؤخراً</p>
                        @endif
                    </div>
                </div>
            </div>
            <div class="col-lg-6">
                <div class="card">
                    <div class="card-header">
                        <h5 class="mb-0"><i class="fas fa-star me-2" aria-hidden="true"></i> كتب مفضلة</h5>
                    </div>
                    <div class="card-body">
                        @if($favoriteBooks->count() > 0)
                        <div class="favorites-grid">
                            @foreach($favoriteBooks as $book)
                            <div class="favorite-item d-flex gap-2 mb-3">
                                <div class="book-small">
                                    <i class="fas fa-book" aria-hidden="true"></i>
                                </div>
                                <div class="book-info flex-grow-1">
                                    <h6 class="mb-0">{{ $book->name }}</h6>
                                    <small class="text-muted">{{ $book->location }}</small>
                                </div>
                            </div>
                            @endforeach
                        </div>
                        @else
                        <p class="text-muted">لا توجد كتب مفضلة</p>
                        @endif
                    </div>
                </div>
            </div>
        </div>

        <div class="text-center mt-4">
            <a href="{{ route('homePage') }}" class="home-btn"><span>العودة للصفحة الرئيسية</span> <i class="fas fa-arrow-left" aria-hidden="true"></i></a>
        </div>
    </div>
</div>

@endsection

@push('scripts')
<script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
<script>
document.addEventListener('DOMContentLoaded', function() {
    const ctx = document.getElementById('readingChart').getContext('2d');
    new Chart(ctx, {
        type: 'line',
        data: {
            labels: {{-- json_encode($readingChart['labels']) --}},
            datasets: [{
                label: 'صفحات اليوم',
                data: {{-- json_encode($readingChart['data']) --}},
                borderColor: '#6c6cef',
                backgroundColor: 'rgba(108, 108, 239, 0.1)',
                fill: true,
                tension: 0.4
            }]
        },
        options: {
            responsive: true,
            plugins: {
                legend: { display: false }
            },
            scales: {
                y: {
                    beginAtZero: true,
                    grid: { color: 'rgba(0,0,0,0.05)' }
                }
            }
        }
    });
});
</script>
@endpush
@endsection