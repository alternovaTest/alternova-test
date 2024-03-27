<?php

namespace App\Services;

use App\Factories\Contracts\CreationInterface;
use App\Models\Item;
use App\Models\User;
use App\Repositories\ItemRepository;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Response;
use Illuminate\Support\Facades\DB;

class ItemService
{
    public function __construct(
        private CreationInterface $itemFactory,
        private ItemRepository $itemRepository
    ) {}

    public function Create(array $itemData, User $user): JsonResponse
    {
        $itemData['user_name'] = $user->name;
        $item = $this->itemFactory->Create($itemData);
        $itemId = DB::transaction(function() use($item) {
            return $this->itemRepository->Store($item);
        }, 2);

        return response()->json([
            'message' => 'Ítem creado.',
            'item_id' => $itemId
        ], Response::HTTP_OK);
    }

    public function Update(array $newItemData, User $user, Item $item): JsonResponse
    {
        $newItemData['updated_by'] = $user->name;
        DB::transaction(function() use($newItemData, $item) {
            $this->itemRepository->Update($newItemData, $item);
        }, 2);
        
        return response()->json([
            'message' => 'Ítem actualizado.'
        ], Response::HTTP_OK);
    }

    public function Delete(Item $item): JsonResponse
    {
        DB::transaction(function() use($item){
            $this->itemRepository->Delete($item);
        }, 2);

        return response()->json([
            'message' => 'Ítem eliminado.'
        ], Response::HTTP_OK);
    }

    public function filterByType(array $typeData): JsonResponse
    {
        $items = $this->itemRepository->getFilterByType($typeData['type']);

        return response()->json([
            'message' => $typeData['type'] . ' ' . 'registradas.',
            'items' => $items->toArray()
        ], Response::HTTP_OK);
    }

    public function sortAlphabetically(array $sortTypeData): JsonResponse
    {
        $items = $this->itemRepository->getSortAlphabetically($sortTypeData['sort_type']);

        return response()->json([
            'message' => 'Ítems ordenados alfabéticamente',
            'items' => $items->toArray()
        ], Response::HTTP_OK);
    }

    public function sortRating(array $sortTypeData): JsonResponse
    {
        $items = $this->itemRepository->getSortRating($sortTypeData['sort_type']);

        return response()->json([
            'message' => 'Ítems ordenados por calificación',
            'items' => $items->toArray()
        ], Response::HTTP_OK);
    }
}
