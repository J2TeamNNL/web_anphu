@php
use App\Models\Portfolio;
use App\Models\Category;

$categories = Category::query()
    ->where(function ($query) {
        $query->orWhere('slug', 'xay-nha-tron-goi');
        $query->orWhere('slug', 'cai-tao-nha-cu');
    })
    ->get();
$categoriesIds = $categories->flatMap(fn($cat) => $cat->getAllRelatedIds())->unique()->toArray();
$duAnXayDungVaCaiTao = Portfolio::query()
    ->with('category')
    ->whereIn('category_id', $categoriesIds)
    ->latest()
    ->limit(3)
    ->get();

$categories = Category::query()
    ->where(function ($query) {
        $query->orWhere('slug', 'thiet-ke-kien-truc');
        $query->orWhere('slug', 'thiet-ke-noi-that');
    })
    ->get();
$categoriesIds = $categories->flatMap(fn($cat) => $cat->getAllRelatedIds())->unique()->toArray();
$duAnThietKeKienTrucVaNoiThat = Portfolio::query()
    ->with('category')
    ->whereIn('category_id', $categoriesIds)
    ->latest()
    ->limit(3)
    ->get();
@endphp

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

    {{-- PROJECT GRID COMPONENT --}}
    <section class="bg-white py-5 section-bg-project">
        <div class="container-fluid px-5">

            <div class="text-center mb-4 project-luxury-gold">
                <h4 class="text-uppercase font-weight-bold" id="project-title">Dự án xây dựng và cải tạo</h4>
                <hr class="border-warning">
            </div>

            <!-- PROJECT GRID COMPONENT -->
            <x-project-grid :portfolios="$duAnXayDungVaCaiTao" />
        </div>
    </section>

    <section class="bg-white py-5 section-bg-project">
        <div class="container-fluid px-5">

            <div class="text-center mb-4 project-luxury-gold">
                <h4 class="text-uppercase font-weight-bold" id="project-title">Dự án thiết kế kiến trúc và nội thất</h4>
                <hr class="border-warning">
            </div>

            <!-- PROJECT GRID COMPONENT -->
            <x-project-grid :portfolios="$duAnThietKeKienTrucVaNoiThat" />
        </div>
    </section>

    @include('customers.partials.anphu.solution')

    @include('customers.partials.form_signup_with_info')

    @include('customers.partials.anphu.partner')
@endsection


