@extends('customers.layouts.master')

@push('styles')
<style>


</style>
@endpush

@section('content')
    {{-- Slide Carousel Component --}}
    <x-slide-carousel/>

    {{-- Hero Tabs Component --}}
    <x-about-tabs />

    @include('customers.partials.anphu.solution')

    @include('customers.partials.form_signup_with_info')

    @include('customers.partials.anphu.partner')
@endsection


