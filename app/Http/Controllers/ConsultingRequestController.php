<?php

namespace App\Http\Controllers;
use Carbon\Carbon;

use Illuminate\Http\Request;
use App\Models\ConsultingRequest;
use App\Http\Requests\StoreConsultingRequest;
use App\Http\Requests\StoreCallbackRequest;

class ConsultingRequestController extends Controller
{   
    private ConsultingRequest $model;

    const PER_PAGE = 20;

    public function __construct()
    {
        $this->model = new ConsultingRequest();

    }

    public function index(Request $request)
    {   
        $search = $request->input('q');

        $query = ConsultingRequest::query();

        if ($search) {
            $query->where(function ($q) use ($search) {
                $q->where('name', 'like', "%{$search}%")
                ->orWhere('phone', 'like', "%{$search}%")
                ->orWhere('location', 'like', "%{$search}%");
            });
        }

        $consultingRequests = $query->orderBy('created_at', 'desc')->paginate(self::PER_PAGE)->appends($request->query());

        return view ('admins.consulting_requests.index', [
            'consultingRequests' => $consultingRequests
        ]);
    }

    public function store(StoreConsultingRequest $request)
    {
        $validated = $request->validated();

        $validated['location'] = $validated['location'] ?? '';

        $alreadySubmitted = $this->model::whereDate('created_at', Carbon::today())
            ->where(function ($query) use ($validated) {
                $query->where('phone', $validated['phone']);
                if (!empty($validated['email'])) {
                    $query->orWhere('email', $validated['email']);
                }
            })
            ->exists();

        if ($alreadySubmitted) {
            return response()->json([
                'message' => 'Bạn đã đăng ký tư vấn hôm nay bằng số điện thoại hoặc email này. Vui lòng thử lại vào ngày mai.',
            ], 429); // HTTP 429 Too Many Requests
        }

        $consulting = $this->model::create($validated);

        return response()->json([
            'message' => 'Đăng ký thành công',
            'data' => $consulting
        ], 201);
    }

    public function updateStatus(Request $request, $id)
    {
        $request->validate([
            'status' => 'required|integer|in:0,1,2,3',
        ]);

        $requestItem = ConsultingRequest::findOrFail($id);
        $requestItem->status = $request->status;
        $requestItem->save();

        return response()->json([
            'status' => true,
            'label' => $requestItem->status->label(),
            'color' => $requestItem->status->color(),
        ]);
    }
    
    public function destroy($id)
    {
        $requestItem = $this->model::findOrFail($id);
        $requestItem->delete();

        return redirect()->route('admin.consulting_requests.index')
        ->with('success', 'Xóa giá thành công');
    }

    public function callbackRequest(StoreCallbackRequest $request)
    {
        $validated = $request->validated();

        $validated['location'] = $validated['location'] ?? '';
        $validated['status'] = 0;
        $validated['note'] = 'Khách gọi lại';

        $consulting = $this->model->create($validated);

        return response()->json([
            'message' => 'Đăng ký thành công',
            'data' => $consulting
        ], 201);
    }

}
