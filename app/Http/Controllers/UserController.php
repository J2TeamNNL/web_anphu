<?php

namespace App\Http\Controllers;

use App\Models\User;
use App\Models\Media;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\Hash;
use Illuminate\Http\Request;

use App\Http\Requests\StoreUserRequest;
use App\Http\Requests\UpdateUserRequest;
use CloudinaryLabs\CloudinaryLaravel\Facades\Cloudinary;

use App\Services\CloudinaryService;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\Auth;

class UserController extends Controller
{   

    private User $model;

    private $levels;

    const PER_PAGE = 5;

    public function __construct()
    {
        $this->model = new User();
        $this->levels = User::getLevels();
    }

    /**
     * Display a listing of the resource.
     */
    public function index(Request $request)
    {
        $search = $request->input('q');

        $query = $this->model::query();

        if ($search) {
            $query->where(function ($q) use ($search) {
                $q->where('name', 'like', "%{$search}%")
                ->orWhere('email', 'like', "%{$search}%");
            });
        }

        $users = $query
        ->orderByDesc('created_at')
        ->paginate(self::PER_PAGE)
        ->appends($request->query());

        return view('admins.users.index', [
            'users' => $users,
            'search' => $search,
        ]);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {      
        return view('admins.users.create', [
            'levels' => $this->levels,
        ]);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(StoreUserRequest $request, CloudinaryService $cloudinaryService)
    {
        $validated = $request->validated();
        $validated['password'] = Hash::make($validated['password']);

        $user = $this->model::create($validated);

        return redirect()->route('admin.users.index')
        ->with('success', 'Thêm người dùng thành công!');
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(User $user)
    {
        return view('admins.users.edit', [
            'user' => $user,
            'levels' => $this->levels,
        ]);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(UpdateUserRequest $request, User $user, CloudinaryService $cloudinaryService)
    {
        $data = $request->validated();

        if ($request->filled('password')) {
            $data['password'] = Hash::make($request->password);
        } else {
            unset($data['password']);
        }

        $user->update($data);

        return redirect()->route('admin.users.index')
            ->with('success', 'Cập nhật thành công!');
    }

    public function destroy(User $user, CloudinaryService $cloudinaryService)
    {
        $user->delete();

        return redirect()->route('admin.users.index')
            ->with('success', 'Xóa người dùng thành công.');
    }

    public function resetPassword(User $user)
    {
        if (!Auth::check() || Auth::user()->level != 1) {
            abort(403, 'Bạn không có quyền thực hiện thao tác này.');
        }

        $newPassword = Str::random(10);

        $user->update([
            'password' => Hash::make($newPassword),
        ]);

        return back()->with('success', "Mật khẩu mới cho {$user->name} là: {$newPassword}");
    }
}
