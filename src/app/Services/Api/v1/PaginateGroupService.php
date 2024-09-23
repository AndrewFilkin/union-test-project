<?php

namespace App\Services\Api\V1;

use Illuminate\Http\JsonResponse;
use Illuminate\Support\Facades\Http;

class PaginateGroupService
{

    public $answer;

    public function paginateGroup(string $bearerToken): void
    {
        $response = Http::withHeaders([
            'accept' => 'application/json, multipart/mixed',
            'Authorization' => $bearerToken
        ])->post('https://app.stud.druid.1t.ru/graphql', [
            'query' => 'query {
  paginate_group (page: 1, perPage: 50) {
    data{
      id
      name
      group {
        object{
          id
          name
        }
      }
    }
  }
}',]);

        if ($response->successful()) {
            $data = $response->json();
            $this->answer = $data;
        } else {
            $this->answer = $response->body();
        }
    }
}
