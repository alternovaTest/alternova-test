<?php

namespace App\Repositories;

use App\Exceptions\CustomException;
use App\Models\Item;
use Illuminate\Support\Collection;
use Illuminate\Support\Facades\DB;

class ItemRepository
{
    public function Store(Item $item): int
    {
        try {
            $item->save();
            return $item->id;
        } catch (\Throwable $th) {
            throw new CustomException($th->getMessage());
        }
    }

    public function Update(array $newItemData, Item $item): void
    {
        try {
            $item->update($newItemData);
        } catch (\Throwable $th) {
            throw new CustomException($th->getMessage());
        }
    }

    public function Delete(Item $item): void
    {
        try {
            $item->delete();
        } catch (\Throwable $th) {
            throw new CustomException($th->getMessage());
        }
    }

    public function getFilterByType(string $type): Collection
    {
        try {
            return DB::table('items')->where('type', $type)->get();
        } catch (\Throwable $th) {
            throw new CustomException($th->getMessage());
        }
    }

    public function getSortAlphabetically(string $sortData): Collection
    {
        try {
            return DB::table('items')->orderBy('name', $sortData)->get();
        } catch (\Throwable $th) {
            throw new CustomException($th->getMessage());
        }
    }

    public function getSortRating(string $sortData): Collection
    {
        try {
            return DB::table('items')->orderBy('rating', $sortData)->get();
        } catch (\Throwable $th) {
            throw new CustomException($th->getMessage());
        }
    }
}
