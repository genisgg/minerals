<x-guest-layout>
    <div class="py-5 bg-gray-100">
        <div class="container max-w-7xl mx-auto sm:px-6 lg:px-8">
            <h2 class="font-semibold text-lg text-gray-800 mb-6"> {{ __("Afegir el Mineral a la botiga") }}</h2>
            <form method="POST" action="{{ route('minerals.store') }}" enctype="multipart/form-data" class="bg-white p-6 rounded-lg shadow-md">
                @csrf
                <div class="mb-4">
                    <label for="nom" class="block text-gray-700 font-medium">{{ __("Nom del Mineral") }}</label>
                    <input type="text" id="nom" name="nom" class="w-full border-gray-300 rounded-md shadow-sm" required>
                </div>

                <div class="mb-4">
                    <label for="preu" class="block text-gray-700 font-medium">{{ __("Preu (€)") }}</label>
                    <input type="number" id="preu" name="preu" class="w-full border-gray-300 rounded-md shadow-sm" required>
                </div>

                <div class="mb-4">
                    <label class="block text-gray-700 font-medium">{{ __("Categoria del Mineral") }}</label>
                    <div class="flex flex-wrap gap-2">
                        @foreach($categories as $categoria)
                            <button type="button" 
                                    class="category-btn bg-white text-gray-700 rounded-lg px-4 py-2 flex-1 text-center border border-gray-300"
                                    onclick="selectCategory({{ $categoria->id }}, this)">
                                {{ $categoria->nom_categoria }}
                            </button>
                        @endforeach
                    </div>
                    <input type="hidden" id="categoria_id" name="categoria_id" required>
                </div>

                <div class="mb-4">
                    <label for="descripcio" class="block text-gray-700 font-medium">{{ __("Descripció") }}</label>
                    <textarea id="descripcio" name="descripcio" rows="4" class="w-full border-gray-300 rounded-md shadow-sm" required></textarea>
                </div>

                <div class="mb-4">
                    <label for="foto" class="block text-gray-700 font-medium">{{ __("Foto del Mineral") }}</label>
                    <input type="file" id="foto" name="foto" class="w-full border-gray-300 rounded-md shadow-sm" accept="image/*" required>
                </div>
                
                <div>
                    <button type="submit" class="bg-indigo-600 text-white rounded-lg px-4 py-2">{{ __("Afegir Mineral") }}</button>
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
