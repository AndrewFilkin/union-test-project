<?php

namespace App\Services\Api\V1;

use Illuminate\Http\JsonResponse;
use Illuminate\Support\Facades\Http;

class GetParentIdForCreatePage
{

    public $answer;

    public function getParentIdForCreatePage(string $bearerToken): void
    {
        $response = Http::withHeaders([
            'accept' => 'application/json, multipart/mixed',
            'Authorization' => $bearerToken
        ])->post('https://app.stud.druid.1t.ru/graphql', [
            'query' => 'query {
  pages(perPage: 10, page: 1) {
    data {
        id
        parent_id
        page_type
        title
        content
        icon
        level
        is_public
				is_block
        position
        config
        created_at
        updated_at
    }
    paginatorInfo {
        perPage
        count
        total
        currentPage
        from
        to
        lastPage
        hasMorePages
    }
  }
}
',]);

        if ($response->successful()) {
            $data = $response->json();
            $this->answer = $data;
        } else {
            $this->answer = $response->body();
        }
    }
}
