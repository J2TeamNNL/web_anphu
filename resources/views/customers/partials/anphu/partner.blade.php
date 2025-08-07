@push('styles')
<style>
  .logo-marquee {
    overflow: hidden;
    white-space: nowrap;
    width: 100%;
    border-top: 1px solid #ddd;
    border-bottom: 1px solid #ddd;
    background: #fff;
}

.logo-track {
    display: inline-block;
    white-space: nowrap;
    animation: scroll-left 15s linear infinite;
}

.logo-track img {
    height: 150px;
    margin: 0px 40px;
    vertical-align: middle;
}

@keyframes scroll-left {
    from {
        transform: translateX(100%);
    }
    to {
        transform: translateX(-100%);
    }
}

</style>
@endpush

<!-- ĐỐI TÁC TIN CẬY -->
<section class="bg-white py-4 border-top mt-5">
  <div class="container">
    <h5 class="font-weight-bold text-uppercase text-dark mb-4">Đối Tác Tin Cậy</h5>
    <hr class="border-warning">

    <div class="logo-marquee">
      @foreach($partners as $partner)
        <div class="logo-track">
          <img 
            src="{{ $partner->logo }}"
            class="img-fluid" 
            alt="{{ $partner->name ?? 'Partner logo' }}"
          >
        </div>
      @endforeach
    </div>
  </div>
</section>