<?php

namespace App\Repositories;

use App\Exceptions\CustomException;
use App\Models\UsersRating;
use Illuminate\Support\Facades\DB;

class UsersRatingRepository
{
    public function Store(UsersRating $userRating): void
    {
        try {
            $userRating->save();
        } catch (\Throwable $th) {
            throw new CustomException($th->getMessage());
        }
    }

    public function getAverageRatingByItem(int $itemId): float
    {
        try {
            return DB::table('users_ratings')->where('item_id', $itemId)->average('rating');
        } catch (\Throwable $th) {
            throw new CustomException($th->getMessage());
        }
    }
}