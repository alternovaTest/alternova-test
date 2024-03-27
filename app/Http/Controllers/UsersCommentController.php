<?php

namespace App\Http\Controllers;

use App\Http\Requests\CommentRequest;
use App\Models\Item;
use App\Services\UsersCommentService;
use Illuminate\Http\JsonResponse;

class UsersCommentController extends Controller
{
    public function __construct(
        private UsersCommentService $usersCommentService
    ) {}

    public function Create(CommentRequest $commentRequest, Item $item): JsonResponse
    {
        return $this->usersCommentService->Create($commentRequest->validated(), auth()->user(), $item);
    }
}
