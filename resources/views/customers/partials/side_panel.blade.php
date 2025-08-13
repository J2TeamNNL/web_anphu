<div class="anphu-side-panel">
   <div class="side-buttons">
      <div class="button-group"></div>

      <!-- Đưa vào đây -->
      <div class="side-label-btn">
         <i class="fas fa-paper-plane"></i>
         <span>Nhận dự án mẫu</span>
      </div>

      <a href="https://www.facebook.com/yourpage" class="panel-btn" target="_blank" aria-label="Facebook">
         <i class="fab fa-facebook-f"></i>
      </a>
      <a href="https://www.youtube.com/yourchannel" class="panel-btn" target="_blank" aria-label="YouTube">
         <i class="fab fa-youtube"></i>
      </a>
      <a href="https://m.me/yourpage" class="panel-btn" target="_blank" aria-label="Messenger">
         <i class="fab fa-facebook-messenger"></i>
      </a>
      <a href="{{ config('company.contact.phone_link_1') }}" class="panel-btn" target="_blank" aria-label="Zalo">
         <img src="{{ asset('assets/img/logo/logo_zalo.png') }}" alt="Zalo" class="icon-img">
      </a>
   </div>

   <!-- Toggle -->
   <div class="toggle-btn" id="toggleSidePanel">
      <span class="toggle-icon">></span>
   </div>
</div>
