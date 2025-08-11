
@extends('admins.layouts.master')

@section('content')
<div class="container-fluid my-4">
      <div class="d-flex justify-content-between align-items-center mb-3">
         <h5 class="mb-0">Xin chào {{ session('name') }}</h5>
      </div>

      <div class="d-flex justify-content-between align-items-center mb-3">
         <h4 class="mb-0 text-primary">Danh sách lịch tư vấn</h4>
         <div class="d-flex gap-2">
            <a href="#" class="btn btn-primary d-none" id="save-status-btn">Lưu trạng thái</a>
            <a href="#" class="btn btn-success">Thống kê khách hàng</a>
         </div>
      </div>

      <div class="card shadow-sm">
         <div class="card-body">

            <form class="mb-3" method="GET">
               <div class="form-row">
                  <div class="col-md-4 mb-2">
                        <input type="text" name="q" value="{{ old('q', $search ?? '') }}" class="form-control" placeholder="Tìm theo Tên, Địa điểm, Số điện thoại...">
                  </div>

                  <div class="col-md-2 mb-2">
                     <button class="btn btn-primary w-100" type="submit">
                           <i class="fa fa-search mr-1"></i> Tìm kiếm
                     </button>
                  </div>

                  <div class="col-md-1 mb-2">
                     <a href="{{ route('admin.consulting_requests.index') }}" class="btn btn-outline-secondary w-100">Đặt lại</a>
                  </div>
               </div>
            </form>

            <div>
               <table class="table table-bordered table-hover text-center">
                  <thead style="background-color: #242323c0; color: #C9B037">
                     <tr>
                        <th>#</th>
                        <th>Tên khách hàng</th>          
                        <th>Số điện thoại</th>
                        <th>Email</th>
                        <th>Địa điểm xây dựng</th>
                        <th>Gửi lúc</th>
                        <th>Duyệt</th>
                        <th>Xóa</th>
                     </tr>
                  </thead>
                  <tbody>
                     @forelse($consultingRequests as $item)
                           <tr>
                              <td>{{ $loop->iteration }}</td>
                              <td>{{ $item->name }}</td>
                              <td>{{ $item->phone }}</td>
                              <td>{{ $item->email }}</td>
                              <td>{{ $item->location }}</td>
                              <td>{{ $item->created_at }}</td>
                              <td>
                                 <span id="status-badge-{{ $item->id }}" class="badge bg-{{ $item->status->color() }}">
                                    {{ $item->status->label() }}
                                 </span>

                                 <div class="dropdown d-inline-block ms-2">
                                    <button class="btn btn-sm btn-outline-secondary dropdown-toggle"
                                       type="button"
                                       data-toggle="dropdown"
                                       aria-haspopup="true"
                                       aria-expanded="false"
                                    >
                                       <i class="fa fa-pencil"></i>
                                    </button>
                                    <ul class="dropdown-menu">
                                          @foreach (App\Enums\ConsultingRequestStatus::cases() as $statusCase)
                                             <li>
                                                <button class="dropdown-item change-status-btn"
                                                         type="button"
                                                         data-id="{{ $item->id }}"
                                                         data-status="{{ $statusCase->value }}">
                                                      {{ $statusCase->label() }}
                                                </button>
                                             </li>
                                          @endforeach
                                    </ul>
                                 </div>
                              </td>
                              <td>
                                 <form
                                    action="{{ route('admin.consulting_requests.destroy', $item->id) }}"
                                    method="POST" onsubmit="return confirm('Bạn chắc chắn muốn xoá?')"
                                    class="d-inline"
                                 >
                                    @csrf
                                    @method('DELETE')
                                    <button type="submit" class="btn btn-sm btn-danger">Xóa</button>
                                 </form>
                              </td>
                           </tr>
                     @empty
                           <tr>
                              <td colspan="10" class="text-muted">Chưa có lịch tư vấn nào.</td>
                           </tr>
                     @endforelse
                  </tbody>
               </table>
            </div>

            @if ($consultingRequests->hasPages())
               <div class="mt-3 d-flex justify-content-center">
                  <div class="mt-3 d-flex justify-content-center">
                     {{ $consultingRequests->links('pagination::bootstrap-4') }}
                  </div>
               </div>
            @endif
        </div>
    </div>
</div>
@endsection

@push('scripts')
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
