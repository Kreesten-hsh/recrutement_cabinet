@extends('layouts.app')

@section('title', 'Avis de Recrutement')

@section('content')
<style>
    .search-section {
        background: white;
        padding: 2rem;
        border-radius: 12px;
        box-shadow: 0 4px 20px rgba(0, 0, 0, 0.1);
        margin-bottom: 2rem;
    }

    .search-form {
        display: flex;
        gap: 1rem;
        flex-wrap: wrap;
    }

    .search-input {
        flex: 1;
        min-width: 250px;
        padding: 0.75rem 1rem;
        border: 2px solid #e2e8f0;
        border-radius: 8px;
        font-size: 1rem;
        transition: all 0.3s;
    }

    .search-input:focus {
        outline: none;
        border-color: #667eea;
    }

    .btn {
        padding: 0.75rem 2rem;
        border: none;
        border-radius: 8px;
        font-weight: 600;
        cursor: pointer;
        transition: all 0.3s;
        font-size: 1rem;
    }

    .btn-primary {
        background: linear-gradient(135deg, #667eea 0%, #764ba2 100%);
        color: white;
    }

    .btn-primary:hover {
        transform: translateY(-2px);
        box-shadow: 0 6px 20px rgba(102, 126, 234, 0.4);
    }

    .content-wrapper {
        display: grid;
        grid-template-columns: 250px 1fr;
        gap: 2rem;
    }

    .sidebar {
        background: white;
        padding: 1.5rem;
        border-radius: 12px;
        box-shadow: 0 4px 20px rgba(0, 0, 0, 0.1);
        height: fit-content;
    }

    .sidebar h3 {
        font-size: 1.1rem;
        font-weight: 600;
        margin-bottom: 1rem;
        color: #667eea;
    }

    .filter-list {
        list-style: none;
    }

    .filter-list li {
        margin-bottom: 0.75rem;
    }

    .filter-list a {
        display: block;
        padding: 0.5rem 0.75rem;
        color: #4a5568;
        text-decoration: none;
        border-radius: 6px;
        transition: all 0.3s;
        font-size: 0.95rem;
    }

    .filter-list a:hover, .filter-list a.active {
        background: #667eea;
        color: white;
    }

    .jobs-list {
        display: flex;
        flex-direction: column;
        gap: 1.5rem;
    }

    .job-card {
        background: white;
        padding: 1.5rem;
        border-radius: 12px;
        box-shadow: 0 4px 20px rgba(0, 0, 0, 0.1);
        transition: all 0.3s;
        cursor: pointer;
    }

    .job-card:hover {
        transform: translateY(-4px);
        box-shadow: 0 8px 30px rgba(0, 0, 0, 0.15);
    }

    .job-header {
        display: flex;
        justify-content: space-between;
        align-items: start;
        margin-bottom: 1rem;
    }

    .job-status {
        display: inline-block;
        padding: 0.4rem 0.9rem;
        border-radius: 20px;
        font-size: 0.85rem;
        font-weight: 600;
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

    .job-title {
        font-size: 1.4rem;
        font-weight: 700;
        color: #2d3748;
        margin-bottom: 0.5rem;
    }

    .job-date {
        color: #718096;
        font-size: 0.9rem;
    }

    .job-description {
        color: #4a5568;
        margin-bottom: 1rem;
        line-height: 1.6;
    }

    .btn-details {
        background: #667eea;
        color: white;
        padding: 0.6rem 1.5rem;
        border-radius: 6px;
        text-decoration: none;
        display: inline-block;
        font-weight: 600;
        font-size: 0.9rem;
        transition: all 0.3s;
    }

    .btn-details:hover {
        background: #5568d3;
        transform: translateX(4px);
    }

    .pagination {
        display: flex;
        justify-content: center;
        gap: 0.5rem;
        margin-top: 2rem;
    }

    .pagination a, .pagination span {
        padding: 0.5rem 1rem;
        border: 1px solid #e2e8f0;
        border-radius: 6px;
        text-decoration: none;
        color: #4a5568;
        background: white;
        transition: all 0.3s;
    }

    .pagination a:hover {
        background: #667eea;
        color: white;
        border-color: #667eea;
    }

    .pagination .active {
        background: #667eea;
        color: white;
        border-color: #667eea;
    }

    .no-results {
        background: white;
        padding: 3rem;
        border-radius: 12px;
        text-align: center;
        color: #718096;
    }

    @media (max-width: 768px) {
        .content-wrapper {
            grid-template-columns: 1fr;
        }

        .search-form {
            flex-direction: column;
        }

        .search-input {
            min-width: 100%;
        }
    }
</style>

<div class="search-section">
    <form class="search-form" method="GET" action="{{ route('jobs.index') }}">
        <input 
            type="text" 
            name="search" 
            class="search-input" 
            placeholder="Rechercher un poste, une compétence..." 
            value="{{ request('search') }}"
        >
        <button type="submit" class="btn btn-primary">Rechercher</button>
    </form>
</div>

<div class="content-wrapper">
    <aside class="sidebar">
        <h3>Filtrer par date</h3>
        <ul class="filter-list">
            <li>
                <a href="{{ route('jobs.index', ['date_filter' => '1_week']) }}" 
                   class="{{ request('date_filter') == '1_week' ? 'active' : '' }}">
                    Il y a une semaine
                </a>
            </li>
            <li>
                <a href="{{ route('jobs.index', ['date_filter' => '1_month']) }}" 
                   class="{{ request('date_filter') == '1_month' ? 'active' : '' }}">
                    Il y a un mois
                </a>
            </li>
            <li>
                <a href="{{ route('jobs.index', ['date_filter' => 'last_month']) }}" 
                   class="{{ request('date_filter') == 'last_month' ? 'active' : '' }}">
                    Le mois dernier
                </a>
            </li>
            <li>
                <a href="{{ route('jobs.index') }}">Tous les avis</a>
            </li>
        </ul>
    </aside>

    <div>
        @if($jobPostings->isEmpty())
            <div class="no-results">
                <h3>Aucun avis de recrutement trouvé</h3>
                <p>Essayez de modifier vos critères de recherche</p>
            </div>
        @else
            <div class="jobs-list">
                @foreach($jobPostings as $job)
                    <div class="job-card" onclick="window.location='{{ route('jobs.show', $job->id) }}'">
                        <div class="job-header">
                            <div>
                                <span class="job-status status-{{ $job->status }}">
                                    {{ $job->status == 'en_cours' ? 'EN COURS' : 'CLÔTURÉ' }}
                                </span>
                            </div>
                        </div>
                        <h2 class="job-title">{{ $job->title }}</h2>
                        <p class="job-date">
                            Publié le {{ $job->published_at->format('d/m/Y') }} à {{ $job->published_at->format('H:i') }}
                        </p>
                        <p class="job-description">
                            {{ Str::limit($job->description, 200) }}
                        </p>
                        <a href="{{ route('jobs.show', $job->id) }}" class="btn-details" onclick="event.stopPropagation()">
                            DÉTAILS
                        </a>
                    </div>
                @endforeach
            </div>

            <div class="pagination">
                {{ $jobPostings->links() }}
            </div>
        @endif
    </div>
</div>
@endsection
