<?php

namespace App\Services;

use Illuminate\Http\JsonResponse;
use Illuminate\Http\Response;

class ExtraPointService
{
    public function stringReduction(array $extraPointString): JsonResponse
    {
        $string = $extraPointString['string'];
        $auxiliaryArray = [];
    
        for ($i = 0; $i < strlen($string); $i++) {
            $currentCharacter = $string[$i];

            if (!empty($auxiliaryArray) && $auxiliaryArray[count($auxiliaryArray) - 1] === $currentCharacter) {
                array_pop($auxiliaryArray);
            } else {
                array_push($auxiliaryArray, $currentCharacter);
            }
        }
        
        $result = implode('', $auxiliaryArray);
        empty($result) ? $message = "Empty String" : $message = $result;

        return response()->json([
            'message' => $message
        ], Response::HTTP_OK);
    }
}
