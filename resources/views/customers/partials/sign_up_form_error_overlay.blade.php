<div id="error-overlay" class="error-overlay d-none">
   <div class="error-popup bg-white text-center">
      <div class="checkmark-wrapper mb-3">
         <svg class="checkmark error" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 52 52">
            <circle class="checkmark-circle" cx="26" cy="26" r="25" fill="none"/>
            <path class="checkmark-x" fill="none" d="M16 16 36 36 M36 16 16 36"/>
         </svg>
      </div>
      <h5 class="text-danger font-weight-bold">Bạn đã đăng ký hôm nay!</h5>
      <p class="text-muted mb-3">Chúng tôi đã nhận được thông tin của bạn hôm nay. Vui lòng quay lại sau.</p>
      <button class="btn btn-back btn-outline-danger mt-2" onclick="document.getElementById('error-overlay').classList.add('d-none')">← Quay lại</button>
   </div>
</div>