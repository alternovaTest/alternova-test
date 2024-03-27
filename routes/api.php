<?php

use App\Http\Controllers\AuthenticationController;
use App\Http\Controllers\ExtraPointController;
use App\Http\Controllers\ItemController;
use App\Http\Controllers\UsersCommentController;
use App\Http\Controllers\UsersRatingController;
use App\Models\Item;
use App\Models\UsersComment;
use App\Models\UsersRating;
use Illuminate\Support\Facades\Route;

/** AUTHENTICATION */
Route::post('/login', [AuthenticationController::class, 'Login']);

Route::middleware('auth:sanctum')->group(function() {

    Route::post('/logout', [AuthenticationController::class, 'Logout']);

    /** ITEMS */
    Route::post('/items', [ItemController::class, 'Create'])->can('Create', Item::class);
    Route::put('/items/{item}', [ItemController::class, 'Update'])->can('Update', Item::class);
    Route::delete('/items/{item}', [ItemController::class, 'Delete'])->can('Delete', Item::class);
    Route::get('/items/filter', [ItemController::class, 'filterByType'])->can('filterByType', Item::class);

    Route::middleware('can:sortAlphabetically, App\Models\Item')->group(function() {
        Route::get('/items/sort-alphabetically', [ItemController::class, 'sortAlphabetically']);
        Route::get('/items/sort-rating', [ItemController::class, 'sortRating']);
    });

    /** USER RATINGS */
    Route::post('/items/{item}/ratings', [UsersRatingController::class, 'Create'])->can('Create', UsersRating::class);

    /** USER COMMENTS */
    Route::post('/items/{item}/comments', [UsersCommentController::class, 'Create'])->can('Create', UsersComment::class);

    /** EXTRA POINT */
    Route::get('/extra-point', [ExtraPointController::class, 'stringReduction']);

});