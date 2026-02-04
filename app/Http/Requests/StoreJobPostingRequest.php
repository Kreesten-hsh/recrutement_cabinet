<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class StoreJobPostingRequest extends FormRequest
{
    public function authorize(): bool
    {
        return true;
    }

    public function rules(): array
    {
        return [
            'title' => ['required', 'string', 'max:255'],
            'status' => ['required', 'in:en_cours,cloture'],
            'type' => ['required', 'in:CDD,CDI,Stage,Freelance'],
            'description' => ['required', 'string'],
            'attributions' => ['nullable', 'array'],
            'attributions.*' => ['nullable', 'string'],
            'competences' => ['nullable', 'string'],
            'diplome' => ['nullable', 'string'],
            'experience' => ['nullable', 'string'],
            'aptitudes' => ['nullable', 'array'],
            'aptitudes.*' => ['nullable', 'string'],
            'pieces_required' => ['nullable', 'array'],
            'pieces_required.*' => ['nullable', 'string'],
            'published_at' => ['required', 'date'],
            'document' => ['nullable', 'file', 'mimes:pdf,doc,docx', 'max:5120'],
        ];
    }
}
