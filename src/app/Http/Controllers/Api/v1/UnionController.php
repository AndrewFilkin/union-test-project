<?php

declare(strict_types=1);

namespace App\Http\Controllers\Api\v1;

use App\Http\Controllers\Controller;
use App\Http\Requests\Api\v1\AddTextRequest;
use App\Http\Requests\Api\v1\CreateGroupRequest;
use App\Http\Requests\Api\v1\CreateNewTypeRequest;
use App\Http\Requests\Api\v1\CreatePageRequest;
use App\Http\Requests\Api\v1\EventCreateRequest;
use App\Http\Requests\Api\v1\KanbanCreateRequest;
use App\Http\Requests\Api\v1\LoginRequest;
use App\Http\Requests\Api\v1\ManyPermissionRulesMutationRequest;
use App\Http\Requests\Api\v1\RegisterAdminAccountRequest;
use App\Http\Requests\Api\v1\SetAdminAccountPasswordRequest;
use App\Http\Requests\Api\v1\SpaceCreateRequest;
use App\Http\Requests\Api\v1\TableCreateRequest;
use App\Services\Api\V1\AddTextService;
use App\Services\Api\V1\CreateGroupService;
use App\Services\Api\V1\CreateNewTypeService;
use App\Services\Api\V1\CreatePageService;
use App\Services\Api\V1\EventCreateService;
use App\Services\Api\V1\GetParentIdForCreatePage;
use App\Services\Api\V1\KanbanCreateService;
use App\Services\Api\V1\LoginService;
use App\Services\Api\V1\ManyPermissionRulesMutationService;
use App\Services\Api\V1\PaginateGroupService;
use App\Services\Api\v1\RegisterAdminAccountService;
use App\Services\Api\V1\SetAdminAccountPasswordService;
use App\Services\Api\V1\SpaceCreateService;
use App\Services\Api\V1\TableCreateService;
use Illuminate\Http\Request;

class UnionController extends Controller
{
    public function registerAdminAccount(RegisterAdminAccountRequest $request, RegisterAdminAccountService $registerAdminAccountService)
    {
        $data = $request->validated();
        $registerAdminAccountService->registerAdminAccount($data);
        return response()->json($registerAdminAccountService->answer);
    }

    public function setAdminAccountPassword(SetAdminAccountPasswordRequest $request, SetAdminAccountPasswordService $setAdminAccountPasswordService) {

        $data = $request->validated();
        $setAdminAccountPasswordService->setAdminAccountPassword($data);
        return response()->json($setAdminAccountPasswordService->answer);

    }

    public function login(LoginRequest $request, LoginService $loginService) {
        $data = $request->validated();
        $loginService->login($data);
        return response()->json($loginService->answer);
    }

    public function spaceCreate(SpaceCreateRequest $request, SpaceCreateService $spaceCreateService) {

        $bearerToken = $request->header('Authorization');

        if (!$bearerToken) {
            return response()->json(['message' => 'Please send Bearer token']);
        }

        $data = $request->validated();
        $spaceCreateService->setAdminAccountPassword($data, $bearerToken);
        return response()->json($spaceCreateService->answer);
    }

    public function paginateGroup(Request $request, PaginateGroupService $paginateGroupService) {

        $bearerToken = $request->header('Authorization');

        if (!$bearerToken) {
            return response()->json(['message' => 'Please send Bearer token']);
        }

        $paginateGroupService->paginateGroup($bearerToken);
        return response()->json($paginateGroupService->answer);

    }

    public function createGroup(CreateGroupRequest $request, CreateGroupService $createGroupService) {

        $bearerToken = $request->header('Authorization');

        if (!$bearerToken) {
            return response()->json(['message' => 'Please send Bearer token']);
        }

        $data = $request->validated();
        $createGroupService->createGroup($data, $bearerToken);
        return response()->json($createGroupService->answer);
    }

    public function getParentIdForCreatePage(Request $request, GetParentIdForCreatePage $getParentIdForCreatePage) {
        $bearerToken = $request->header('Authorization');

        if (!$bearerToken) {
            return response()->json(['message' => 'Please send Bearer token']);
        }

        $getParentIdForCreatePage->getParentIdForCreatePage($bearerToken);
        return response()->json($getParentIdForCreatePage->answer);
    }

    public function createPage(CreatePageRequest $request, CreatePageService $createPageService) {

        $data = $request->validated();
        $bearerToken = $request->header('Authorization');

        if (!$bearerToken) {
            return response()->json(['message' => 'Please send Bearer token']);
        }

        $createPageService->createPage($data, $bearerToken);
        return response()->json($createPageService->answer);
    }

    public function manyPermissionRulesMutation(ManyPermissionRulesMutationRequest $request, ManyPermissionRulesMutationService $manyPermissionRulesMutationService) {

        $data = $request->validated();
        $bearerToken = $request->header('Authorization');

        if (!$bearerToken) {
            return response()->json(['message' => 'Please send Bearer token']);
        }

        $manyPermissionRulesMutationService->manyPermissionRulesMutationService($data, $bearerToken);
        return response()->json($manyPermissionRulesMutationService->answer);
    }

    public function kanbanCreate(KanbanCreateRequest $request, KanbanCreateService $kanbanCreateService) {
        $data = $request->validated();
        $bearerToken = $request->header('Authorization');

        if (!$bearerToken) {
            return response()->json(['message' => 'Please send Bearer token']);
        }

        $kanbanCreateService->kanbanCreate($data, $bearerToken);
        return response()->json($kanbanCreateService->answer);
    }

    public function tableCreate(TableCreateRequest $request, TableCreateService $tableCreateService) {
        $data = $request->validated();
        $bearerToken = $request->header('Authorization');

        if (!$bearerToken) {
            return response()->json(['message' => 'Please send Bearer token']);
        }

        $tableCreateService->tableCreate($data, $bearerToken);
        return response()->json($tableCreateService->answer);
    }


    public function createNewType(CreateNewTypeRequest $request, CreateNewTypeService $createNewTypeService) {
        $data = $request->validated();
        $bearerToken = $request->header('Authorization');

        if (!$bearerToken) {
            return response()->json(['message' => 'Please send Bearer token']);
        }

        $createNewTypeService->createNewType($data, $bearerToken);
        return response()->json($createNewTypeService->answer);
    }


    public function createEvent(EventCreateRequest $request, EventCreateService $eventCreateService) {
        $data = $request->validated();
        $bearerToken = $request->header('Authorization');

        if (!$bearerToken) {
            return response()->json(['message' => 'Please send Bearer token']);
        }

        $eventCreateService->eventCreate($data, $bearerToken);
        return response()->json($eventCreateService->answer);
    }

    public function addText(AddTextRequest $request, AddTextService $addTextService) {
        $data = $request->validated();
        $bearerToken = $request->header('Authorization');

        if (!$bearerToken) {
            return response()->json(['message' => 'Please send Bearer token']);
        }

        $addTextService->addText($data, $bearerToken);
        return response()->json($addTextService->answer);
    }

}
