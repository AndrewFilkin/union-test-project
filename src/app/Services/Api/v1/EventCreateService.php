<?php

namespace App\Services\Api\V1;

use Illuminate\Http\JsonResponse;
use Illuminate\Support\Facades\Http;

class EventCreateService
{

    public $answer;

    public function eventCreate(array $data, string $bearerToken): void
    {

        $response = Http::withHeaders([
            'accept' => 'application/json, multipart/mixed',
            'Authorization' => $bearerToken
        ])->post('https://app.stud.druid.1t.ru/graphql', [
            'query' => 'mutation applyTemplateToPage($id: String!, $input: ApplyTemplateToPageInput!) {
  applyTemplateToPage(id: $id, input: $input) {
    recordId
    record {
      id
      updated_by_subject_id
      apply_permissions_to_children
      parent_id
      page_type
      title
      icon
      config
      position
      hasChild
      level
      is_public
      is_block
      object {
        id
        type_id
        __typename
      }
      created_at
      updated_at
      deleted_at
      __typename
    }
    status
    __typename
  }
}',
            'variables' => [
                'id' => $data['id'],
                'input' => [
                    'page_type' => 'table',
                    'template' => 'event',
                    "title" => $data['title'],
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
