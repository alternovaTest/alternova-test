<?php

namespace App\Http\Controllers;

use App\Http\Requests\ExtraPointRequest;
use App\Services\ExtraPointService;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;

class ExtraPointController extends Controller
{
    public function __construct(
        private ExtraPointService $extraPointService
    ) {}

    public function stringReduction(ExtraPointRequest $extraPointRequest): JsonResponse
    {
        return $this->extraPointService->stringReduction($extraPointRequest->validated());
    }
}
