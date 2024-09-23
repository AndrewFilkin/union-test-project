<?php

namespace App\Services\Api\V1;

use Illuminate\Http\JsonResponse;
use Illuminate\Support\Facades\Http;

class SpaceCreateService
{

    public $answer;

    public function setAdminAccountPassword(array $data, string $bearerToken): void
    {

        $response = Http::withHeaders([
            'accept' => 'application/json, multipart/mixed',
            'Authorization' => $bearerToken
        ])->post('https://app.stud.druid.1t.ru/graphql', [
            'query' => 'mutation SpaceCreate($input: SpaceCreateInput!) {
  spaceCreate(input: $input) {
      recordId
      record {
        author_id
	name
        description
	config
        created_at
        updated_at
      }
      status
  }
}',
            'variables' => [
                'input' => [
                    'name' => $data['name'],
                    'description' => $data['description'],
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
