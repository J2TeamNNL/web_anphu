<?php

return [
    /*
    |--------------------------------------------------------------------------
    | OpenAI API Configuration
    |--------------------------------------------------------------------------
    */
    
    'api_key' => env('OPENAI_API_KEY'),

    'organization' => env('OPENAI_ORGANIZATION', 'org-0sRkwJTxHZxbepmCfwboAqLq'),
    
    'base_url' => env('OPENAI_BASE_URL', 'https://api.openai.com/v1'),
    
    'timeout' => env('OPENAI_TIMEOUT', 30),
    
    'max_retries' => env('OPENAI_MAX_RETRIES', 3),
    
    /*
    |--------------------------------------------------------------------------
    | Default Model Settings
    |--------------------------------------------------------------------------
    */
    
    'default_model' => env('OPENAI_DEFAULT_MODEL', 'gpt-5-mini'),
    
    /*
    |--------------------------------------------------------------------------
    | Content Generation Settings
    |--------------------------------------------------------------------------
    */
    
    'content_generation' => [
        'max_tokens' => env('OPENAI_CONTENT_MAX_TOKENS', 500),
        'temperature' => env('OPENAI_CONTENT_TEMPERATURE', 0.8),
        'top_p' => env('OPENAI_CONTENT_TOP_P', 1.0),
        'frequency_penalty' => env('OPENAI_CONTENT_FREQUENCY_PENALTY', 0.0),
        'presence_penalty' => env('OPENAI_CONTENT_PRESENCE_PENALTY', 0.0),
    ],

    /*
    |--------------------------------------------------------------------------
    | Assistant Settings
    |--------------------------------------------------------------------------
    */
    
    'assistant' => [
        'interior_id' => env('OPENAI_INTERIOR_ASSISTANT_ID'),
        'construction_id' => env('OPENAI_CONSTRUCTION_ASSISTANT_ID'),
        'thread_interior_id' => env('OPENAI_THREAD_INTERIOR_ID'),
        'thread_construction_id' => env('OPENAI_THREAD_CONSTRUCTION_ID'),
    ],
];
