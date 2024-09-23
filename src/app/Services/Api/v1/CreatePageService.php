<?php

namespace App\Services\Api\V1;

use Illuminate\Http\JsonResponse;
use Illuminate\Support\Facades\Http;

class CreatePageService
{

    public $answer;

    public function createPage(array $data, string $bearerToken): void
    {
        if (array_key_exists('parent_id', $data)) {
            $parent_id = $data['parent_id'];
        } else {
            $parent_id = null;
        }

        $response = Http::withHeaders([
            'accept' => 'application/json, multipart/mixed',
            'Authorization' => $bearerToken
        ])->post('https://app.stud.druid.1t.ru/graphql', [
            'query' => 'mutation ($input: PageCreateInput!) {
  pageCreate(input: $input) {
    recordId
    status
    record {
        parent_id
        page_type
        title
        content
        icon
        level
        is_public
        position
        config
        created_at
        updated_at
    }
  }
}',
            'variables' => [
                'input' => [
                    'page_type' => 'new_page',
                    'parent_id' => $parent_id,
                    'title' => $data['title'],
                ]
            ],
        ]);

        if ($response->successful()) {
            $data = $response->json();
            $this->answer = $data;
        } else {
            $this->answer = $response->body();
        }
    }
}
