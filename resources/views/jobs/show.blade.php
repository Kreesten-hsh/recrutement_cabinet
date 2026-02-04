@extends('layouts.app')

@section('title', $jobPosting->title)

@section('content')
<style>
    .job-detail {
        background: white;
        padding: 2.5rem;
        border-radius: 12px;
        box-shadow: 0 4px 20px rgba(0, 0, 0, 0.1);
        margin-bottom: 2rem;
    }

    .job-meta {
        display: grid;
        grid-template-columns: repeat(auto-fit, minmax(200px, 1fr));
        gap: 1.5rem;
        margin-bottom: 2rem;
        padding-bottom: 2rem;
        border-bottom: 2px solid #e2e8f0;
    }

    .meta-item {
        display: flex;
        flex-direction: column;
    }

    .meta-label {
        font-size: 0.85rem;
        color: #718096;
        font-weight: 600;
        text-transform: uppercase;
        margin-bottom: 0.5rem;
    }

    .meta-value {
        font-size: 1.1rem;
        color: #2d3748;
        font-weight: 600;
    }

    .status-badge {
        display: inline-block;
        padding: 0.5rem 1.2rem;
        border-radius: 20px;
        font-size: 0.9rem;
        font-weight: 700;
        text-transform: uppercase;
    }

    .status-en_cours {
        background: #d4edda;
        color: #155724;
    }

    .status-cloture {
        background: #f8d7da;
        color: #721c24;
    }

    .type-badge {
        display: inline-block;
        padding: 0.5rem 1.2rem;
        border-radius: 20px;
        background: #667eea;
        color: white;
        font-weight: 600;
    }

    .document-link {
        color: #667eea;
        text-decoration: none;
        font-weight: 600;
        transition: all 0.3s;
    }

    .document-link:hover {
        color: #5568d3;
        text-decoration: underline;
    }

    .section {
        margin-bottom: 2rem;
    }

    .section-title {
        font-size: 1.4rem;
        font-weight: 700;
        color: #2d3748;
        margin-bottom: 1rem;
        padding-bottom: 0.5rem;
        border-bottom: 3px solid #667eea;
        display: inline-block;
    }

    .description-text {
        line-height: 1.8;
        color: #4a5568;
        font-size: 1rem;
    }

    .list-styled {
        list-style: none;
        padding: 0;
    }

    .list-styled li {
        padding: 0.75rem 0;
        padding-left: 2rem;
        position: relative;
        color: #4a5568;
        line-height: 1.6;
    }

    .list-styled li:before {
        content: "✓";
        position: absolute;
        left: 0;
        color: #667eea;
        font-weight: bold;
        font-size: 1.2rem;
    }

    .profile-grid {
        display: grid;
        grid-template-columns: repeat(auto-fit, minmax(250px, 1fr));
        gap: 1.5rem;
        margin-top: 1rem;
    }

    .profile-item h4 {
        font-size: 1rem;
        font-weight: 600;
        color: #667eea;
        margin-bottom: 0.5rem;
    }

    .profile-item p {
        color: #4a5568;
        line-height: 1.6;
    }

    .application-section {
        background: linear-gradient(135deg, #667eea 0%, #764ba2 100%);
        padding: 2.5rem;
        border-radius: 12px;
        box-shadow: 0 8px 30px rgba(102, 126, 234, 0.3);
        color: white;
    }

    .application-section h2 {
        font-size: 1.8rem;
        margin-bottom: 1.5rem;
        text-align: center;
    }

    .form-grid {
        display: grid;
        grid-template-columns: repeat(auto-fit, minmax(250px, 1fr));
        gap: 1.5rem;
    }

    .form-group {
        display: flex;
        flex-direction: column;
    }

    .form-group.full-width {
        grid-column: 1 / -1;
    }

    .form-label {
        font-weight: 600;
        margin-bottom: 0.5rem;
        font-size: 0.95rem;
    }

    .form-label.required:after {
        content: " *";
        color: #ffd700;
    }

    .form-input, .form-file {
        padding: 0.75rem 1rem;
        border: 2px solid rgba(255, 255, 255, 0.3);
        border-radius: 8px;
        font-size: 1rem;
        background: rgba(255, 255, 255, 0.9);
        color: #2d3748;
        transition: all 0.3s;
    }

    .form-input:focus, .form-file:focus {
        outline: none;
        border-color: white;
        background: white;
    }

    .form-file {
        padding: 0.5rem;
    }

    .error-message {
        color: #ffd700;
        font-size: 0.85rem;
        margin-top: 0.25rem;
    }

    .form-actions {
        display: flex;
        gap: 1rem;
        justify-content: center;
        margin-top: 2rem;
    }

    .btn {
        padding: 0.9rem 2.5rem;
        border: none;
        border-radius: 8px;
        font-weight: 700;
        cursor: pointer;
        font-size: 1rem;
        transition: all 0.3s;
        text-transform: uppercase;
    }

    .btn-submit {
        background: white;
        color: #667eea;
    }

    .btn-submit:hover {
        transform: translateY(-2px);
        box-shadow: 0 6px 20px rgba(255, 255, 255, 0.3);
    }

    .btn-cancel {
        background: rgba(255, 255, 255, 0.2);
        color: white;
        border: 2px solid white;
    }

    .btn-cancel:hover {
        background: rgba(255, 255, 255, 0.3);
    }

    .back-link {
        display: inline-block;
        margin-bottom: 1.5rem;
        color: white;
        text-decoration: none;
        font-weight: 600;
        transition: all 0.3s;
    }

    .back-link:hover {
        transform: translateX(-4px);
    }

    @media (max-width: 768px) {
        .job-meta {
            grid-template-columns: 1fr;
        }

        .form-grid {
            grid-template-columns: 1fr;
        }
    }
</style>

<a href="{{ route('jobs.index') }}" class="back-link">← Retour à la liste</a>

<div class="job-detail">
    <h1 style="font-size: 2rem; font-weight: 700; color: #2d3748; margin-bottom: 1.5rem;">
        {{ $jobPosting->title }}
    </h1>

    <div class="job-meta">
        <div class="meta-item">
            <span class="meta-label">Statut</span>
            <div class="meta-value">
                <span class="status-badge status-{{ $jobPosting->status }}">
                    {{ $jobPosting->status == 'en_cours' ? 'EN COURS' : 'CLÔTURÉ' }}
                </span>
            </div>
        </div>

        <div class="meta-item">
            <span class="meta-label">Type</span>
            <div class="meta-value">
                <span class="type-badge">{{ $jobPosting->type }}</span>
            </div>
        </div>

        @if($jobPosting->document_path)
        <div class="meta-item">
            <span class="meta-label">Document joint</span>
            <div class="meta-value">
                <a href="{{ Storage::url($jobPosting->document_path) }}" target="_blank" class="document-link">
                    Visualiser
                </a>
            </div>
        </div>
        @endif

        <div class="meta-item">
            <span class="meta-label">Date de publication</span>
            <div class="meta-value">
                {{ $jobPosting->published_at->format('d/m/Y') }} à {{ $jobPosting->published_at->format('H:i') }}
            </div>
        </div>
    </div>

    <div class="section">
        <h2 class="section-title">Brève description du poste</h2>
        <p class="description-text">{{ $jobPosting->description }}</p>
    </div>

    @if($jobPosting->attributions && count($jobPosting->attributions) > 0)
    <div class="section">
        <h2 class="section-title">Principales attributions</h2>
        <ul class="list-styled">
            @foreach($jobPosting->attributions as $attribution)
                <li>{{ $attribution }}</li>
            @endforeach
        </ul>
    </div>
    @endif

    <div class="section">
        <h2 class="section-title">Profil requis</h2>
        <div class="profile-grid">
            @if($jobPosting->competences)
            <div class="profile-item">
                <h4>Compétence</h4>
                <p>{{ $jobPosting->competences }}</p>
            </div>
            @endif

            @if($jobPosting->diplome)
            <div class="profile-item">
                <h4>Diplôme</h4>
                <p>{{ $jobPosting->diplome }}</p>
            </div>
            @endif

            @if($jobPosting->experience)
            <div class="profile-item">
                <h4>Expériences professionnelles</h4>
                <p>{{ $jobPosting->experience }}</p>
            </div>
            @endif
        </div>

        @if($jobPosting->aptitudes && count($jobPosting->aptitudes) > 0)
        <div style="margin-top: 1.5rem;">
            <h4 style="font-size: 1rem; font-weight: 600; color: #667eea; margin-bottom: 0.5rem;">Aptitudes</h4>
            <ul class="list-styled">
                @foreach($jobPosting->aptitudes as $aptitude)
                    <li>{{ $aptitude }}</li>
                @endforeach
            </ul>
        </div>
        @endif
    </div>

    @if($jobPosting->pieces_required && count($jobPosting->pieces_required) > 0)
    <div class="section">
        <h2 class="section-title">Pièces à fournir</h2>
        <ul class="list-styled">
            @foreach($jobPosting->pieces_required as $piece)
                <li>{{ $piece }}</li>
            @endforeach
        </ul>
    </div>
    @endif
</div>

@if($jobPosting->status == 'en_cours')
<div class="application-section">
    <h2>Candidature à l'avis de recrutement: {{ $jobPosting->title }}</h2>
    
    <form action="{{ route('applications.store') }}" method="POST" enctype="multipart/form-data">
        @csrf
        <input type="hidden" name="job_posting_id" value="{{ $jobPosting->id }}">

        <div class="form-grid">
            <div class="form-group">
                <label class="form-label" for="nom">Nom</label>
                <input 
                    type="text" 
                    id="nom" 
                    name="nom" 
                    class="form-input" 
                    value="{{ old('nom') }}"
                    required
                >
                @error('nom')
                    <span class="error-message">{{ $message }}</span>
                @enderror
            </div>

            <div class="form-group">
                <label class="form-label required" for="prenom">Prénom(s)</label>
                <input 
                    type="text" 
                    id="prenom" 
                    name="prenom" 
                    class="form-input" 
                    value="{{ old('prenom') }}"
                    required
                >
                @error('prenom')
                    <span class="error-message">{{ $message }}</span>
                @enderror
            </div>

            <div class="form-group">
                <label class="form-label" for="email">Adresse email</label>
                <input 
                    type="email" 
                    id="email" 
                    name="email" 
                    class="form-input" 
                    value="{{ old('email') }}"
                    required
                >
                @error('email')
                    <span class="error-message">{{ $message }}</span>
                @enderror
            </div>

            <div class="form-group">
                <label class="form-label" for="telephone">Téléphone</label>
                <input 
                    type="text" 
                    id="telephone" 
                    name="telephone" 
                    class="form-input" 
                    value="{{ old('telephone') }}"
                    required
                >
                @error('telephone')
                    <span class="error-message">{{ $message }}</span>
                @enderror
            </div>

            <div class="form-group">
                <label class="form-label" for="cv">Curriculum Vitae</label>
                <input 
                    type="file" 
                    id="cv" 
                    name="cv" 
                    class="form-file" 
                    accept=".pdf,.doc,.docx"
                    required
                >
                @error('cv')
                    <span class="error-message">{{ $message }}</span>
                @enderror
            </div>

            <div class="form-group">
                <label class="form-label" for="diploma">Dernier diplôme</label>
                <input 
                    type="file" 
                    id="diploma" 
                    name="diploma" 
                    class="form-file" 
                    accept=".pdf,.doc,.docx"
                    required
                >
                @error('diploma')
                    <span class="error-message">{{ $message }}</span>
                @enderror
            </div>

            <div class="form-group full-width">
                <label class="form-label" for="motivation_letter">Lettre de motivation</label>
                <input 
                    type="file" 
                    id="motivation_letter" 
                    name="motivation_letter" 
                    class="form-file" 
                    accept=".pdf,.doc,.docx"
                    required
                >
                @error('motivation_letter')
                    <span class="error-message">{{ $message }}</span>
                @enderror
            </div>
        </div>

        <div class="form-actions">
            <button type="reset" class="btn btn-cancel">Annuler</button>
            <button type="submit" class="btn btn-submit">Envoyer</button>
        </div>
    </form>
</div>
@else
<div class="job-detail" style="text-align: center; padding: 3rem;">
    <p style="color: #721c24; font-size: 1.2rem; font-weight: 600;">
        Cet avis de recrutement est clôturé. Les candidatures ne sont plus acceptées.
    </p>
</div>
@endif

@endsection
