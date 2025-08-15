@extends('customers.layouts.master')

@push('styles')
<style>
    .letter-section-bg {
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

    .heading-letter {
        text-align: left;
        font-weight: 700;
        font-family: 'Poppins', sans-serif;
        text-transform: uppercase;
        letter-spacing: 1.5px;
        background: linear-gradient(90deg, #d6aa3a, #d4a537);
        -webkit-background-clip: text;
        -webkit-text-fill-color: transparent;
        color: transparent;
        text-shadow: 0 0 10px rgba(201,176,55,0.6);
    }

    .letter-content {
        background-color: var(--navy-dark);
        color: white;
        padding: 2rem;
        text-align: left;
    }
</style>

@endpush

@section('content')

    {{-- THƯ NGỎ --}}
    <section class="py-5 letter-section-bg">
        <div class="container">
            <div class="row">
                <div class="col-md-12 letter-content" data-aos="fade-right">
                    <h2 class="heading-letter">{{ $page->title_1 }}</h2>
                    <hr class="border-warning">
                    {!! $page->custom_content_1 !!}
                </div>
            </div>
        </div>
    </section>

    @include('customers.partials.anphu.demo_projects')

    @include('customers.partials.sign_up_1')

    
    @include('customers.partials.anphu.partner')
@endsection

