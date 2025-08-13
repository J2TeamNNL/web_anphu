@push('styles')
<style>
  .logo-marquee {
    background: inherit; /* Kế thừa nền từ section-bg-partner */
    padding: 10px; /* cho logo không sát viền */
    overflow: hidden; /* tránh logo tràn ra ngoài */
    border-radius: 8px; /* bo góc nếu muốn */
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
    transition: filter 0.25s ease;
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

  .logo-marquee {
    background: inherit; /* lấy nền từ section-bg-partner */
    width: 100%;
    overflow: hidden; /* ẩn phần tràn khi chạy */
    padding: 10px 0; /* khoảng cách trên dưới */
  }

  .logo-track {
    display: flex;
    animation: marquee 20s linear infinite;
  }

  .logo-item {
    flex: 0 0 auto;
    padding: 0 20px; /* khoảng cách giữa các logo */
  }

  @keyframes marquee {
    from { transform: translateX(0); }
    to { transform: translateX(-50%); }
  }
</style>
@endpush

<!-- ĐỐI TÁC TIN CẬY -->
<section class="py-4 section-bg-partner">
  <div class="container">
    <h5 class="text-warning font-weight-bold">ĐỐI TÁC TIN CẬY</h5>
  </div>

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
</section>