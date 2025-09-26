@php
use App\Models\AboutPage;

$pages = AboutPage::get();
@endphp
<section class="py-5" style="
    background-color: #0b1c2c;
    background-image: linear-gradient(rgba(11, 28, 44, 0.6), rgba(11, 28, 44, 0.6)),
        url('/assets/img/gallery/background_danmask_1.jpg');
    background-size: cover;
    background-position: center;
    background-repeat: no-repeat;
    border-bottom: 3px solid var(--color-secondary);
">
    <div class="container">
        <div class="row">
            <div class="col-12">
                <div class="mb-4 text-center">
                    <p class="text-uppercase font-weight-bold mb-2 text-warning" style="font-size: 1.2rem;">Giới thiệu về An Phú</p>
                </div>
            </div>
        </div>
        
        <div class="row">
            <!-- Tab Headers - Vertical Left Side -->
            <div class="col-lg-4 col-md-4">
                <div class="about-tab-headers">
                    @foreach($pages as $page)
                    <div class="about-tab-header {{ $loop->first ? 'active' : '' }}" data-tab="tab-{{ $page->slug }}">
                        <div class="tab-header-content">
                            <h5 class="tab-title">{{ $page->title }}</h5>
                            <div class="tab-indicator">
                                <i class="fas fa-chevron-right"></i>
                            </div>
                        </div>
                    </div>
                    @endforeach
                </div>
            </div>
            
            <!-- Tab Content - Right Side -->
            <div class="col-lg-8 col-md-8">
                <div class="about-tab-content-wrapper">
                    @foreach($pages as $page)
                    <div class="about-tab-content {{ $loop->first ? 'active' : '' }}" id="tab-{{ $page->slug }}">
                        <div class="content-card">
                            <div class="content-body">
                                <h2 class="h5 h4-md h3-lg mb-3 text-center text-warning">
                                    {{ $page->title }}
                                </h2>
                                <div class="hero-content mb-3">
                                    {!! $page->description !!}
                                </div>
                            </div>
                            <div class="content-footer mt-4">
                                <a href="{{ route('customers.about.detail', $page->slug) }}" class="btn btn-detail">
                                    <i class="fas fa-info-circle me-2"></i>
                                    Xem chi tiết
                                </a>
                            </div>
                        </div>
                    </div>
                    @endforeach
                </div>
            </div>
        </div>
    </div>
</section>

@push('styles')
<style>
/* About Tabs Styles - AnPhu Theme */
.about-tab-headers {
    display: flex;
    flex-direction: column;
    gap: 15px;
}

.about-tab-header {
    background: linear-gradient(135deg, #0d2135, #142d4c);
    border: 2px solid #d6b162;
    border-radius: 12px;
    padding: 20px;
    cursor: pointer;
    transition: all 0.3s ease;
    position: relative;
    overflow: hidden;
    color: #fff;
}

.about-tab-header:hover {
    background: linear-gradient(135deg, #142d4c, #1a3a5c);
    transform: translateX(5px);
    border-color: var(--color-secondary);
    box-shadow: 0 4px 15px rgba(214, 177, 98, 0.3);
}

.about-tab-header.active {
    background: linear-gradient(135deg, #d6b162, var(--color-secondary));
    border-color: #d6b162;
    transform: translateX(8px);
    color: #070f47;
    box-shadow: 0 6px 20px rgba(214, 177, 98, 0.4);
}

.about-tab-header.active::before {
    content: '';
    position: absolute;
    left: 0;
    top: 0;
    height: 100%;
    width: 4px;
    background: #070f47;
}

.tab-header-content {
    display: flex;
    justify-content: space-between;
    align-items: center;
}

.tab-title {
    margin: 0;
    font-weight: 600;
    font-size: 1.1rem;
    color: inherit;
}

.tab-indicator {
    transition: all 0.3s ease;
    color: inherit;
}

.about-tab-header.active .tab-indicator {
    transform: translateX(3px);
}

.about-tab-content-wrapper {
    position: relative;
    min-height: 400px;
}

.about-tab-content {
    display: none;
    animation: fadeInUp 0.5s ease;
}

.about-tab-content.active {
    display: block;
}

.content-card {
    background: linear-gradient(135deg, #0d2135, #142d4c);
    padding: 30px;
    box-shadow: 0 10px 30px rgba(0, 0, 0, 0.3);
    color: #fff;
    position: relative;
}

.content-card::before {
    content: '';
    position: absolute;
    top: 0;
    left: 0;
    right: 0;
    height: 3px;
    background: linear-gradient(90deg, #d6b162, var(--color-secondary), #d6b162);
    border-radius: 15px 15px 0 0;
}

.content-body {
    line-height: 1.7;
    font-size: 1rem;
    color: #f8f9fa;
}

.content-body h1, .content-body h2, .content-body h3, .content-body h4, .content-body h5, .content-body h6 {
    color: var(--color-secondary);
    margin-bottom: 15px;
    font-weight: bold;
}

.content-body ul {
    padding-left: 1.5rem;
    list-style-type: disc;
}

.content-body li {
    margin-bottom: 8px;
    color: #f8f9fa;
}

.content-body p {
    color: #f8f9fa;
}

.hero-content ul {
    padding-left: 1.2rem;
    list-style-type: disc;
    color: #f8f9fa;
}

.hero-content li {
    margin-bottom: 0.5rem;
    color: #f8f9fa;
}

.content-footer {
    border-top: 1px solid rgba(214, 177, 98, 0.3);
    padding-top: 20px;
}

.btn-detail {
    background: transparent;
    color: var(--color-secondary);
    border: 2px solid var(--color-secondary);
    padding: 12px 25px;
    border-radius: 25px;
    font-weight: 600;
    transition: all 0.3s ease;
    text-decoration: none;
    display: inline-block;
}

.btn-detail:hover {
    background: var(--color-secondary);
    color: #070f47;
    transform: translateY(-2px);
    box-shadow: 0 6px 20px rgba(201, 176, 55, 0.4);
    text-decoration: none;
}

@keyframes fadeInUp {
    from {
        opacity: 0;
        transform: translateY(20px);
    }
    to {
        opacity: 1;
        transform: translateY(0);
    }
}

/* Responsive Design */
@media (max-width: 768px) {
    .about-tab-headers {
        flex-direction: row;
        overflow-x: auto;
        padding-bottom: 10px;
        margin-bottom: 20px;
    }
    
    .about-tab-header {
        min-width: 200px;
        flex-shrink: 0;
    }
    
    .about-tab-header:hover,
    .about-tab-header.active {
        transform: translateY(-3px);
    }
    
    .content-card {
        padding: 20px;
    }
}
</style>
@endpush

@push('scripts')
<script>
document.addEventListener('DOMContentLoaded', function() {
    // Tab switching functionality
    const tabHeaders = document.querySelectorAll('.about-tab-header');
    const tabContents = document.querySelectorAll('.about-tab-content');
    
    tabHeaders.forEach(header => {
        header.addEventListener('click', function() {
            const targetTab = this.getAttribute('data-tab');
            
            // Remove active class from all headers and contents
            tabHeaders.forEach(h => h.classList.remove('active'));
            tabContents.forEach(c => c.classList.remove('active'));
            
            // Add active class to clicked header and corresponding content
            this.classList.add('active');
            document.getElementById(targetTab).classList.add('active');
        });
    });
});
</script>
@endpush
