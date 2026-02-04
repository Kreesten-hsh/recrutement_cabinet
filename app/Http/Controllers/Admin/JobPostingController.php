<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\StoreJobPostingRequest;
use App\Http\Requests\UpdateJobPostingRequest;
use App\Models\JobPosting;
use Illuminate\Support\Facades\Storage;

class JobPostingController extends Controller
{
    public function index()
    {
        $jobPostings = JobPosting::orderByDesc('published_at')->paginate(15);

        return view('admin.job_postings.index', compact('jobPostings'));
    }

    public function create()
    {
        return view('admin.job_postings.create');
    }

    public function store(StoreJobPostingRequest $request)
    {
        $data = $this->prepareData($request);

        $jobPosting = JobPosting::create($data);

        return redirect()
            ->route('admin.postes.edit', $jobPosting)
            ->with('success', 'Poste cree avec succes.');
    }

    public function edit(JobPosting $jobPosting)
    {
        return view('admin.job_postings.edit', compact('jobPosting'));
    }

    public function update(UpdateJobPostingRequest $request, JobPosting $jobPosting)
    {
        $data = $this->prepareData($request, $jobPosting);

        $jobPosting->update($data);

        return redirect()
            ->route('admin.postes.edit', $jobPosting)
            ->with('success', 'Poste mis a jour avec succes.');
    }

    public function destroy(JobPosting $jobPosting)
    {
        if ($jobPosting->document_path) {
            Storage::disk('public')->delete($jobPosting->document_path);
        }

        $jobPosting->delete();

        return redirect()
            ->route('admin.postes.index')
            ->with('success', 'Poste supprime avec succes.');
    }

    private function prepareData(StoreJobPostingRequest|UpdateJobPostingRequest $request, ?JobPosting $jobPosting = null): array
    {
        $data = $request->validated();

        $data['attributions'] = $this->normalizeList($data['attributions'] ?? null);
        $data['aptitudes'] = $this->normalizeList($data['aptitudes'] ?? null);
        $data['pieces_required'] = $this->normalizeList($data['pieces_required'] ?? null);

        if ($request->hasFile('document')) {
            if ($jobPosting?->document_path) {
                Storage::disk('public')->delete($jobPosting->document_path);
            }

            $data['document_path'] = $request->file('document')->store('job_documents', 'public');
        }

        unset($data['document']);

        return $data;
    }

    private function normalizeList(?array $values): ?array
    {
        if (!$values) {
            return null;
        }

        $filtered = array_values(array_filter($values, fn ($value) => is_string($value) && trim($value) !== ''));

        return $filtered === [] ? null : $filtered;
    }
}
