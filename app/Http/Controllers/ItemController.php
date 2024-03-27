<?php

namespace App\Http\Controllers;

use App\Http\Requests\ItemBuildRequest;
use App\Http\Requests\SortTypeRequest;
use App\Http\Requests\TypeRequest;
use App\Models\Item;
use App\Services\ItemService;
use Illuminate\Http\JsonResponse;

class ItemController extends Controller
{
    public function __construct(
        private ItemService $itemService,
    ) {}

    public function Create(ItemBuildRequest $itemBuildRequest): JsonResponse
    {
        return $this->itemService->Create($itemBuildRequest->validated(), auth()->user());
    }

    public function Update(ItemBuildRequest $itemBuildRequest, Item $item): JsonResponse
    {
        return $this->itemService->Update($itemBuildRequest->validated(), auth()->user(), $item);
    }

    public function Delete(Item $item): JsonResponse
    {
        return $this->itemService->Delete($item);
    }

    public function filterByType(TypeRequest $typeRequest): JsonResponse
    {
        return $this->itemService->filterByType($typeRequest->validated());
    }

    public function sortAlphabetically(SortTypeRequest $sortTypeRequest): JsonResponse
    {
        return $this->itemService->sortAlphabetically($sortTypeRequest->validated());
    }

    public function sortRating(SortTypeRequest $sortTypeRequest): JsonResponse
    {
        return $this->itemService->sortRating($sortTypeRequest->validated());
    }
}
