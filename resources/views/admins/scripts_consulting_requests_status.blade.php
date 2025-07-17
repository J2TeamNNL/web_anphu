@push('scripts_consulting_requests_status')
<script>
const selectedStatuses = new Map(); // Map<id, newStatus>

// Bắt sự kiện chọn trạng thái mới
document.querySelectorAll('.change-status-btn').forEach(button => {
    button.addEventListener('click', function () {
        const id = this.dataset.id;
        const newStatus = this.dataset.status;

        selectedStatuses.set(id, newStatus);

        // Hiện nút Lưu
        document.getElementById('save-status-btn').classList.remove('d-none');

        // Cập nhật giao diện cho badge (màu xám chờ xác nhận)
        const badge = document.getElementById(`status-badge-${id}`);
        badge.className = 'badge bg-warning text-dark';
        badge.innerText = 'Đợi lưu...';
    });
});

// Bắt sự kiện khi bấm nút Lưu
document.getElementById('save-status-btn').addEventListener('click', function (e) {
    e.preventDefault();

    if (selectedStatuses.size === 0) return;

    selectedStatuses.forEach((status, id) => {
        fetch(`/admin/consulting-requests/${id}/status`, {
            method: 'PATCH',
            headers: {
                'Content-Type': 'application/json',
                'X-CSRF-TOKEN': '{{ csrf_token() }}',
            },
            body: JSON.stringify({ status }),
        })
        .then(response => response.json())
        .then(data => {
            if (data.status) {
                const badge = document.getElementById(`status-badge-${id}`);
                badge.className = `badge bg-${data.color}`;
                badge.innerText = data.label;
            } else {
                alert(`Không thể cập nhật trạng thái cho #${id}`);
            }
        })
        .catch(err => {
            console.error(err);
            alert(`Lỗi cập nhật trạng thái cho #${id}`);
        });
    });

    // Xóa trạng thái đã chọn và ẩn nút Lưu
    selectedStatuses.clear();
    this.classList.add('d-none');
});
</script>
@endpush
