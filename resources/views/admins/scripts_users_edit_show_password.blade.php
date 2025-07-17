@push('scripts_users_edit_show_password')
<script>
    document.addEventListener("DOMContentLoaded", function () {
        document.querySelectorAll(".toggle-password").forEach(function (btn) {
            btn.addEventListener("click", function () {
                const userId = btn.getAttribute("data-user-id");
                const passwordField = document.getElementById("password-" + userId);
                passwordField.classList.toggle("d-none");

                if (passwordField.classList.contains("d-none")) {
                    btn.textContent = "Hiện mật khẩu";
                } else {
                    btn.textContent = "Ẩn mật khẩu";
                }
            });
        });
    });
</script>
@endpush