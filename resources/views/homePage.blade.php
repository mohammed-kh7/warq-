@extends('layouts.app')
@section('title', 'الصفحة الرئيسية')

@section('content')
<div class="main-content">
    <section class="about-app-section" id="about">
        <div class="auto-container">
            <div class="row clearfix align-items-center gy-4">
                <div class="title-column col-lg-6 col-md-12 col-sm-12 wow fadeInRight">
                    <div class="inner-column wow fadeInLeft animated" style="visibility: visible; animation-name: fadeInLeft;">
                        <div class="sec-title-two">
                            <div class="title">عن المنصة</div>
                            <h2>منصة {{ config('app.name') }}</h2>
                            <div class="text">
                                منصة مجتمعية تهدف إلى تعزيز الثقافة ونشر المعرفة بين القراء من خلال تسهيل تبادل وبيع الكتب بمختلف أنواعها، سواء كانت أدبية، علمية، أو أكاديمية. كما توفر المنصة مساحة مخصصة للنداءات العاجلة، مثل طلب المراجع الدراسية أو الكتب النادرة التي يحتاجها الطلاب والباحثون بشكل طارئ، مما يساعد الأفراد الذين يواجهون صعوبة في العثور على مصادرهم العلمية.
                                <br><br>
                                من خلال هذه المبادرة، نسعى إلى بناء شبكة من التضامن المعرفي، حيث يمكن للأفراد عرض كتبهم للبيع أو المقايضة بسهولة، مع ضمان وصول الكتاب للشخص المناسب في الوقت المناسب. كما يهدف المشروع إلى تعزيز القراءة الجماعية وزيادة الوعي بأهمية تدوير المعرفة في المجتمع المحلي لتحقيق الاستدامة الثقافية والتعليمية.
                                <br><br>
                                انضموا إلينا اليوم وكونوا جزءًا من هذا المشروع الحيوي لدعم القراء وإحداث تغيير حقيقي في رحلة التعلم للآخرين.
                                <i class="fas fa-star text-warning animate-icon"></i>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="image-column col-lg-6 col-md-12 col-sm-12 wow fadeInLeft">
                    <div class="inner-column about-platform-visual">
                        <figure class="about-platform-visual__frame">
                            <img src="{{ asset('images/about-platform-desk.png') }}" class="about-platform-visual__img" alt="مشهد مكتب منظم مع كتب ولابتوب يعكس طابع المنصة الثقافي" loading="lazy" decoding="async">
                        </figure>
                    </div>
                </div>
            </div>
        </div>
    </section>

    @if(Auth::check())
    <section class="home-cta container my-5 px-3" aria-labelledby="home-cta-heading">
        <div class="home-cta__shell">
            <header class="home-cta__header text-center">
                <p class="home-cta__eyebrow">شارك أو اطلب الدعم</p>
                <h2 id="home-cta-heading" class="home-cta__title">هل لديك كتاب لمشاركته؟ أو بحاجة لمساعدة عاجلة؟</h2>
                <p class="home-cta__lead">ساهم في دعم مجتمعك: أضف كتابًا ليستفيد الآخرون، أو قدّم طلبًا عاجلًا عند الحاجة. الخيارات أمامك.</p>
            </header>
            <div class="row g-4 home-cta__grid align-items-stretch justify-content-center">
                <div class="col-lg-5 col-md-6">
                    <article class="home-cta-card home-cta-card--resources">
                        <div class="home-cta-card__accent" aria-hidden="true"></div>
                        <div class="home-cta-card__icon-wrap">
                            <span class="home-cta-card__icon" aria-hidden="true"><i class="fas fa-book-open"></i></span>
                        </div>
                        <h3 class="home-cta-card__heading">إضافة كتاب</h3>
                        <p class="home-cta-card__text home-cta-card__text--compact">شارك كتبك المتاحة ووصّلها لمن يحتاجها.</p>
                        <a href="{{ url('/products/create') }}" class="home-cta-card__btn home-cta-card__btn--teal">
                            <span>أضف كتابًا الآن</span>
                            <i class="fas fa-arrow-left" aria-hidden="true"></i>
                        </a>
                    </article>
                </div>
                <div class="col-lg-1 d-none d-lg-flex align-items-stretch justify-content-center py-lg-4">
                    <div class="home-cta__divider" role="presentation">
                        <span class="home-cta__or">أو</span>
                    </div>
                </div>
                <div class="col-lg-5 col-md-6">
                    <article class="home-cta-card home-cta-card--urgent">
                        <div class="home-cta-card__accent" aria-hidden="true"></div>
                        <div class="home-cta-card__icon-wrap">
                            <span class="home-cta-card__icon" aria-hidden="true"><i class="fas fa-bolt"></i></span>
                        </div>
                        <h3 class="home-cta-card__heading">نداء أو طلب عاجل</h3>
                        <p class="home-cta-card__text home-cta-card__text--compact">عند الضرورة، اطلب المساعدة من المجتمع دون تردد.</p>
                        <a href="{{ url('/emergancyRequest/create') }}" class="home-cta-card__btn home-cta-card__btn--urgent">
                            <span>أضف طلبك الطارئ</span>
                            <i class="fas fa-arrow-left" aria-hidden="true"></i>
                        </a>
                    </article>
                </div>
            </div>
        </div>
    </section>
    @endif

    <form action="{{ url('/searchProducts') }}" method="get">
        <div class="search-bar">
            <input type="text" name="search" value="{{ request('search') }}" placeholder="ابحث هنا...">
            <i class="fas fa-search"></i>
        </div>
    </form>

    <div class="container Resources_addition latest-resources-block px-3" id="latest-resources">
        <div class="latest-resources-block__inner">
            <header class="latest-resources-block__head">
                <p class="latest-resources-block__eyebrow"><i class="fas fa-wand-magic-sparkles ms-1" aria-hidden="true"></i> جديد على المنصة</p>
                <h2>الكتب المضافة حديثًا!</h2>
                <p class="latest-resources-block__sub">آخر ما شاركه الأعضاء من كتب ومراجع—تصفّح سريعًا أو انتقل إلى جميع الكتب.</p>
            </header>
            <div class="row g-4 latest-resources-block__grid">
            @forelse($latestProducts as $product)
            <div class="col-md-4">
                <div class="card text-center latest-resource-card">
                    <img src="{{ asset('images/' . $product->image_path) }}" class="card-img-top mx-auto" alt="كتاب">
                    <div class="card-body">
                        <h5 class="card-title">اسم الكتاب: {{ $product->name }}</h5>
                        <p class="card-text">وصف الكتاب: {{ $product->description }}</p>
                        <a href="{{ url('/products/' . $product->slug) }}" class="btn btn-primary">عرض التفاصيل</a>
                    </div>
                </div>
            </div>
            @empty
            <div class="col-12">
                <div class="latest-resources-empty">
                    <div class="latest-resources-empty__icon" aria-hidden="true"><i class="fas fa-book-open"></i></div>
                    <p class="latest-resources-empty__title">لا توجد كتب مضافة حديثًا بعد</p>
                    <p class="latest-resources-empty__text">عندما يضيف الأعضاء كتبًا ومراجع ستظهر هنا. يمكنك تصفح كل الكتب من الزر أدناه.</p>
                </div>
            </div>
            @endforelse
            </div>
            <div class="text-center latest-resources-block__actions">
                <a href="{{ url('/products') }}" class="custom-btn resources-btn latest-resources-block__cta">عرض جميع الكتب</a>
            </div>
        </div>
    </div>

    <div class="container urgent-requests Appeals urgent-appeals-block px-3">
        <div class="urgent-appeals-block__inner">
            <header class="urgent-appeals-block__head">
                <p class="urgent-appeals-block__eyebrow"><i class="fas fa-signal ms-1" aria-hidden="true"></i> طلبات بحاجة لمساندة سريعة</p>
                <h2>النداءات العاجلة المضافة حديثًا</h2>
                <p class="urgent-appeals-block__sub">نداءات من الأعضاء لكتب أو مراجع أو دعم عاجل—تصفّح المفتوح أو قدّم يد العون.</p>
            </header>
            <div class="row g-4 urgent-appeals-block__grid">
            @forelse($latestRequests as $request)
            <div class="col-md-4">
                <div class="card text-center shadow urgent-appeal-card">
                    <div class="urgent-appeal-card__media">
                        @include('partials.urgent-request-visual')
                    </div>
                    <div class="card-body">
                        <h5 class="card-title">{{ \Illuminate\Support\Str::limit($request->description, 60) }}</h5>
                        <p class="card-text small text-muted">انقر لعرض التفاصيل والتواصل</p>
                        <a href="{{ url('/emergancyRequest/' . $request->id) }}" class="btn urgent-card-cta">عرض التفاصيل</a>
                    </div>
                </div>
            </div>
            @empty
            <div class="col-12">
                <div class="urgent-appeals-empty">
                    <div class="urgent-appeals-empty__icon" aria-hidden="true"><i class="fas fa-hand-holding-heart"></i></div>
                    <p class="urgent-appeals-empty__title">لا توجد نداءات عاجلة حديثة</p>
                    <p class="urgent-appeals-empty__text">عند نشر طلبات جديدة ستظهر هنا. يمكنك متابعة كل النداءات من الزر أدناه.</p>
                </div>
            </div>
            @endforelse
            </div>
            <div class="text-center urgent-appeals-block__actions">
                <a href="{{ url('/emergancyRequest') }}" class="custom-btn urgent-btn urgent-appeals-block__cta">عرض جميع الطلبات العاجلة</a>
            </div>
        </div>
    </div>

    <section class="container platform-steps-block px-3" aria-labelledby="platform-steps-heading">
        <div class="platform-steps-block__inner">
            <header class="platform-steps-block__head text-center">
                <p class="platform-steps-block__eyebrow">كيف تستفيد من المنصة؟</p>
                <h2 id="platform-steps-heading">ثلاث خطوات بسيطة</h2>
            </header>
            <div class="row g-4 justify-content-center platform-steps-block__grid">
                <div class="col-md-4">
                    <article class="platform-step-card">
                        <div class="platform-step-card__num" aria-hidden="true">١</div>
                        <div class="platform-step-card__icon"><i class="fas fa-user-plus" aria-hidden="true"></i></div>
                        <h3 class="platform-step-card__title">أنشئ حسابك</h3>
                        <p class="platform-step-card__text">سجّل بحسابك لتتمكن من إضافة الكتب والمراجع، التعليق، وتقديم أو متابعة النداءات العاجلة.</p>
                    </article>
                </div>
                <div class="col-md-4">
                    <article class="platform-step-card">
                        <div class="platform-step-card__num" aria-hidden="true">٢</div>
                        <div class="platform-step-card__icon"><i class="fas fa-book" aria-hidden="true"></i></div>
                        <h3 class="platform-step-card__title">شارِك أو تصفّح</h3>
                        <p class="platform-step-card__text">أضف كتابًا أو موردًا، أو ابحث عما يحتاجه مجتمع القرّاء في غزة.</p>
                    </article>
                </div>
                <div class="col-md-4">
                    <article class="platform-step-card">
                        <div class="platform-step-card__num" aria-hidden="true">٣</div>
                        <div class="platform-step-card__icon"><i class="fas fa-hands-helping" aria-hidden="true"></i></div>
                        <h3 class="platform-step-card__title">ساعد أو اطلب</h3>
                        <p class="platform-step-card__text">رُد على نداء عاجل عندما تستطيع، أو انشر طلبك عند الحاجة لمرجع أو كتاب.</p>
                    </article>
                </div>
            </div>
        </div>
    </section>
</div>
@endsection
