<?php

namespace App\Http\Controllers;

use App\Http\Requests\RatingRequest;
use App\Models\Item;
use App\Services\UsersRatingService;
use Illuminate\Http\JsonResponse;

class UsersRatingController extends Controller
{
    public function __construct(
        private UsersRatingService $usersRatingService
    ) {}

    public function Create(RatingRequest $ratingRequest, Item $item): JsonResponse
    {
        return $this->usersRatingService->Create($ratingRequest->validated(), auth()->user(), $item);
    }
}
