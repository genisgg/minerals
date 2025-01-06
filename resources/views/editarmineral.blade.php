<x-guest-layout>
    <div class="py-5 bg-gray-100">
        <div class="container max-w-7xl mx-auto sm:px-6 lg:px-8">
            <h2 class="font-semibold text-lg text-gray-800 mb-6"> {{ __("Editar el Mineral") }}</h2>
            <form method="POST" action="{{ route('minerals.update', $mineral->id) }}" enctype="multipart/form-data" class="bg-white p-6 rounded-lg shadow-md">
                @csrf
                @method('PATCH')
                <div class="mb-4">
                    <label for="nom" class="block text-gray-700 font-medium">{{ __("Nom del Mineral") }}</label>
                    <input type="text" id="nom" name="nom" value="{{ $mineral->nom }}" class="w-full border-gray-300 rounded-md shadow-sm" required>
                </div>

                <div class="mb-4">
                    <label for="preu" class="block text-gray-700 font-medium">{{ __("Preu (€)") }}</label>
                    <input type="number" id="preu" name="preu" value="{{ $mineral->preu }}" class="w-full border-gray-300 rounded-md shadow-sm" required>
                </div>

                <div class="mb-4">
                    <label for="categoria" class="block text-gray-700 font-medium">{{ __('Categoria') }}</label>
                    <select id="categoria" name="categoria_id" class="form-control">
                        @foreach ($categories as $categoria)
                            <option value="{{ $categoria->id }}" {{ $mineral->categoria_id == $categoria->id ? 'selected' : '' }}>
                                {{ $categoria->nom_categoria }}
                            </option>
                        @endforeach
                    </select>
                </div>
                

                <div class="mb-4">
                    <label for="descripcio" class="block text-gray-700 font-medium">{{ __("Descripció") }}</label>
                    <textarea id="descripcio" name="descripcio" rows="4" class="w-full border-gray-300 rounded-md shadow-sm" required>{{ $mineral->descripcio }}</textarea>
                </div>

                <div class="mb-4">
                    <label for="foto" class="block text-gray-700 font-medium">{{ __("Foto del Mineral (opcional)") }}</label>
                    <input type="file" id="foto" name="foto" class="w-full border-gray-300 rounded-md shadow-sm" accept="image/*">
                    <p class="mt-2 text-sm text-gray-500">{{ __("Foto actual:") }} {{ $mineral->foto }}</p>
                </div>
                
                <div>
                    <button type="submit" class="bg-indigo-600 text-white rounded-lg px-4 py-2">{{ __("Guardar canvis") }}</button>
                </div>
            </form>
        </div>
    </div>

    <script>
        function selectCategory(categoryId, button) {
            document.getElementById('categoria_id').value = categoryId;

            // Marca el botó seleccionat i desmarca els altres
            const buttons = document.querySelectorAll('.category-btn');
            buttons.forEach(btn => {
                btn.classList.remove('bg-indigo-600', 'text-white');
                btn.classList.add('bg-white', 'text-gray-700');
            });
            button.classList.add('bg-indigo-600', 'text-white');
            button.classList.remove('bg-white', 'text-gray-700');
        }
    </script>
</x-guest-layout>
