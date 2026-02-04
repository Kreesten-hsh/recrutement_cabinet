@php
    $jobPosting = $jobPosting ?? null;
    $attributions = old('attributions', $jobPosting?->attributions ?? ['']);
    $aptitudes = old('aptitudes', $jobPosting?->aptitudes ?? ['']);
    $piecesRequired = old('pieces_required', $jobPosting?->pieces_required ?? ['']);

    if (count($attributions) === 0) {
        $attributions = [''];
    }

    if (count($aptitudes) === 0) {
        $aptitudes = [''];
    }

    if (count($piecesRequired) === 0) {
        $piecesRequired = [''];
    }

    $publishedAtValue = old(
        'published_at',
        $jobPosting?->published_at?->format('Y-m-d\TH:i') ?? now()->format('Y-m-d\TH:i')
    );
@endphp

<div class="grid grid-cols-1 gap-6">
    <div>
        <label class="block text-sm font-medium text-gray-700">Titre</label>
        <input type="text" name="title" value="{{ old('title', $jobPosting?->title) }}" required
               class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-indigo-500 focus:ring-indigo-500">
        <x-input-error :messages="$errors->get('title')" class="mt-2" />
    </div>

    <div class="grid grid-cols-1 gap-6 md:grid-cols-3">
        <div>
            <label class="block text-sm font-medium text-gray-700">Statut</label>
            <select name="status" required
                    class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-indigo-500 focus:ring-indigo-500">
                @foreach (['en_cours' => 'En cours', 'cloture' => 'Cloture'] as $value => $label)
                    <option value="{{ $value }}" @selected(old('status', $jobPosting?->status) === $value)>{{ $label }}</option>
                @endforeach
            </select>
            <x-input-error :messages="$errors->get('status')" class="mt-2" />
        </div>

        <div>
            <label class="block text-sm font-medium text-gray-700">Type</label>
            <select name="type" required
                    class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-indigo-500 focus:ring-indigo-500">
                @foreach (['CDD', 'CDI', 'Stage', 'Freelance'] as $value)
                    <option value="{{ $value }}" @selected(old('type', $jobPosting?->type) === $value)>{{ $value }}</option>
                @endforeach
            </select>
            <x-input-error :messages="$errors->get('type')" class="mt-2" />
        </div>

        <div>
            <label class="block text-sm font-medium text-gray-700">Date de publication</label>
            <input type="datetime-local" name="published_at" value="{{ $publishedAtValue }}" required
                   class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-indigo-500 focus:ring-indigo-500">
            <x-input-error :messages="$errors->get('published_at')" class="mt-2" />
        </div>
    </div>

    <div>
        <label class="block text-sm font-medium text-gray-700">Description</label>
        <textarea name="description" rows="5" required
                  class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-indigo-500 focus:ring-indigo-500">{{ old('description', $jobPosting?->description) }}</textarea>
        <x-input-error :messages="$errors->get('description')" class="mt-2" />
    </div>

    <div class="grid grid-cols-1 gap-6 md:grid-cols-3">
        <div>
            <label class="block text-sm font-medium text-gray-700">Competences</label>
            <input type="text" name="competences" value="{{ old('competences', $jobPosting?->competences) }}"
                   class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-indigo-500 focus:ring-indigo-500">
            <x-input-error :messages="$errors->get('competences')" class="mt-2" />
        </div>

        <div>
            <label class="block text-sm font-medium text-gray-700">Diplome</label>
            <input type="text" name="diplome" value="{{ old('diplome', $jobPosting?->diplome) }}"
                   class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-indigo-500 focus:ring-indigo-500">
            <x-input-error :messages="$errors->get('diplome')" class="mt-2" />
        </div>

        <div>
            <label class="block text-sm font-medium text-gray-700">Experience</label>
            <input type="text" name="experience" value="{{ old('experience', $jobPosting?->experience) }}"
                   class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-indigo-500 focus:ring-indigo-500">
            <x-input-error :messages="$errors->get('experience')" class="mt-2" />
        </div>
    </div>

    <div class="grid grid-cols-1 gap-6 md:grid-cols-3">
        <div data-list-wrapper data-name="attributions">
            <label class="block text-sm font-medium text-gray-700">Attributions</label>
            <div class="mt-2 space-y-2" data-list-items>
                @foreach ($attributions as $value)
                    <div class="flex gap-2">
                        <input type="text" name="attributions[]" value="{{ $value }}"
                               class="block w-full rounded-md border-gray-300 shadow-sm focus:border-indigo-500 focus:ring-indigo-500">
                        <button type="button" data-list-remove
                                class="rounded-md bg-red-600 px-3 py-2 text-sm text-white hover:bg-red-700">
                            Supprimer
                        </button>
                    </div>
                @endforeach
            </div>
            <button type="button" data-list-add
                    class="mt-2 inline-flex items-center rounded-md bg-indigo-600 px-3 py-2 text-sm text-white hover:bg-indigo-700">
                Ajouter
            </button>
            <x-input-error :messages="$errors->get('attributions')" class="mt-2" />
        </div>

        <div data-list-wrapper data-name="aptitudes">
            <label class="block text-sm font-medium text-gray-700">Aptitudes</label>
            <div class="mt-2 space-y-2" data-list-items>
                @foreach ($aptitudes as $value)
                    <div class="flex gap-2">
                        <input type="text" name="aptitudes[]" value="{{ $value }}"
                               class="block w-full rounded-md border-gray-300 shadow-sm focus:border-indigo-500 focus:ring-indigo-500">
                        <button type="button" data-list-remove
                                class="rounded-md bg-red-600 px-3 py-2 text-sm text-white hover:bg-red-700">
                            Supprimer
                        </button>
                    </div>
                @endforeach
            </div>
            <button type="button" data-list-add
                    class="mt-2 inline-flex items-center rounded-md bg-indigo-600 px-3 py-2 text-sm text-white hover:bg-indigo-700">
                Ajouter
            </button>
            <x-input-error :messages="$errors->get('aptitudes')" class="mt-2" />
        </div>

        <div data-list-wrapper data-name="pieces_required">
            <label class="block text-sm font-medium text-gray-700">Pieces requises</label>
            <div class="mt-2 space-y-2" data-list-items>
                @foreach ($piecesRequired as $value)
                    <div class="flex gap-2">
                        <input type="text" name="pieces_required[]" value="{{ $value }}"
                               class="block w-full rounded-md border-gray-300 shadow-sm focus:border-indigo-500 focus:ring-indigo-500">
                        <button type="button" data-list-remove
                                class="rounded-md bg-red-600 px-3 py-2 text-sm text-white hover:bg-red-700">
                            Supprimer
                        </button>
                    </div>
                @endforeach
            </div>
            <button type="button" data-list-add
                    class="mt-2 inline-flex items-center rounded-md bg-indigo-600 px-3 py-2 text-sm text-white hover:bg-indigo-700">
                Ajouter
            </button>
            <x-input-error :messages="$errors->get('pieces_required')" class="mt-2" />
        </div>
    </div>

    <div>
        <label class="block text-sm font-medium text-gray-700">Document joint (PDF, DOC, DOCX)</label>
        <input type="file" name="document" accept=".pdf,.doc,.docx"
               class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-indigo-500 focus:ring-indigo-500">
        @if ($jobPosting?->document_path)
            <p class="mt-2 text-sm text-gray-600">
                Document actuel :
                <a href="{{ Storage::url($jobPosting->document_path) }}" class="text-indigo-600 hover:text-indigo-800" target="_blank" rel="noreferrer">
                    Voir le document
                </a>
            </p>
        @endif
        <x-input-error :messages="$errors->get('document')" class="mt-2" />
    </div>
</div>

<script>
    document.addEventListener('DOMContentLoaded', () => {
        document.querySelectorAll('[data-list-wrapper]').forEach((wrapper) => {
            const items = wrapper.querySelector('[data-list-items]');
            const addButton = wrapper.querySelector('[data-list-add]');
            const name = wrapper.dataset.name;

            const addItem = (value = '') => {
                const row = document.createElement('div');
                row.className = 'flex gap-2';
                row.innerHTML = `
                    <input type="text" name="${name}[]" value="${value}"
                        class="block w-full rounded-md border-gray-300 shadow-sm focus:border-indigo-500 focus:ring-indigo-500">
                    <button type="button" data-list-remove
                        class="rounded-md bg-red-600 px-3 py-2 text-sm text-white hover:bg-red-700">
                        Supprimer
                    </button>
                `;
                items.appendChild(row);
            };

            addButton.addEventListener('click', () => addItem());

            wrapper.addEventListener('click', (event) => {
                if (event.target.matches('[data-list-remove]')) {
                    const row = event.target.closest('div');
                    if (row && items.children.length > 1) {
                        row.remove();
                    } else {
                        const input = row.querySelector('input');
                        if (input) {
                            input.value = '';
                        }
                    }
                }
            });
        });
    });
</script>
