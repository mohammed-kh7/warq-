@extends('layouts.app')
@section( 'title', 'نتائج البحث ')

@section('content')

<form action="/searchProducts" method="get">
    <div class="search-bar">
        <input type="text" name="search" value="{{Request::get('search') }}" placeholder="ابحث هنا...">
        <i class="fas fa-search"></i>
    </div>
</form>

<div class="container my_products">
    <h2> نتائج البحث عن "{{Request::get('search') }}" في الكتب <i class="fas fa-book"></i> </h2>
    @if($products->isEmpty())
    <h3 class="text-center"><strong> لا يوجد نتائج </strong></h3>
    @else
    <div class="row">
        @foreach($products as $product)
        <div class="col-md-3 mb-4">
            <div class="card">
                @if($product->image_path)
                <img src="{{ asset('images/' . $product->image_path) }}" class="card-img-top" alt="{{ $product->name }}">
                @else
                <img src="https://via.placeholder.com/300" class="card-img-top" alt="صورة افتراضية">
                @endif
                <div class="card-body text-center">
                    <h5 class="card-title">اسم الكتاب: {{$product->name}} </h5>
                    <p> وصف الكتاب: {{$product->description}}.</p>
                    <a href="/products/{{$product->slug}}"><button class="btn btn-primary">عرض التفاصيل</button></a>
                </div>
            </div>
        </div>
        @endforeach
    </div>
</div>
@endif
</div>

<div class="container my_request">
    <h2 class="text-danger"> نتائج البحث عن "{{Request::get('search') }}" في الطلبات العاجلة <i class="fas fa-exclamation-triangle"></i> </h2>
    @if($emergencyRequest->isEmpty())
    <h3 class="text-center"><strong> لا يوجد نتائج </strong></h3>
    @else
    <div>
        <div class="row">
            @foreach ($emergencyRequest as $request )
            <div class="col-md-3 mb-4">
                <div class="card">
                    <div class="urgent-appeal-card__media">
                        @include('partials.urgent-request-visual')
                    </div>
                    <div class="card-body text-center">
                        <h5 class="card-title">{{ \Illuminate\Support\Str::limit($request->description, 65) }}</h5>
                        <p class="small text-muted">عرض التفاصيل</p>
                        <a href="/emergancyRequest/{{$request->id}}"><button type="button" class="btn urgent-card-cta">عرض التفاصيل</button></a>
                    </div>
                </div>
            </div>
            @endforeach
        </div>
    </div>
    @endif
</div>
<!-- زر العودة للصفحة الرئيسية -->
<div class=" home-container">
                                <a href="{{ route('homePage') }}" class="btn home-btn">
                                    العودة للصفحة الرئيسية <i class="fas fa-arrow-left"></i> </a>
                    </div>

                    @endsection
