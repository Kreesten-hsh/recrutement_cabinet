<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class JobPosting extends Model
{
    protected $fillable = [
        'title',
        'status',
        'type',
        'description',
        'attributions',
        'competences',
        'diplome',
        'experience',
        'aptitudes',
        'pieces_required',
        'document_path',
        'published_at',
    ];

    protected $casts = [
        'attributions' => 'array',
        'aptitudes' => 'array',
        'pieces_required' => 'array',
        'published_at' => 'datetime',
    ];

    public function applications()
    {
        return $this->hasMany(Application::class);
    }

    public function scopeEnCours($query)
    {
        return $query->where('status', 'en_cours');
    }

    public function scopePublished($query)
    {
        return $query->whereNotNull('published_at')->orderBy('published_at', 'desc');
    }
}
