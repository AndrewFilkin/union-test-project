<?php

namespace App\Services\Api\V1;

use Illuminate\Http\JsonResponse;
use Illuminate\Support\Facades\Http;

class RegisterAdminAccountService
{

    public $answer;

    public function registerAdminAccount(array $data): void {

        $response = Http::withHeaders([
            'accept' => 'application/json, multipart/mixed',
//            'Authorization' => 'eyJ0eXAiOiJKV1QiLCJhbGciOiJSUzI1NiJ9.eyJhdWQiOiI3IiwianRpIjoiYjAyZjIyNmUxMTdlMDVlYWNkNzMzNjM4YTZmMDlmMzljMTU1Yzc1YzM1MTFhNzk3MTg1OTE4NjdkMDU2NTM3NWYyZjYzYmFlMmU1ODDDZTEiLCJpYXQiOjE2Nzk0NzY1NzIuNDU2Mzg2LCJuYmYiOjE2Nzk0NzY1NzIuNDU2Mzg4LCJleHAiOjE3MTEwOTg5NzIuNDQ0MzUxLCJzdWIiOiI5MDA1MTQ2MDg1OTkwOTI0OTUwIiwic2NvcGVzIjpbXX0.CEkoLiT41gA3FOl0hJOrxb7K-caXpSERh0JnmX6MG5e-pbZUBVJK6lxX9qgqE1lcxKPZki1oA40o7-5tCsEVaLInRb8Iu-gMhmmvict4DMcgqvazltRMnX8vw5xIRu5OH-ZhFjqwJUF2uq7uEYwXbqBSl3rRH6ybsbpCmYlpxCy8lU8tA636EUGQlp1HhA2yfn46rd3SN-hfhnryY8MU0WweqckcZMgdA9FOtf9tobVg3OgvK6FJC7McaCMRGdn7lQLE4dWtX0UF8Rj5HZY6GScfsYf3Vp90z0c0xmx5qJkUnYywQviELYBQ4rZBxA-uijJlxDlzLnfJNsSguWM2DW-imaTdzWAesmtxWrdmp7jy7DUU6rBUZIOtoBVNFN_8V98VJQ1oukCVm01kwMmvBjLBOG9QbnCvvJWqZCharNjUpTP8rxx4SIfskKjvkUtP4q4274rx3fX3zy5ScYhT5dMJR-7xPJO-aq2V_6F7DbzIZv-4Mdfc0INwqyfPLuIYJG318_D8X_iNejkXamKF4UIRU1UfgpLl0FcWM-ldxAEo2aATaYN-gKVYW2_rtAgRE0hNE-2ccOrmZaeq-yt-A00BjE7_A8F-aCS2baV2TmYJxBmSj7PGXHUb_ijhFuwEPM05V1M0GLaOgYWyioxhquPnmZCbrG4hpTL657Q8CSc'
        ])->post('https://app.stud.druid.1t.ru/graphql', [
            'query' => 'mutation UserSignUp($input: UserSignUpInput!) {
        userSignUp(input: $input) {
            recordId
            record {
                id
                email
                registration_passed
                name
                surname
            }
            status
        }
    }',
            'variables' => [
                'input' => [
                    'name' => $data['name'],
                    'surname' => $data['surname'],
                    'email' => $data['email'],
                ]
            ],
            'operationName' => 'UserSignUp'
        ]);

        if ($response->successful()) {
            $data = $response->json();
            $this->answer = $data;
        } else {
            $this->answer = $response->body();
        }
    }
}
