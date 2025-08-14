<div class="anphu-side-panel desktop-only">
   <div class="side-buttons">
      <a href="{{ config('company.social_media.facebook.url') }}" class="panel-btn" target="_blank" aria-label="Facebook">
         <i class="fab fa-facebook-f"></i>
      </a>
      <a href="{{ config('company.social_media.youtube.url') }}" class="panel-btn" target="_blank" aria-label="YouTube">
         <i class="fab fa-youtube"></i>
      </a>
      <a href="{{ config('company.social_media.tiktok.url') }}" class="panel-btn" target="_blank" aria-label="Messenger">
         <i class="fa-brands fa-tiktok"></i>
      </a>
      <a href="{{ config('company.contact.phone_link_1') }}" class="panel-btn" target="_blank" aria-label="Zalo">
         <img src="{{ asset('assets/img/logo/logo_zalo.png') }}" alt="Zalo" class="icon-img">
      </a>
   </div>
   <div class="toggle-btn" id="toggleSidePanel">
      <span class="toggle-icon">></span>
   </div>
</div>

<div class="anphu-side-panel-mobile mobile-only">
   <div class="side-buttons">
      <a href="{{ config('company.social_media.tiktok.url') }}" class="panel-btn" aria-label="Zalo">
         <i class="fa-brands fa-tiktok"></i>
         <span>Tiktok</span>
      </a>
      <a href="{{ config('company.social_media.zalo.url') }}" class="panel-btn" aria-label="Zalo">
         <i class="fas fa-comment-dots"></i>
         <span>Zalo</span>
      </a>
      
      <a href="tel:{{ config('company.contact.phone_2') }}" class="panel-btn" aria-label="Gọi điện">
         <i class="fas fa-phone-alt"></i>
         <span>Hotline</span>
      </a>
      <a href="consulting.callback" class="panel-btn" aria-label="Gọi điện" id="callback-btn">
         <i class="fas fa-headset"></i>
         <span>Y/c Gọi lại</span>
      </a>
      <a href="#" class="panel-btn" aria-label="Gọi điện">
         <i class="fas fa-gift"></i>
         <span>Ưu đãi</span>
      </a>
   </div>
</div>

{{-- <div id="callback-popup" class="popup-form" style="display:none;">
    <h4>Để lại số điện thoại để được gọi lại:</h4>
    <form id="callbackForm">
        <input type="text" name="phone" placeholder="Nhập số điện thoại" required>
        <input type="text" name="captcha" placeholder="mã bảo vệ" required>
        <button type="submit">Gửi yêu cầu</button>
    </form>
</div> --}}

@push('scripts')
<script>
   document.querySelector('#callback-btn').addEventListener('click', function() {
      document.querySelector('#callback-popup').style.display = 'block';
   });

   document.querySelector('#callbackForm').addEventListener('submit', function(e){
      e.preventDefault();

      let formData = new FormData(this);

      fetch('/consulting-request/callback', {
         method: 'POST',
         body: formData,
         headers: {
               'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').getAttribute('content')
         }
      })
      .then(res => res.json())
      .then(res => {
         if(res.success){
               alert(res.message);
               document.querySelector('#callback-popup').style.display = 'none';
               this.reset();
         }
      });
   });
</script>
@endpush