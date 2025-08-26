@extends('customers.layouts.master')

@push('styles')
<style>
    .text-content ul {
        padding-left: 1.2rem;
        list-style-type: disc;
        color: white;
    }
    .text-content li {
        margin-bottom: 0.5rem;
    }
</style>
@endpush

@section('content')
    <!-- Hero Section -->
    <section class="hero-static-slider d-flex align-items-center justify-content-center py-3 py-md-5" id="hero-static-slider"
        style="background-image: url('{{ asset('assets/img/gallery/background_project_1.jpg') }}'); background-size: cover; background-position: center; min-height: 60vh;">
        <div class="container text-white">
            <div class="row justify-content-center">
                <div class="col-12 col-md-10 col-lg-8 col-xl-6">
                    <div class="slide-content-box p-3 p-md-4 rounded" style="background-color: rgba(0,0,0,0.7);padding-left: 30px; padding-right: 30px;">
                        <div class="text-content">
                            <h2 class="h5 h4-md h3-lg mb-3 text-center text-align-center text-warning">
                                {{ $page->title_1 ?? ''}}
                            </h2>
                            {!! $page->custom_content_1 ?? ''!!}
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>

    @include('customers.partials.anphu.solution')

    @include('customers.partials.anphu.demo_projects')

    @include('customers.partials.sign_up_1')
    
    @include('customers.partials.anphu.partner')
@endsection

