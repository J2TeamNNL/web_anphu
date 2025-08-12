<!-- Top bar -->
<div class="top-bar py-2">
    <div class="container">
        <div class="row align-items-center">
            <!-- Logo -->
            <div class="col-12 col-md-6 mb-3 mb-md-0 text-center">
                <a href="{{ route('customers.index')}}" class="logo-link d-inline-block">
                    <img
                        class="anphu-logo"
                        src="{{ asset(config('company.assets.logo.main')) }}"
                        alt="{{ config('company.name.brand') }} Logo"
                        height="50px"
                    >
                </a>
            </div>

            <!-- MXH -->
            <div class="col-12 col-md-6 text-center">
                <div class="d-flex justify-content-center">
                    <x-social-media 
                        size="medium" 
                        style="default" 
                        class="d-flex" 
                    />
                </div>
            </div>
        </div>
    </div>
</div>