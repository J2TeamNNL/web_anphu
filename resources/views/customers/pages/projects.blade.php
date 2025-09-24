@extends('customers.layouts.master')


@section('content')
    <section id="project" class="bg-white py-5 section-bg-project">
        <div class="container-fluid px-5">

            <div class="text-center mb-4 project-luxury-gold">
                <h4 class="text-uppercase font-weight-bold" id="project-title">{{ $projectTitle }}</h4>
                <hr class="border-warning">
            </div>

            <!-- FILTER DANH MỤC -->
            @if($parentCategory)
                <div class="text-center mb-4">
                    <a href="{{ route('projects.byCategory', $parentCategory->slug) }}"
                       class="btn btn-sm btn-luxury {{ is_null($selectedChild) ? 'active' : '' }}">
                        Tất cả
                    </a>

                    @foreach($childCategories as $child)
                        <a
                            href="{{ route('projects.byCategory', ['slug' => $parentCategory->slug, 'child' => $child->slug]) }}"
                            class="btn btn-sm btn-luxury {{ ($selectedChild && $selectedChild->id === $child->id) ? 'active' : '' }}">
                            {{ $child->name }}
                        </a>
                    @endforeach
                </div>
            @endif

            <!-- PROJECT GRID COMPONENT -->
            <x-project-grid :portfolios="$portfolios" />
        </div>
    </section>

    @include('customers.partials.form_signup_with_info')
    @include('customers.partials.anphu.partner')
@endsection

