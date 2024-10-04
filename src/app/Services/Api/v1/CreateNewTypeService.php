<?php

namespace App\Services\Api\V1;

use Illuminate\Http\JsonResponse;
use Illuminate\Support\Facades\Http;

class CreateNewTypeService
{

    public $answer;

    public function createNewType(array $data, string $bearerToken): void
    {

        $response = Http::withHeaders([
            'accept' => 'application/json, multipart/mixed',
            'Authorization' => $bearerToken
        ])->post('https://app.stud.druid.1t.ru/graphql', [
            'query' => 'mutation ($input: TypeCreateInput!) {
  typeCreate (input: $input) {
    recordId
    record {
        id
        name
        label
        description
        system
        searchable
        id_ai
        author_id
        meta {
            headline
            icon
        }
        created_at
        updated_at
    }
    status
  }
}',
            'variables' => [
                'input' => [
                    'label' => $data['name'],
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
