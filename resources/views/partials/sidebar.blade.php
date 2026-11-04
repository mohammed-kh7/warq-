@php
$activeSection = request()->segment(2) ?? 'overview';
$sidebarItems = [
    ['name' => 'نظرة عامة', 'route' => 'homePage', 'icon' => 'fa-chart-line', 'section' => 'overview'],
    ['name' => 'مكتبتي', 'route' => 'myLibrary.index', 'icon' => 'fa-book-reader', 'section' => 'myLibrary'],
    ['name' => 'المفضلة', 'route' => 'favorites.index', 'icon' => 'fa-heart', 'section' => 'favorites'],
    ['name' => 'نشر كتاب', 'route' => 'products.create', 'icon' => 'fa-book-plus', 'section' => 'publish'],
    ['name' => 'تبرع بكتاب', 'route' => 'products.create', 'icon' => 'fa-gift', 'section' => 'donate'],
    ['name' => 'طلبات عاجلة', 'route' => 'emergancyRequest.index', 'icon' => 'fa-exclamation-triangle', 'section' => 'urgent'],
    ['name' => 'حسابي', 'route' => 'profile.show', 'icon' => 'fa-user-circle', 'section' => 'account'],
];
@endphp

<div class="sidebar">
    <nav class="sidebar-nav">
        <ul class="sidebar-nav__list">
            @foreach($sidebarItems as $item)
            <li class="sidebar-nav__item">
                <a href="{{ route($item['route']) }}" class="sidebar-nav__link {{ request()->route()->getName() === $item['route'] ? 'active' : '' }}">
                    <i class="{{ $item['icon'] }} sidebar-nav__icon" aria-hidden="true"></i>
                    <span class="sidebar-nav__text">{{ $item['name'] }}</span>
                </a>
            </li>
            @endforeach
        </ul>
    </nav>
</div>

<style>
.sidebar {
    position: fixed;
    top: 100px;
    right: 20px;
    width: 280px;
    background: white;
    border-radius: 16px;
    box-shadow: 0 4px 20px rgba(0,0,0,0.08);
    padding: 20px 0;
    max-height: calc(100vh - 120px);
    overflow-y: auto;
    z-index: 1000;
}

.sidebar-nav__list {
    list-style: none;
    padding: 0;
    margin: 0;
}

.sidebar-nav__item {
    margin: 0;
}

.sidebar-nav__link {
    display: flex;
    align-items: center;
    padding: 12px 20px;
    color: #495057;
    text-decoration: none;
    transition: all 0.2s ease;
    border-radius: 0 12px 12px 0;
    margin-right: 16px;
}

.sidebar-nav__link:hover {
    background: #f8f9fa;
    color: #6c6cef;
}

.sidebar-nav__link.active {
    background: #6c6cef;
    color: white;
}

.sidebar-nav__icon {
    width: 24px;
    text-align: center;
    margin-left: 12px;
}
</style>