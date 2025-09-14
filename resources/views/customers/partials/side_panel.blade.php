<div class="anphu-side-panel">
   <div class="side-buttons">
      <a href="{{ company()?->social_links['facebook'] ?? '#' }}" class="panel-btn panel-btn--round" target="_blank" aria-label="Facebook">
         <i class="fab fa-facebook-f"></i>
      </a>
      <a href="tel:{{ company()?->company_phone_2 ?? '' }}" class="panel-btn panel-btn--round" aria-label="Gọi điện">
         <i class="fas fa-phone"></i>
      </a>
      <a href="tel:{{ company()?->company_phone_1 ?? '' }}" class="panel-btn panel-btn--round" target="_blank" aria-label="Zalo">
         <img src="{{ asset('assets/img/logo/logo_zalo.png') }}" alt="Zalo" class="icon-img">
      </a>
   </div>
</div>