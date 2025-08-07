@push('styles')
<style>
  .logo-marquee {
    overflow: hidden;
    white-space: nowrap;
    width: 100%;
    border-top: 1px solid #ddd;
    border-bottom: 1px solid #ddd;
    background: #fff;
    position: relative;
  }

  .logo-track {
    display: flex;
    align-items: center;
    gap: 40px; /* khoảng cách giữa các logo */
    animation: scroll-left 20s linear infinite;
    width: max-content;
  }

  .logo-item img {
    height: 120px;
    object-fit: contain;
    filter: grayscale(20%);
    transition: filter 0.3s ease;
  }

  .logo-item img:hover {
    filter: grayscale(0%);
  }

  @keyframes scroll-left {
    0% {
      transform: translateX(0%);
    }
    100% {
      transform: translateX(-50%);
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
      <div class="logo-track">
        @foreach($partners as $partner)
          <div class="logo-item">
            <img 
              src="{{ $partner->logo }}"
              alt="{{ $partner->name ?? 'Partner logo' }}"
              class="img-fluid"
            >
          </div>
        @endforeach

        {{-- Duplicate logos for seamless infinite loop --}}
        @foreach($partners as $partner)
          <div class="logo-item">
            <img 
              src="{{ $partner->logo }}"
              alt="{{ $partner->name ?? 'Partner logo' }}"
              class="img-fluid"
            >
          </div>
        @endforeach
      </div>
    </div>
  </div>
</section>
