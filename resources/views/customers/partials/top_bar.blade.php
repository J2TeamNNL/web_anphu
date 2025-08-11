<!-- Top bar -->
<div class="top-bar py-2">
    <div class="container">
        <div class="row text-center text-md-left align-items-center justify-content-between">
            <!-- Logo -->
            <div class="col-12 col-md-2 d-flex flex-column align-items-center justify-content-center mb-3 mb-md-0 border-divider">
                <a href="{{ route('customers.index')}}" class="logo-link">
                    <img
                        class="anphu-logo"
                        src="{{ asset(config('company.assets.logo.main')) }}"
                        alt="{{ config('company.name.brand') }} Logo"
                    >
                </a>
            </div>

            <!-- Điện thoại & Email -->
            <div class="col-12 col-md-4 d-flex flex-column align-items-left justify-content-center mb-3 mb-md-0 border-divider">
                <div>
                    <a href="{{ config('company.contact.phone_link_1') }}">
                        <i class="fa fa-phone-alt mr-1"></i>
                        Zalo:
                        {{ config('company.contact.phone_1') }}
                    </a>
                </div>
                <div>
                    <a href="{{ config('company.contact.phone_link_2') }}">
                        <i class="fa fa-phone-alt mr-1"></i>
                        Hotline:
                        {{ config('company.contact.phone_2') }}
                    </a>
                </div>
                <div>
                    <a href="{{ config('company.contact.email_link') }}">
                        <i class="fa fa-envelope mr-1"></i>
                        {{ config('company.contact.email') }}
                    </a>
                </div>
                <div>
                    <i class="fa fa-clock mr-1"></i>
                    {{ config('company.working_hours.text') }}
                </div>
            </div>

            <!-- Địa chỉ -->
            <div class="col-12 col-md-4 d-flex flex-column align-items-center justify-content-center mb-3 mb-md-0 border-divider">
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
            <div class="col-12 col-md-2 d-flex flex-column align-items-center justify-content-center">
                <x-social-media 
                    size="small" 
                    style="minimal" 
                    class="d-flex justify-content-center" 
                />
            </div>
        </div>
    </div>
</div>