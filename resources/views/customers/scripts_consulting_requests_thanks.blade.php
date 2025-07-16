@once
@push('scripts_consulting_requests_thanks')
<script>
document.querySelectorAll('.consulting-form').forEach(form => {
    form.addEventListener('submit', function (e) {
        e.preventDefault();

        let formData = new FormData(form);

        fetch(form.action, {
            method: 'POST',
            headers: {
                'X-CSRF-TOKEN': form.querySelector('input[name="_token"]').value,
                'Accept': 'application/json',
            },
            body: formData
        })
        .then(response => {
            if (!response.ok) throw response;
            return response.json();
        })
        .then(data => {
            form.reset();
            document.getElementById('thank-you-overlay').classList.remove('d-none');
        })
        .catch(async error => {
            let errorText = 'Đã có lỗi xảy ra. Vui lòng thử lại!';

            // (429)
            if (error.status === 429) {
                document.getElementById('error-overlay').classList.remove('d-none');
                return;
            }

            // validation
            if (error.json) {
                const err = await error.json();
                if (err.errors) {
                    errorText = Object.values(err.errors).flat().join('<br>');
                }
            }

            // Fallback alert
            alert(errorText);
        });
    });
});

document.getElementById('back-button').addEventListener('click', function () {
    document.getElementById('thank-you-overlay').classList.add('d-none');
});

const errorOverlay = document.getElementById('error-overlay');
if (errorOverlay) {
    errorOverlay.querySelector('.btn-back')?.addEventListener('click', () => {
        errorOverlay.classList.add('d-none');
    });
}
</script>
@endpush
@endonce
