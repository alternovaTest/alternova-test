<?php

namespace App\Factories;

use App\Factories\Contracts\CreationInterface;
use App\Models\UsersRating;

class UserRatingFactory implements CreationInterface
{
    public function Create(array $userRatingData): UsersRating
    {
        $userRating = new UsersRating();
        $userRating->item_id = $userRatingData['item_id'];
        $userRating->user_id = $userRatingData['user_id'];
        $userRating->rating = $userRatingData['rating'];
        return $userRating;
    }
}