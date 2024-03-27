<?php

namespace App\Factories;

use App\Factories\Contracts\CreationInterface;
use App\Models\UsersComment;

class UsersCommentFactory implements CreationInterface
{
    public function Create(array $userCommentData): UsersComment
    {
        $userComment = new UsersComment();
        $userComment->item_id = $userCommentData['item_id'];
        $userComment->user_id = $userCommentData['user_id'];
        $userComment->comment = $userCommentData['comment'];
        return $userComment;
    }
}