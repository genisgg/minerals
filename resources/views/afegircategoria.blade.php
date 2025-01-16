<x-guest-layout>
    <div class="py-5 bg-gray-100">
        <div class="container max-w-7xl mx-auto sm:px-6 lg:px-60 mb-24"> 
            <h2 class="font-semibold text-lg text-gray-800 mb-6">{{ __("Afegir Categoria a la botiga") }}</h2>
            <form method="POST" action="{{ route('categories.store') }}" class="bg-white p-6 rounded-lg shadow-md">
                @csrf

                <!-- ID Categoria -->
                <div class="mb-4">
                    <label for="id" class="block text-gray-700 font-medium">{{ __("ID de la Categoria") }}</label>
                    <input type="number" id="id" name="id" class="w-full border-gray-300 rounded-md shadow-sm" required>
                </div>

                <!-- Nom Categoria -->
                <div class="mb-4">
                    <label for="nom_categoria" class="block text-gray-700 font-medium">{{ __("Nom de la Categoria") }}</label>
                    <input type="text" id="nom_categoria" name="nom_categoria" class="w-full border-gray-300 rounded-md shadow-sm" required>
                </div>

                <!-- Botó Afegir Categoria -->
                <div>
                    <button type="submit" class="bg-indigo-600 text-white rounded-lg px-4 py-2">
                        {{ __("Afegir Categoria") }}
                    </button>
                </div>
            </form>
        </div>
    </div>
</x-guest-layout>
