@extends('customers.layouts.master')

@push('styles')
<style>
    .voucher-section-bg {
        background-color: #0b1c2c; /* fallback */
        background-image:
            linear-gradient(rgba(11, 28, 44, 0.6), rgba(11, 28, 44, 0.6)),
            url('/assets/img/gallery/background_danmask_1.jpg');
        background-position: center;
        background-repeat: repeat;
        background-size: auto;
        background-attachment: fixed; /* parallax */
        position: relative;
        border-bottom: 3px solid var(--anphu-gold);
    }

    .heading-voucher {
        text-align: center;
        font-weight: 700;
        font-family: 'Poppins', sans-serif;
        text-transform: uppercase;
        letter-spacing: 1.5px;
        background: linear-gradient(90deg, #d6aa3a, #d4a537);
        -webkit-background-clip: text;
        -webkit-text-fill-color: transparent;
        color: transparent;
    }

    .voucher-content {
        background-color: var(--navy-dark);
        color: white;
        padding: 2rem;
        text-align: center;
    }


    
</style>

@endpush

@section('content')

    <section class="py-5 voucher-section-bg">
        <div class="container">
            <div class="row">

                {{-- SƠ LƯỢC --}}
                <div class="col-md-12 voucher-content" data-aos="fade-right">
                    <h1 class="heading-voucher">Nhận ưu đãi và tư vấn</h1>
                    <hr class="border-warning">

                    <h1 class="heading-voucher">Cam kết của chúng tôi</h1>
                    <hr class="border-warning">

                    <h1 class="heading-voucher">Câu hỏi thường gặp</h1>
                </div>
                

                
            </div>
        </div>
    </section>

    
    @include('customers.partials.sign_up_1')

    @include('customers.partials.anphu.demo_projects')
    
    @include('customers.partials.anphu.partner')
@endsection

