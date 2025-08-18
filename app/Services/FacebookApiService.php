<?php

namespace App\Services;

use Illuminate\Support\Facades\Http;
use Illuminate\Http\Client\PendingRequest;
use InvalidArgumentException;
use RuntimeException;

class FacebookApiService
{
    private string $userToken;
    private string $adminToken;
    private string $pageId;
    private PendingRequest $client;

    public function __construct()
    {
        $this->userToken = config('services.facebook.user_token');
        if (empty($this->userToken)) {
            throw new InvalidArgumentException('Facebook user token is required');
        }

        $this->adminToken = config('services.facebook.admin_token');
        $this->pageId = config('services.facebook.page_id');

        $this->client = Http::baseUrl("https://graph.facebook.com/");
    }

    public static function make(): self
    {
        return new self();
    }

    public function getManagedPages(array $fields = ['id', 'name', 'access_token']): array
    {
        $fieldsString = implode(',', $fields);
        
        $response = $this->client->get("me/accounts", [
            'fields' => $fieldsString,
            'access_token' => $this->userToken
        ]);

        if (!$response->successful()) {
            $error = $response->json('error');
            throw new RuntimeException(
                "Facebook API Error: " . ($error['message'] ?? 'Unknown error'),
                $response->status()
            );
        }

        return $response->json('data', []);
    }

    public function getPagePostsWithCursor(
        int $limit = 25,
        ?string $after = null,
        ?string $before = null
    ): array {
        if ($limit > 100) {
            $limit = 100;
        }

        $fields = [
            'id', 
            'message', 
            'created_time', 
            'permalink_url', 
            'full_picture', 
            'source',
            'name',
            'caption',
            'description',
            // 'attachments{media,media_type,target,type,url,title,description}',
        ];
        $fieldsString = implode(',', $fields);
        
        $params = [
            'fields' => $fieldsString,
            'limit' => $limit,
            'access_token' => $this->adminToken
        ];

        if ($after) {
            $params['after'] = $after;
        }

        if ($before) {
            $params['before'] = $before;
        }

        $response = $this->client
            // ->dd()
            ->get("{$this->pageId}/posts", $params);

        if (!$response->successful()) {
            $error = $response->json('error');
            throw new RuntimeException(
                "Facebook API Error: " . ($error['message'] ?? 'Unknown error'),
                $response->status()
            );
        }

        $data = $response->json();
        $paging = $data['paging'] ?? null;
        
        return [
            'posts' => $data['data'] ?? [],
            'cursors' => $paging['cursors'] ?? null,
            'has_next' => isset($paging['next']),
            'has_previous' => isset($paging['previous']),
            'total_count' => count($data['data'] ?? [])
        ];
    }

    public function getNextPage(string $nextUrl): array
    {
        if (empty($nextUrl)) {
            throw new InvalidArgumentException('Next page URL is required');
        }

        // Remove base URL and access token from the URL
        $url = str_replace('https://graph.facebook.com/', '', $nextUrl);
        
        $response = $this->client->get($url);

        if (!$response->successful()) {
            $error = $response->json('error');
            throw new RuntimeException(
                "Facebook API Error: " . ($error['message'] ?? 'Unknown error'),
                $response->status()
            );
        }

        $data = $response->json();
        $paging = $data['paging'] ?? null;
        
        return [
            'posts' => $data['data'] ?? [],
            'cursors' => $paging['cursors'] ?? null,
            'has_next' => isset($paging['next']),
            'has_previous' => isset($paging['previous']),
            'total_count' => count($data['data'] ?? [])
        ];
    }

    public function getPreviousPage(string $previousUrl): array
    {
        if (empty($previousUrl)) {
            throw new InvalidArgumentException('Previous page URL is required');
        }

        // Remove base URL and access token from the URL
        $url = str_replace('https://graph.facebook.com/', '', $previousUrl);
        
        $response = $this->client->get($url);

        if (!$response->successful()) {
            $error = $response->json('error');
            throw new RuntimeException(
                "Facebook API Error: " . ($error['message'] ?? 'Unknown error'),
                $response->status()
            );
        }

        $data = $response->json();
        $paging = $data['paging'] ?? null;
        
        return [
            'posts' => $data['data'] ?? [],
            'cursors' => $paging['cursors'] ?? null,
            'has_next' => isset($paging['next']),
            'has_previous' => isset($paging['previous']),
            'total_count' => count($data['data'] ?? [])
        ];
    }

    public function getPostMedia(string $postId): array
    {
        if (empty($postId)) {
            throw new InvalidArgumentException('Post ID is required');
        }

        $fields = [
            'attachments{media,media_type,target,type,url,title,description,subattachments{media,media_type,target,type,url}}',
            'full_picture',
            'picture',
            'source',
            'type',
            'object_id'
        ];
        
        $response = $this->client->get("{$postId}", [
            'fields' => implode(',', $fields)
        ]);

        if (!$response->successful()) {
            $error = $response->json('error');
            throw new RuntimeException(
                "Facebook API Error: " . ($error['message'] ?? 'Unknown error'),
                $response->status()
            );
        }

        return $response->json();
    }

    public function extractMediaUrls(array $postData): array
    {
        $mediaUrls = [];
        
        // Main picture/video
        if (!empty($postData['full_picture'])) {
            $mediaUrls[] = [
                'type' => 'image',
                'url' => $postData['full_picture'],
                'source' => 'full_picture'
            ];
        }
        
        if (!empty($postData['source'])) {
            $mediaUrls[] = [
                'type' => 'video',
                'url' => $postData['source'],
                'source' => 'video_source'
            ];
        }
        
        // Attachments
        if (!empty($postData['attachments']['data'])) {
            foreach ($postData['attachments']['data'] as $attachment) {
                if (!empty($attachment['media'])) {
                    $mediaUrls[] = [
                        'type' => $attachment['media_type'] ?? $attachment['type'] ?? 'unknown',
                        'url' => $attachment['media']['image']['src'] ?? $attachment['url'] ?? null,
                        'source' => 'attachment',
                        'title' => $attachment['title'] ?? null,
                        'description' => $attachment['description'] ?? null
                    ];
                }
                
                // Sub-attachments (multiple images in one post)
                if (!empty($attachment['subattachments']['data'])) {
                    foreach ($attachment['subattachments']['data'] as $subAttachment) {
                        if (!empty($subAttachment['media'])) {
                            $mediaUrls[] = [
                                'type' => $subAttachment['media_type'] ?? $subAttachment['type'] ?? 'unknown',
                                'url' => $subAttachment['media']['image']['src'] ?? $subAttachment['url'] ?? null,
                                'source' => 'sub_attachment'
                            ];
                        }
                    }
                }
            }
        }
        
        return array_filter($mediaUrls, function($media) {
            return !empty($media['url']);
        });
    }
}
