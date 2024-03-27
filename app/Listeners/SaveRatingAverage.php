<?php

namespace App\Listeners;

use App\Events\UpdateRating;
use App\Repositories\UsersRatingRepository;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Queue\InteractsWithQueue;

class SaveRatingAverage
{
    /**
     * Create the event listener.
     */
    public function __construct(
        private UsersRatingRepository $usersRatingRepository
    ) {}

    /**
     * Handle the event.
     */
    public function handle(UpdateRating $event): void
    {
        $item = $event->item;
        $averageRating = $this->usersRatingRepository->getAverageRatingByItem($item->id);
        $item->rating = $averageRating;
        $item->save();
    }
}
