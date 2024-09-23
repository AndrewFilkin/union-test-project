<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Api\v1\UnionController;

Route::post('/registerAdminAccount', [UnionController::class, 'registerAdminAccount'])->name('register.admin.account');
Route::post('/setAdminAccountPassword', [UnionController::class, 'setAdminAccountPassword'])->name('set.admin.account.password');
Route::post('/login', [UnionController::class, 'login'])->name('login');
Route::post('/spaceCreate', [UnionController::class, 'spaceCreate'])->name('space.create');
Route::get('/paginateGroup', [UnionController::class, 'paginateGroup'])->name('paginate.group.information');
Route::post('/createGroup', [UnionController::class, 'createGroup'])->name('create.group');
Route::get('/getParentIdForCreatePage', [UnionController::class, 'getParentIdForCreatePage'])->name('get.parent.id.for.create.page');
Route::post('/createPage', [UnionController::class, 'createPage'])->name('create.page');
Route::post('/manyPermissionRulesMutation', [UnionController::class, 'manyPermissionRulesMutation'])->name('many.permission.rules.mutation');
Route::post('/kanbanCreate', [UnionController::class, 'kanbanCreate'])->name('kanban.create');
