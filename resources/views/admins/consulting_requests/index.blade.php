
@extends('admins.layouts.master')

@section('consulting_requests_index')
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
                     <a href="{{ route('consulting_requests.index') }}" class="btn btn-outline-secondary w-100">Đặt lại</a>
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
                     </tr>
                  </thead>
                  <tbody>
                     @forelse($consultingRequests as $item)
                           <tr>
                              <td>{{ $item->id }}</td>
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
                                             data-bs-toggle="dropdown"
                                             aria-expanded="false">
                                          <i class="bi bi-pencil-square"></i>
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

@include('admins.scripts_consulting_requests_status')
