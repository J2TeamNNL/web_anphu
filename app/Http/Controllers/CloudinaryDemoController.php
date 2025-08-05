<?php

namespace App\Http\Controllers;

use App\Services\CloudinaryService;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use Illuminate\Http\JsonResponse;

class CloudinaryDemoController extends Controller
{
    protected CloudinaryService $cloudinaryService;

    public function __construct(CloudinaryService $cloudinaryService)
    {
        $this->cloudinaryService = $cloudinaryService;
    }
    /**
     * Display demo upload form and uploaded images list.
     */
    public function index()
    {
        return view('cloudinary-demo.index');
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('cloudinary-demo.create');
    }

    /**
     * Store a newly uploaded image to Cloudinary using Storage disk.
     */
    public function store(Request $request): JsonResponse
    {
        // Validate the uploaded file
        $validator = Validator::make($request->all(), [
            'image' => 'required|image|mimes:jpeg,png,jpg,gif,webp|max:10240', // Max 10MB
            'folder' => 'nullable|string|max:100'
        ]);

        if ($validator->fails()) {
            return response()->json([
                'success' => false,
                'message' => 'Validation failed',
                'errors' => $validator->errors()
            ], 422);
        }

        $file = $request->file('image');
        $folder = $request->input('folder', 'demo_uploads');
        
        // Upload using CloudinaryService
        $uploadResult = $this->cloudinaryService->upload($file, $folder);
        
        return response()->json([
            'success' => true,
            'message' => 'Image uploaded successfully!',
            'data' => $uploadResult
        ]);
    }

    /**
     * Display the specified resource.
     * @param string $path
     * @return JsonResponse
     */
    public function show(string $path)
    {
        // Get file info using CloudinaryService
        $fileInfo = $this->cloudinaryService->getFileInfo($path);
        
        if (!$fileInfo['exists']) {
            abort(404, 'File not found');
        }
        
        return response()->json([
            'success' => true,
            'data' => $fileInfo
        ]);
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $path): JsonResponse
    {
        // Check if file exists first
        if (!$this->cloudinaryService->exists($path)) {
            abort(404, 'File not found');
        }
        
        // Delete using CloudinaryService
        $this->cloudinaryService->delete($path);
        
        return response()->json([
            'success' => true,
            'message' => 'Image deleted successfully!'
        ]);
    }

    /**
     * List all files in Cloudinary storage.
     */
    public function list(): JsonResponse
    {
        // Get files list using CloudinaryService
        $files = $this->cloudinaryService->listFiles();
        
        return response()->json([
            'success' => true,
            'files' => $files,
            'count' => count($files)
        ]);
    }
}
