<?php

namespace App\Services\Api\V1;

use Illuminate\Http\JsonResponse;
use Illuminate\Support\Facades\Http;

class CreateGroupService
{

    public $answer;

    public function createGroup(array $data, string $bearerToken): void
    {

        if (array_key_exists('parent_group_id', $data)) {
            $array_key_exists = $data['parent_group_id'];
        } else {
            $array_key_exists = '';
        }

        $with_page = ($data['with_page'] == 1) ? true : false;

        $response = Http::withHeaders([
            'accept' => 'application/json, multipart/mixed',
            'Authorization' => $bearerToken
        ])->post('https://app.stud.druid.1t.ru/graphql', [
            'query' => 'mutation UserGroupCreate($input: UserGroupCreateInput!) {
  userGroupCreate(input: $input) {
      recordId
      record {
        id,
	type_id,
	name,
        description,
	icon,
	system,
	page_id,
	created_at,
	updated_at
      }
      status
  }
}',
            'variables' => [
                'input' => [
                    'with_page' => $with_page,
                    'parent_group_id' => $array_key_exists,
                    'name' => $data['name'],
                    'description' => $data['description'],
                    'icon' => "",
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
