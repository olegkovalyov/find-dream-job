<?php

namespace App\Http\Controllers;

use App\Services\Contracts\JobServiceInterface;

class HomeController extends Controller
{
    public function __construct(
        private readonly JobServiceInterface $jobService
    ) {
    }

    public function index()
    {
        $jobs = $this->jobService->loadForHomePage();
        return view('home.index', compact(['jobs']));
    }
}
