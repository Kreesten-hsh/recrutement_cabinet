<x-app-layout>
    <x-slot name="header">
        <div class="flex flex-col gap-4 sm:flex-row sm:items-center sm:justify-between">
            <div>
                <h2 class="text-xl font-semibold leading-tight text-gray-800">Dashboard des postes</h2>
                <p class="mt-1 text-sm text-gray-600">Gerez les avis de recrutement publies.</p>
            </div>
            <a href="{{ route('admin.postes.create') }}"
               class="inline-flex items-center rounded-md bg-indigo-600 px-4 py-2 text-sm font-medium text-white hover:bg-indigo-700">
                Nouveau poste
            </a>
        </div>
    </x-slot>

    <div class="py-12">
        <div class="mx-auto max-w-7xl sm:px-6 lg:px-8">
            @if (session('success'))
                <div class="mb-6 rounded-md bg-green-50 px-4 py-3 text-sm text-green-700">
                    {{ session('success') }}
                </div>
            @endif

            <div class="overflow-hidden bg-white shadow-sm sm:rounded-lg">
                <div class="p-6">
                    @if ($jobPostings->isEmpty())
                        <div class="rounded-md border border-dashed border-gray-300 p-8 text-center text-gray-500">
                            Aucun poste pour le moment.
                        </div>
                    @else
                        <div class="overflow-x-auto">
                            <table class="min-w-full divide-y divide-gray-200">
                                <thead class="bg-gray-50">
                                    <tr>
                                        <th class="px-4 py-3 text-left text-xs font-medium uppercase tracking-wider text-gray-500">Titre</th>
                                        <th class="px-4 py-3 text-left text-xs font-medium uppercase tracking-wider text-gray-500">Statut</th>
                                        <th class="px-4 py-3 text-left text-xs font-medium uppercase tracking-wider text-gray-500">Type</th>
                                        <th class="px-4 py-3 text-left text-xs font-medium uppercase tracking-wider text-gray-500">Publie le</th>
                                        <th class="px-4 py-3 text-right text-xs font-medium uppercase tracking-wider text-gray-500">Actions</th>
                                    </tr>
                                </thead>
                                <tbody class="divide-y divide-gray-200 bg-white">
                                    @foreach ($jobPostings as $job)
                                        <tr>
                                            <td class="px-4 py-3 text-sm font-medium text-gray-900">
                                                {{ $job->title }}
                                            </td>
                                            <td class="px-4 py-3 text-sm text-gray-600">
                                                {{ $job->status === 'en_cours' ? 'En cours' : 'Cloture' }}
                                            </td>
                                            <td class="px-4 py-3 text-sm text-gray-600">{{ $job->type }}</td>
                                            <td class="px-4 py-3 text-sm text-gray-600">
                                                {{ $job->published_at?->format('d/m/Y H:i') }}
                                            </td>
                                            <td class="px-4 py-3 text-right text-sm">
                                                <a href="{{ route('admin.postes.edit', $job) }}" class="text-indigo-600 hover:text-indigo-900">
                                                    Modifier
                                                </a>
                                                <form method="POST" action="{{ route('admin.postes.destroy', $job) }}" class="inline">
                                                    @csrf
                                                    @method('DELETE')
                                                    <button type="submit" class="ml-3 text-red-600 hover:text-red-800"
                                                            onclick="return confirm('Supprimer ce poste ?')">
                                                        Supprimer
                                                    </button>
                                                </form>
                                            </td>
                                        </tr>
                                    @endforeach
                                </tbody>
                            </table>
                        </div>

                        <div class="mt-6">
                            {{ $jobPostings->links() }}
                        </div>
                    @endif
                </div>
            </div>
        </div>
    </div>
</x-app-layout>
