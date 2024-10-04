<?php

namespace App\Services\Api\V1;

use Illuminate\Http\JsonResponse;
use Illuminate\Support\Facades\Http;

class AddTextService
{

    public $answer;

    public function addText(array $data, string $bearerToken): void
    {

        $response = Http::withHeaders([
            'accept' => 'application/json, multipart/mixed',
            'Authorization' => $bearerToken
        ])->post('https://app.stud.druid.1t.ru/graphql', [
            'query' => 'mutation ($input: PropertyCreateInput!) {
	propertyCreate(input: $input) {
		recordId
		record {
			id
			type_id
			author_id
			data_type
			name
			hint
			description
			label
			order
			required
			system
			unique
			multiple {
				status
				max_number
				button_text
			}
			guarded
			default
			meta
			deleted_at
			created_at
			updated_at
			property_group_id
		}
		status
	}
}',
            'variables' => [
                'input' => [
                    'type_id' => $data['type_id'],
                    'data_type' => 'text',
                    'label' => $data['label'],
                    'meta' => [
                        "multiline" => false,
                        "min" => 2,
                        "max" => 10,
                        "placeholder" => null,
                        "mask" => null,
                    ],
                    'default' => [
                        'value' => $data['value'],
                    ],
                    "order" => 1,
                    "required" => false,
                    'multiple' => [
                        'status' => false,
                    ]
                ],
            ]
        ]);

        if ($response->successful()) {
            $data = $response->json();
            $this->answer = $data;
        } else {
            $this->answer = $response->body();
        }
    }
}
