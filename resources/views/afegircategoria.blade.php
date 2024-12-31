<x-guest-layout>
    <div class="py-5 bg-gray-100">
        <div class="container max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
            <h2 class="font-semibold text-lg text-gray-800 mb-6">{{ __("Afegir Categoria") }}</h2>

            <form method="POST" action="{{ route('categories.store') }}">
                @csrf

                <!-- ID Categoria -->
                <div class="mb-4">
                    <x-input-label for="id" :value="__('ID de la Categoria')" />
                    <x-text-input id="id" name="id" type="number" class="mt-1 block w-full" required />
                    <x-input-error :messages="$errors->get('id')" class="mt-2" />
                </div>

                <!-- Nom Categoria -->
                <div class="mb-4">
                    <x-input-label for="nom_categoria" :value="__('Nom de la Categoria')" />
                    <x-text-input id="nom_categoria" name="nom_categoria" type="text" class="mt-1 block w-full" required />
                    <x-input-error :messages="$errors->get('nom_categoria')" class="mt-2" />
                </div>

                <!-- Botó Afegir Categoria -->
                <div class="mt-6">
                    <button type="submit" class="bg-blue-600 text-white font-bold py-2 px-4 rounded hover:bg-blue-700 focus:outline-none focus:ring-2 focus:ring-blue-500 focus:ring-offset-2">
                        {{ __("Afegir Categoria") }}
                    </button>
                </div>
            </form>
        </div>
    </div>
</x-guest-layout>
