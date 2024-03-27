<?php

namespace App\Factories;

use App\Factories\Contracts\CreationInterface;
use App\Models\Item;

class ItemFactory implements CreationInterface
{
    public function Create(array $itemData): Item
    {
        $item = new Item();
        $item->name = $itemData['name'];
        $item->description = $itemData['description'];
        $item->type = $itemData['type'];
        $item->created_by = $item->updated_by = $itemData['user_name'];
        return $item;
    }
}