<!-- Top bar -->
<div class="top-bar py-2">
    <div class="container">
        <div class="row text-center text-md-left align-items-center justify-content-between">
            <!-- Logo -->
            <div class="col-12 col-md-3 d-flex flex-column align-items-center justify-content-center mb-3 mb-md-0 border-divider">
                <a href="{{ route('customers.index')}}" class="logo-link">
                    <img
                        class="anphu-logo"
                        src="{{ asset(config('company.assets.logo.main')) }}"
                        alt="{{ config('company.name.brand') }} Logo"
                        style="max-height: 80px;"
                    >
                </a>
            </div>

            <!-- Điện thoại & Email -->
            <div class="col-12 col-md-3 d-flex flex-column align-items-left justify-content-center mb-3 mb-md-0 border-divider">
                <div>
                    <i class="fa fa-phone-alt mr-1"></i>
                    Zalo:
                    {{ config('company.contact.phone_1') }}
                </div>
                <div>
                    <i class="fa fa-phone-alt mr-1"></i>
                    Hotline:
                    {{ config('company.contact.phone_2') }}
                </div>
                <div>
                    <i class="fa fa-envelope mr-1"></i>
                    {{ config('company.contact.email') }}
                </div>
                <div>
                    <i class="fa fa-clock mr-1"></i>

                    {{ config('company.working_hours.text') }}
                </div>
            </div>

            <!-- Địa chỉ -->
            <div class="col-12 col-md-3 d-flex flex-column align-items-center justify-content-center mb-3 mb-md-0 border-divider">
                <div>
                    <i class="fa fa-home mr-1"></i>
                    <span style="font-weight: bold">
                        Địa chỉ VPGD 1:
                    </span>
                    <br>{{ config('company.contact.address_1') }}
                </div>
                <div>
                    <i class="fa fa-home mr-1"></i>
                    <span style="font-weight: bold">
                        Địa chỉ VPGD 2:
                    </span>
                    <br>{{ config('company.contact.address_2') }}
                </div>
            </div>

            <!-- Social Links -->
            <div class="col-12 col-md-3 d-flex flex-column align-items-center justify-content-center border-divider">
                <x-social-media 
                    size="small" 
                    style="minimal" 
                    class="d-flex justify-content-center" 
                />
            </div>
        </div>
    </div>
</div>