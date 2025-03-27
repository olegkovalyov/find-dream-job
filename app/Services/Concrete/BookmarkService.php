<?php

namespace App\Services\Concrete;

use App\Services\Contracts\BookmarkServiceInterface;
use Illuminate\Pagination\LengthAwarePaginator;
use Illuminate\Support\Facades\Auth;

class BookmarkService implements BookmarkServiceInterface
{
    public function loadBookmarksForDashboard(): LengthAwarePaginator
    {
        $user = Auth::user();
        $bookmarks = $user->bookmarkedJobs()
            ->orderBy('job_user_bookmarks.created_at', 'desc')
            ->paginate(6);
        return $bookmarks;
    }
}
