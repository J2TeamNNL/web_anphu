@extends('customers.layouts.master')

@section('index')
    @include('customers.partials.index_header')

    <!-- Section: Lời dẫn đầu -->
    <section class="section-intro bg-light">
        <div class="container">
            <div class="anphu-box">
                <h3><i class="fa fa-question-circle mr-2"></i>Bạn đang có nhu cầu xây nhà trọn gói?</h3>
                <ul>
                    <li><i class="fa fa-check-circle text-success mr-1"></i> Cách tính đơn giá xây nhà trọn gói theo m2?</li>
                    <li><i class="fa fa-check-circle text-success mr-1"></i> Một đơn vị thi công đặt chất lượng lên hàng đầu, có quy trình bài bản?</li>
                    <li><i class="fa fa-check-circle text-success mr-1"></i> <strong>Nhà thầu có kinh nghiệm hơn 10 năm chống thấm, chống nứt?</strong></li>
                    <li><i class="fa fa-check-circle text-success mr-1"></i> Đảm bảo vấn đề bảo hành, bảo trì sau khi thi công?</li>
                    <li><i class="fa fa-check-circle text-success mr-1"></i> Tìm một công ty xây dựng am hiểu về pháp lý có thể giải quyết những vấn đề khó?</li>
                </ul>
                <p class="mt-3 font-italic"><i class="fa fa-lightbulb text-warning mr-1"></i>Tất cả thắc mắc của bạn sẽ được giải quyết bởi An Phú.</p>
            </div>
        </div>
    </section>

    @include('customers.partials.index_nuclear')

    @include('customers.partials.index_intro')

    @include('customers.partials.index_projects')
    
@endsection

