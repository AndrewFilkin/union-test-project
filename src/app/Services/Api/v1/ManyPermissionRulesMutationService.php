<?php

namespace App\Services\Api\V1;

use Illuminate\Http\JsonResponse;
use Illuminate\Support\Facades\Http;

class ManyPermissionRulesMutationService
{

    public $answer;

    public function manyPermissionRulesMutationService(array $data, string $bearerToken): void
    {

        $response = Http::withHeaders([
            'accept' => 'application/json, multipart/mixed',
            'Authorization' => $bearerToken
        ])->post('https://app.stud.druid.1t.ru/graphql', [
            'query' => 'mutation manyPermissionRulesMutation($input: permissionRulesMutationInput) {
	manyPermissionRulesMutation(input: $input) {
		created {
			id
			author_id
			level
			model_type
			model_id
			config
			owner_id
			owner_type
			created_at
			updated_at
		}
		updated {
			id
			author_id
			level
			model_type
			model_id
			config
			owner_id
			owner_type
			created_at
			updated_at
		}
		status
	}
}',
            'variables' => [
                'input' => [
                    'model_type' => 'page',
                    'model_id' => $data['model_id'],
                    'apply_to_children' => false,
                    'collection_to_create' => [
                        [
                            'level' => (int)$data['level'],
                            'owner_type' => 'group',
                            'owner_id' => $data['owner_id']
                        ]
                    ]
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
