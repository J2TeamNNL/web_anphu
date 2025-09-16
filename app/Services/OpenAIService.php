<?php

namespace App\Services;

use Illuminate\Support\Facades\Http;
use Illuminate\Support\Facades\Log;
use Exception;

class OpenAIService
{
    private string $apiKey;
    private string $baseUrl;
    private int $timeout;

    // Assistant constants
    private const ASSISTANT_MODEL = 'gpt-4o-mini';
    
    // Assistant types
    private const INTERIOR_ASSISTANT = [
        'name' => 'Interior Design Content Creator',
        'instructions' => 'Bạn là chuyên gia nội dung về kiến trúc nội thất. Tạo bài đăng hấp dẫn về thiết kế, trang trí, xu hướng nội thất. Trả về JSON: {"title":"...","content":"...","description":"...","category_id":"..."}. Chọn category_id phù hợp từ danh sách được cung cấp.'
    ];
    
    private const CONSTRUCTION_ASSISTANT = [
        'name' => 'Construction Project Content Creator', 
        'instructions' => 'Bạn là chuyên gia nội dung về dự án thi công xây dựng. Tạo bài đăng về tiến độ, kỹ thuật, chất lượng thi công. Trả về JSON: {"title":"...","content":"...","description":"...","category_id":"..."}. Chọn category_id phù hợp từ danh sách được cung cấp.'
    ];

    public function __construct()
    {
        $this->apiKey = config('openai.api_key');
        $this->baseUrl = config('openai.base_url');
        $this->timeout = config('openai.timeout');

        if (!$this->apiKey) {
            throw new Exception('OpenAI API key không được cấu hình');
        }
    }

    /**
     * Tạo Assistant cho nội dung kiến trúc nội thất
     */
    public function createInteriorAssistant(array $categories): string
    {
        $categoryList = $this->formatCategoryList($categories);
        $instructions = self::INTERIOR_ASSISTANT['instructions'] . "\n\nDanh sách categories:\n" . $categoryList;
        
        return $this->createAssistantWithInstructions(
            self::INTERIOR_ASSISTANT['name'],
            $instructions
        );
    }

    /**
     * Tạo Assistant cho nội dung dự án thi công
     */
    public function createConstructionAssistant(array $categories): string
    {
        $categoryList = $this->formatCategoryList($categories);
        $instructions = self::CONSTRUCTION_ASSISTANT['instructions'] . "\n\nDanh sách categories:\n" . $categoryList;
        
        return $this->createAssistantWithInstructions(
            self::CONSTRUCTION_ASSISTANT['name'],
            $instructions
        );
    }

    /**
     * Tạo assistant với instructions tùy chỉnh
     */
    private function createAssistantWithInstructions(string $name, string $instructions): string
    {
        $response = Http::withHeaders([
            'Authorization' => 'Bearer ' . $this->apiKey,
            'Content-Type' => 'application/json',
            'OpenAI-Beta' => 'assistants=v2'
        ])
        ->timeout($this->timeout)
        ->post($this->baseUrl . '/assistants', [
            'model' => self::ASSISTANT_MODEL,
            'name' => $name,
            'instructions' => $instructions,
            'tools' => []
        ]);

        if ($response->successful()) {
            $data = $response->json();
            return $data['id'];
        }

        throw new Exception('Không thể tạo assistant: ' . $response->body());
    }

    /**
     * Format danh sách categories
     */
    private function formatCategoryList(array $categories): string
    {
        $formatted = [];
        foreach ($categories as $category) {
            $formatted[] = "- ID: {$category['id']}, Name: {$category['name']}";
        }
        return implode("\n", $formatted);
    }

    /**
     * Tạo Thread mới
     */
    public function createThread(): string
    {
        $response = Http::withHeaders([
            'Authorization' => 'Bearer ' . $this->apiKey,
            'Content-Type' => 'application/json',
            'OpenAI-Beta' => 'assistants=v2'
        ])
        ->timeout($this->timeout)
        ->post($this->baseUrl . '/threads', []);

        if ($response->successful()) {
            $data = $response->json();
            return $data['id'];
        }

        throw new Exception('Không thể tạo thread: ' . $response->body());
    }

    /**
     * Tối ưu nội dung bài đăng với Assistant
     */
    public function optimizePostContent(string $content, ?string $threadId = null): array
    {
        $assistantId = config('openai.assistant.id');
        if (!$assistantId) {
            throw new Exception('Assistant ID chưa được cấu hình. Hãy tạo assistant trước.');
        }

        // Tạo thread mới nếu không có
        if (!$threadId) {
            $threadId = $this->createThread();
        }

        // Thêm message vào thread
        $this->addMessageToThread($threadId, $content);

        // Chạy assistant
        $runId = $this->runAssistant($threadId, $assistantId);

        // Đợi kết quả
        $result = $this->waitForRunCompletion($threadId, $runId);

        return [
            'thread_id' => $threadId,
            'optimized_content' => $result
        ];
    }

    /**
     * Thêm message vào thread
     */
    private function addMessageToThread(string $threadId, string $content): void
    {
        $response = Http::withHeaders([
            'Authorization' => 'Bearer ' . $this->apiKey,
            'Content-Type' => 'application/json',
            'OpenAI-Beta' => 'assistants=v2'
        ])
        ->timeout($this->timeout)
        ->post($this->baseUrl . "/threads/{$threadId}/messages", [
            'role' => 'user',
            'content' => $content
        ]);

        if (!$response->successful()) {
            throw new Exception('Không thể thêm message: ' . $response->body());
        }
    }

    /**
     * Chạy assistant trên thread
     */
    private function runAssistant(string $threadId, string $assistantId): string
    {
        $response = Http::withHeaders([
            'Authorization' => 'Bearer ' . $this->apiKey,
            'Content-Type' => 'application/json',
            'OpenAI-Beta' => 'assistants=v2'
        ])
        ->timeout($this->timeout)
        ->post($this->baseUrl . "/threads/{$threadId}/runs", [
            'assistant_id' => $assistantId
        ]);

        if ($response->successful()) {
            $data = $response->json();
            return $data['id'];
        }

        throw new Exception('Không thể chạy assistant: ' . $response->body());
    }

    /**
     * Đợi assistant hoàn thành
     */
    private function waitForRunCompletion(string $threadId, string $runId): string
    {
        $maxAttempts = 30;
        $attempt = 0;

        while ($attempt < $maxAttempts) {
            $response = Http::withHeaders([
                'Authorization' => 'Bearer ' . $this->apiKey,
                'OpenAI-Beta' => 'assistants=v2'
            ])
            ->timeout($this->timeout)
            ->get($this->baseUrl . "/threads/{$threadId}/runs/{$runId}");

            if ($response->successful()) {
                $data = $response->json();
                $status = $data['status'];

                if ($status === 'completed') {
                    return $this->getLatestMessage($threadId);
                }

                if (in_array($status, ['failed', 'cancelled', 'expired'])) {
                    throw new Exception("Assistant run failed with status: {$status}");
                }

                sleep(2); // Đợi 2 giây trước khi check lại
                $attempt++;
            } else {
                throw new Exception('Không thể check run status: ' . $response->body());
            }
        }

        throw new Exception('Assistant run timeout');
    }

    /**
     * Lấy message mới nhất từ thread
     */
    private function getLatestMessage(string $threadId): string
    {
        $response = Http::withHeaders([
            'Authorization' => 'Bearer ' . $this->apiKey,
            'OpenAI-Beta' => 'assistants=v2'
        ])
        ->timeout($this->timeout)
        ->get($this->baseUrl . "/threads/{$threadId}/messages", [
            'order' => 'desc',
            'limit' => 1
        ]);

        if ($response->successful()) {
            $data = $response->json();
            if (!empty($data['data'])) {
                $message = $data['data'][0];
                if ($message['role'] === 'assistant') {
                    return $message['content'][0]['text']['value'];
                }
            }
        }

        throw new Exception('Không thể lấy response từ assistant');
    }

}
