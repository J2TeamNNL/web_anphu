@props([
    'congTrinhArticles' => [],
    'camNhanArticles' => [],
    'showCategory' => true,
    'showDate' => true,
    'cardClass' => 'card-blog'
])

<div class="service-extra">
    <h5>Xem thêm</h5>
    
    @if(count($congTrinhArticles) > 0)
        <h6 class="mb-3">Dự án thi công</h6>
        <hr class="border-warning">
        @foreach ($congTrinhArticles as $article)
            <div class="col-md-12 mb-4 blog-item">
                <a href="{{ route('customers.blog.detail', $article->slug) }}" class="text-decoration-none">
                    <div class="card {{ $cardClass }}"
                        style="background-image: url('{{ $article->thumbnail }}'); background-size: cover; background-position: center;">
                        <div class="blog-overlay p-3">
                            <h5 class="font-weight-bold">{{ $article->name }}</h5>

                            @if ($showCategory && !empty($article->category))
                                <p class="mb-0 font-weight-bold">Chủ đề: {{ $article->category->name }}</p>
                            @endif

                            @if ($showDate && !empty($article->created_at))
                                <p class="mb-0 font-weight-bold small">
                                    Đăng ngày {{ $article->created_at->format('d/m/Y') }}
                                </p>
                            @endif
                        </div>
                    </div>
                </a>
            </div>
        @endforeach
    @endif

    @if(count($camNhanArticles) > 0)
        <h6 class="mb-3">Cảm nhận khách hàng</h6>
        <hr class="border-warning">
        @foreach ($camNhanArticles as $article)
            <div class="col-md-12 mb-4 blog-item">
                <a href="{{ route('customers.blog.detail', $article->slug) }}" class="text-decoration-none">
                    <div class="card {{ $cardClass }}"
                        style="background-image: url('{{ $article->thumbnail }}'); background-size: cover; background-position: center;">
                        <div class="blog-overlay p-3">
                            <h5 class="font-weight-bold">{{ $article->name }}</h5>

                            @if ($showCategory && !empty($article->category))
                                <p class="mb-0 font-weight-bold">Chủ đề: {{ $article->category->name }}</p>
                            @endif

                            @if ($showDate && !empty($article->created_at))
                                <p class="mb-0 font-weight-bold small">
                                    Đăng ngày {{ $article->created_at->format('d/m/Y') }}
                                </p>
                            @endif
                        </div>
                    </div>
                </a>
            </div>
        @endforeach
    @endif
</div>
