<?php

namespace App\Http\Controllers;
use Carbon\Carbon;

use Illuminate\Http\Request;
use App\Models\ConsultingRequest;

class ConsultingRequestController extends Controller
{
    public function store(Request $request)
    {
        $validated = $request->validate([
            'name' => 'required|string|max:255',
            'phone' => 'required|string|max:20',
            'email' => 'nullable|email|max:255',
            'location' => 'required|string|max:255',
        ]);

        $alreadySubmitted = ConsultingRequest::whereDate('created_at', Carbon::today())
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

        $consulting = ConsultingRequest::create($validated);

        return response()->json([
            'message' => 'Đăng ký thành công',
            'data' => $consulting
        ], 201);
    }
}
