<style>
    .thank-you-overlay,
    .error-signup-overlay {
        position: fixed;
        top: 0;
        left: 0;
        width: 100%;
        height: 100%;
        background: rgba(0,0,0,0.6);
        display: flex;
        justify-content: center;
        align-items: center;
        z-index: 1050;
    }

    .thank-you-popup,
    .error-popup {
        background: #fff;
        padding: 2rem;
        border-radius: 12px;
        box-shadow: 0 4px 20px rgba(0,0,0,0.3);
        max-width: 400px;
        width: 90%;
        animation: fadeInScale 0.3s ease;
    }
</style>

<footer class="footer-info pt-5 section-bg-footer">
    <div class="container footer-wrapper">
        <div class="row">
            <div class="col-md-6 mb-4">
                <p><strong>{{ company()->company_name }}</strong></p>
                <p>
                    <i class="fa fa-home mr-1 text-warning"></i>
                    <span style="font-weight: bold" class="text-warning">
                        VPGD 1:
                    </span>
                    {{ company()->company_address_1 ?? ''}}
                </p>

                <p>
                    <i class="fa fa-home mr-1 text-warning"></i>
                    <span style="font-weight: bold" class="text-warning">
                        VPGD 2:
                    </span>
                    {{ company()->company_address_2 ?? ''}}
                </p>

                <p>
                    <i class="fas fa-phone me-2 text-warning"></i>
                    <span style="font-weight: bold" class="text-warning">
                        Zalo:
                    </span>
                    <a href="tel:{{ company()->company_phone_1 ?? ''}}">
                        {{ company()->company_phone_1 ?? ''}}
                    </a>

                </p>

                <p>
                    <i class="fas fa-phone me-2 text-warning"></i>
                    <span style="font-weight: bold" class="text-warning">
                        Hotline:
                    </span>
                    <a href="tel:{{ company()->company_phone_2 ?? ''}}">
                        {{ company()->company_phone_2 ?? ''}}
                    </a>
                </p>

                <p>
                    <i class="fa fa-envelope me-2 text-warning"></i>
                    <span style="font-weight: bold" class="text-warning">
                        Email:
                    </span>
                    <a href="mailto:{{ company()->company_email ?? ''}}">
                        {{ company()->company_email ?? ''}}
                    </a>
                </p>

                <p class="small text-white">
                    Giấy chứng nhận ĐKKD số {{ company()->license_number }} do {{ company()->license_authority }} cấp ngày {{ company()->license_date?->format('d/m/Y') }}
                </p>

                <p>
                    <a href="{{ route('customers.policy.detail')}}" class="text-white">▶ Chính Sách Công Ty</a>
                </p>
                <img src="{{ asset('assets/img/logo/bocongthuong_thongbao.png') }}" alt="Thông báo Bộ Công Thương" style="height: 150px;">
            </div>

            <div class="col-md-6 mb-4">
                <div
                    class="fb-page"
                    data-href="https://www.facebook.com/100054259791134"
                    data-tabs="timeline"
                    data-width="500"
                    data-height="600"
                    data-small-header="false"
                    data-adapt-container-width="true"
                    data-hide-cover="false"
                    data-show-facepile="true"
                >
                    <blockquote
                        cite="https://www.facebook.com/100054259791134"
                        class="fb-xfbml-parse-ignore"
                    >
                        <a href="https://www.facebook.com/100054259791134">An Phú Build</a>
                    </blockquote>
                </div>
            </div>
        </div>
    </div>
    <div class="footer-copyright text-center py-3 mt-4" style="border-top: .5px solid var(--color-secondary)">
        <span style="font-family: 'Great Vibes', cursive">
            © {{ date('Y') }} An Phú Build. All rights reserved.
        </span>
    </div>
</footer>

@once
@endonce
