<x-app-layout>
    <x-slot name="header">
        <div class="flex items-center justify-between">
            <div>
                <h2 class="text-xl font-semibold leading-tight text-gray-800">Creer un poste</h2>
                <p class="mt-1 text-sm text-gray-600">Ajoutez un nouvel avis de recrutement.</p>
            </div>
            <a href="{{ route('admin.postes.index') }}" class="text-sm text-gray-600 hover:text-gray-900">
                Retour a la liste
            </a>
        </div>
    </x-slot>

    <div class="py-12">
        <div class="mx-auto max-w-4xl sm:px-6 lg:px-8">
            <div class="overflow-hidden bg-white shadow-sm sm:rounded-lg">
                <div class="p-6">
                    <form method="POST" action="{{ route('admin.postes.store') }}" enctype="multipart/form-data" class="space-y-6">
                        @csrf

                        @include('admin.job_postings.partials.form')

                        <div class="flex items-center justify-end gap-3">
                            <a href="{{ route('admin.postes.index') }}" class="text-sm text-gray-600 hover:text-gray-900">
                                Annuler
                            </a>
                            <button type="submit"
                                    class="inline-flex items-center rounded-md bg-indigo-600 px-4 py-2 text-sm font-medium text-white hover:bg-indigo-700">
                                Enregistrer
                            </button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>
