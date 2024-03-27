<?php

namespace App\Services;

use App\Events\UpdateRating;
use App\Factories\Contracts\CreationInterface;
use App\Models\Item;
use App\Models\User;
use App\Repositories\UsersRatingRepository;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Response;
use Illuminate\Support\Facades\DB;

class UsersRatingService
{
    public function __construct(
        private CreationInterface $userRatingFactory,
        private UsersRatingRepository $usersRatingRepository
    ) {}

    public function Create(array $ratingData, User $user, Item $item): JsonResponse
    {
        $ratingData['item_id'] = $item->id;
        $ratingData['user_id'] = $user->id;
        $userRating = $this->userRatingFactory->Create($ratingData);
        DB::transaction(function() use($userRating, $item) {
            $this->usersRatingRepository->Store($userRating);
            UpdateRating::dispatch($item);
        }, 2);

        return response()->json([
            'message' => 'Calificación añadida.',
        ], Response::HTTP_OK);
    }
}