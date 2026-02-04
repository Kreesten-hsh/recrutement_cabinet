<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Application extends Model
{
    protected $fillable = [
        'job_posting_id',
        'nom',
        'prenom',
        'email',
        'telephone',
        'cv_path',
        'diploma_path',
        'motivation_letter_path',
    ];

    public function jobPosting()
    {
        return $this->belongsTo(JobPosting::class);
    }
}
