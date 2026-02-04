<?php

namespace App\Http\Controllers;

use App\Models\Application;
use App\Models\JobPosting;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class ApplicationController extends Controller
{
    public function store(Request $request)
    {
        $validated = $request->validate([
            'job_posting_id' => 'required|exists:job_postings,id',
            'nom' => 'required|string|max:255',
            'prenom' => 'required|string|max:255',
            'email' => 'required|email|max:255',
            'telephone' => 'required|string|max:20',
            'cv' => 'required|file|mimes:pdf,doc,docx|max:5120',
            'diploma' => 'required|file|mimes:pdf,doc,docx|max:5120',
            'motivation_letter' => 'required|file|mimes:pdf,doc,docx|max:5120',
        ], [
            'prenom.required' => 'Le prénom est obligatoire.',
            'cv.required' => 'Le CV est obligatoire.',
            'cv.mimes' => 'Le CV doit être au format PDF, DOC ou DOCX.',
            'cv.max' => 'Le CV ne doit pas dépasser 5 Mo.',
            'diploma.required' => 'Le diplôme est obligatoire.',
            'diploma.mimes' => 'Le diplôme doit être au format PDF, DOC ou DOCX.',
            'diploma.max' => 'Le diplôme ne doit pas dépasser 5 Mo.',
            'motivation_letter.required' => 'La lettre de motivation est obligatoire.',
            'motivation_letter.mimes' => 'La lettre de motivation doit être au format PDF, DOC ou DOCX.',
            'motivation_letter.max' => 'La lettre de motivation ne doit pas dépasser 5 Mo.',
        ]);

        $jobPostingId = $validated['job_posting_id'];
        $candidateEmail = $validated['email'];
        
        $storagePath = "applications/{$jobPostingId}/{$candidateEmail}";

        // Upload des fichiers
        $cvPath = $request->file('cv')->store($storagePath, 'public');
        $diplomaPath = $request->file('diploma')->store($storagePath, 'public');
        $motivationLetterPath = $request->file('motivation_letter')->store($storagePath, 'public');

        Application::create([
            'job_posting_id' => $jobPostingId,
            'nom' => $validated['nom'],
            'prenom' => $validated['prenom'],
            'email' => $validated['email'],
            'telephone' => $validated['telephone'],
            'cv_path' => $cvPath,
            'diploma_path' => $diplomaPath,
            'motivation_letter_path' => $motivationLetterPath,
        ]);

        return redirect()->route('jobs.show', $jobPostingId)
            ->with('success', 'Votre candidature a été envoyée avec succès !');
    }
}
