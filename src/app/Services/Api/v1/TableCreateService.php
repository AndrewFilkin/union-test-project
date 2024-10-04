<?php

namespace App\Services\Api\V1;

use Illuminate\Http\JsonResponse;
use Illuminate\Support\Facades\Http;

class TableCreateService
{

    public $answer;

    public function tableCreate(array $data, string $bearerToken): void
    {

        $response = Http::withHeaders([
            'accept' => 'application/json, multipart/mixed',
            'Authorization' => $bearerToken
        ])->post('https://app.stud.druid.1t.ru/graphql', [
            'query' => 'mutation ($id: String!, $input: PageUpdateInput!) {
  pageUpdate(id: $id, input: $input) {
      recordId
      record {
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
      status
  }
}',
            'variables' => [
                'id' => $data['page_id'],
                'input' => [
                    'page_type' => 'table_choose_template',
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
