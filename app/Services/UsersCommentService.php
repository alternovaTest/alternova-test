<?php

namespace App\Services;

use App\Factories\Contracts\CreationInterface;
use App\Models\Item;
use App\Models\User;
use App\Repositories\UsersCommentRepository;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Response;
use Illuminate\Support\Facades\DB;

class UsersCommentService
{
    public function __construct(
        private CreationInterface $usersCommentFactory,
        private UsersCommentRepository $usersCommentRepository
    ) {}
    
    public function Create(array $commentData, User $user, Item $item): JsonResponse
    {
        $commentData['item_id'] = $item->id;
        $commentData['user_id'] = $user->id;
        $userComment = $this->usersCommentFactory->Create($commentData);
        DB::transaction(function() use($userComment) {
            $this->usersCommentRepository->Store($userComment);
        }, 2);

        return response()->json([
            'message' => 'Comentario añadido.',
        ], Response::HTTP_OK);
    }
}