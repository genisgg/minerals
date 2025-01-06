<x-guest-layout>
    <div class="py-5 bg-gray-100">
        <div class="container max-w-7xl mx-auto sm:px-6 lg:px-8 mb-24">
            <h2 class="font-semibold text-lg text-gray-800 mb-6">{{ __("Editar Categoria") }}</h2>

            <form method="POST" action="{{ route('categories.update', $categoria->id) }}">
                @csrf
                @method('PUT')

                <!-- ID Categoria -->
                <div class="mb-4">
                    <x-input-label for="id" :value="__('ID de la Categoria')" />
                    <x-text-input id="id" name="id" type="number" class="mt-1 block w-full" value="{{ $categoria->id }}" required />
                    <x-input-error :messages="$errors->get('id')" class="mt-2" />
                </div>

                <!-- Nom Categoria -->
                <div class="mb-4">
                    <x-input-label for="nom_categoria" :value="__('Nom de la Categoria')" />
                    <x-text-input id="nom_categoria" name="nom_categoria" type="text" class="mt-1 block w-full"
                                  value="{{ $categoria->nom_categoria }}" required />
                    <x-input-error :messages="$errors->get('nom_categoria')" class="mt-2" />
                </div>

                <!-- Botó Guardar Canvis -->
                <div class="mt-6">
                    <button type="submit" class="bg-indigo-600 text-white font-bold py-2 px-4 rounded hover:bg-indigo-700 focus:outline-none focus:ring-2 focus:ring-indigo-500 focus:ring-offset-2">
                        {{ __("Guardar Canvis") }}
                    </button>
                </div>
            </form>
        </div>
    </div>
</x-guest-layout>
