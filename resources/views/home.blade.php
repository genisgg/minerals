<x-guest-layout>
    <div class="py-5 bg-gray-100">
        <div class="container max-w-7xl mx-auto sm:px-6 lg:px-8">
            <!-- Categories -->
            <section class="mb-12">
                <h2 class="font-semibold text-lg text-gray-800 mb-6">Categories</h2>
                <div class="flex flex-wrap justify-between gap-2">
                    <button class="category-btn bg-indigo-600 text-white rounded-lg px-4 py-2 flex-1 text-center"
                            onclick="filterMinerals('all', this)">
                        Tots els minerals
                    </button>
                    @foreach ($categories as $categoria)
                        <button class="category-btn bg-white text-gray-700 rounded-lg px-4 py-2 flex-1 text-center"
                                onclick="filterMinerals('{{ $categoria->id }}', this)">
                            {{ $categoria->nom_categoria }}
                        </button>
                    @endforeach
                </div>
            </section>

            <!-- Llista de Minerals -->
            <section>
                <h2 class="font-semibold text-lg text-gray-800 mb-6">Tots els minerals</h2>
                <div class="grid grid-cols-1 sm:grid-cols-2 md:grid-cols-4 gap-8" id="mineral-container">
                    @foreach ($minerals as $mineral)
                        <div class="mineral-card bg-white rounded-lg shadow p-4 hover:shadow-lg transition relative" 
                             data-category-id="{{ $mineral->categoria_id }}">
                            
                            <!-- Imatge -->
                            <div class="mineral-image h-48">
                                <img src="{{ asset($mineral->foto ?? 'img/placeholder.jpg') }}" 
                                     alt="{{ $mineral->nom }}" 
                                     class="w-full h-full object-cover rounded-md">
                            </div>

                            <!-- Nom i Preu -->
                            <h3 class="font-medium text-gray-700 text-center mt-4">
                                {{ $mineral->nom }}
                            </h3>
                            <p class="text-center">
                                <span class="text-gray-700 font-normal">Preu:</span>
                                <span class="text-indigo-600 font-bold">{{ $mineral->preu }} €</span>
                            </p>

                            <!-- Botó + Info -->
                            <p class="text-blue-500 cursor-pointer text-center">
                                <a href="{{ route('productes', ['id' => $mineral->id]) }}">
                                    {{ __("+ Info") }}
                                </a>
                            </p>
                        </div>
                    @endforeach
                </div>
            </section>
        </div>
    </div>

    <!-- Footer Spacer -->
    <div style="height: 100px;"></div>
    
    <script>
        function filterMinerals(categoryId, button) {
            const minerals = document.querySelectorAll('.mineral-card');
            const buttons = document.querySelectorAll('.category-btn');
    
            // Filtra els minerals segons la categoria seleccionada
            minerals.forEach(mineral => {
                mineral.style.display = (categoryId === 'all' || mineral.dataset.categoryId === categoryId) ? 'block' : 'none';
            });
    
            // Elimina la classe activa de totes les categories
            buttons.forEach(btn => {
                btn.classList.remove('bg-indigo-600', 'text-white');
                btn.classList.add('bg-white', 'text-gray-700');
            });
    
            // Afegeix la classe activa a la categoria seleccionada
            button.classList.add('bg-indigo-600', 'text-white');
            button.classList.remove('bg-white', 'text-gray-700');
        }
    </script>
</x-guest-layout>
