<?php

namespace App\Http\Controllers;

use App\Models\User;

use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\Hash;
use Illuminate\Http\Request;

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

        $users = $query->orderByDesc('created_at')->paginate(self::PER_PAGE)->appends($request->query());

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
    public function store(Request $request)
    {
        $validated = $request->validate([
            'name' => 'required|string|max:255',
            'avatar' => 'nullable|image',
            'level' => 'required|in:0,1',
            'email' => 'required|string|email|max:255|unique:users',
            'password' => 'required|string|min:6|confirmed',
        ]);

        $validated['password'] = Hash::make($validated['password']);

        if ($request->hasFile('avatar')) {
            $validated['avatar'] = $request->file('avatar')->store('avatar', 'public');
        }

        $this->model::create($validated);

        return redirect()->route('users.index')->with('success', 'Tạo thành công');
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
    public function update(Request $request, $id)
    {
        $user = $this->model::findOrFail($id);

        $validated = $request->validate([
            'name' => 'required|string|max:255',
            'email' => "required|email|max:255|unique:users,email,{$id}",
            'level' => 'required|in:0,1',
            'password' => 'string',
            'avatar_new' => 'nullable|image',
            'avatar_old' => 'nullable|string',
        ]);

        $data = [
            'name' => $validated['name'],
            'level' => $validated['level'],
            'email' => $validated['email'],
        ];

        if (!empty($validated['password'])) {
            $user->password = Hash::make($validated['password']);
        }

        if ($request->hasFile('avatar_new')) {
            if ($user->avatar && Storage::disk('public')->exists($user->avatar)) {
                Storage::disk('public')->delete($user->avatar);
            }
            $user->avatar = $request->file('avatar_new')->store('avatar', 'public');
        } else {
            $user->avatar = $validated['avatar_old'] ?? $user->avatar;
        }

        $user->save();

        return redirect()->route('users.index')->with('success', 'Cập nhật thành công!');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(User $user)
    {
        if ($user->avatar && Storage::disk('public')->exists($user->avatar)) {
            Storage::disk('public')->delete($user->avatar);
        }

        $user->delete();

        return response()->json(['message' => 'Đã xóa người dùng']);
    }
}
