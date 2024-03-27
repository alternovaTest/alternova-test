<?php

namespace App\Repositories;

use App\Exceptions\CustomException;
use App\Models\UsersComment;

class UsersCommentRepository
{
    public function Store(UsersComment $userComment): void
    {
        try {
            $userComment->save();
        } catch (\Throwable $th) {
            throw new CustomException($th->getMessage());
        }
    }
}