<?php

namespace App\Services\Contracts;

use Illuminate\Pagination\LengthAwarePaginator;

interface BookmarkServiceInterface
{
    public function loadBookmarksForDashboard(): LengthAwarePaginator;
}
