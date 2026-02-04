<?php

namespace App\Http\Controllers;

use App\Models\JobPosting;
use Illuminate\Http\Request;
use Carbon\Carbon;

class JobPostingController extends Controller
{
    public function index(Request $request)
    {
        $query = JobPosting::published();

        // Filtre de recherche
        if ($request->has('search') && $request->search) {
            $searchTerm = $request->search;
            $query->where(function ($q) use ($searchTerm) {
                $q->where('title', 'like', "%{$searchTerm}%")
                  ->orWhere('description', 'like', "%{$searchTerm}%");
            });
        }

        // Filtre par date
        if ($request->has('date_filter')) {
            $now = Carbon::now();
            switch ($request->date_filter) {
                case '1_week':
                    $query->where('published_at', '>=', $now->subWeek());
                    break;
                case '1_month':
                    $query->where('published_at', '>=', $now->subMonth());
                    break;
                case 'last_month':
                    $startOfLastMonth = $now->copy()->subMonth()->startOfMonth();
                    $endOfLastMonth = $now->copy()->subMonth()->endOfMonth();
                    $query->whereBetween('published_at', [$startOfLastMonth, $endOfLastMonth]);
                    break;
            }
        }

        $jobPostings = $query->paginate(10);

        return view('jobs.index', compact('jobPostings'));
    }

    public function show($id)
    {
        $jobPosting = JobPosting::with('applications')->findOrFail($id);
        
        return view('jobs.show', compact('jobPosting'));
    }
}
