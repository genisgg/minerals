<x-guest-layout>
    <div class="py-5 bg-gray-100">
        <div class="container max-w-7xl mx-auto sm:px-6 lg:px-8">

            <!-- Categories -->
            <section class="mb-12">
                <h2 class="font-semibold text-lg text-gray-800 mb-6">{{ __('Categories') }}</h2>
                <div class="flex flex-wrap gap-4">
                    <!-- Botó per a "Tots els minerals" -->
                    <button 
                        class="category-btn bg-indigo-600 text-white rounded-lg shadow px-6 py-2 hover:shadow-lg transition" 
                        onclick="filterMinerals('all')">
                        {{ __('Tots els minerals') }}
                    </button>

                    <!-- Categories dinàmiques -->
                    @foreach ($minerals->pluck('categoria.nom')->unique() as $categoria)
                        <button 
                            class="category-btn bg-white rounded-lg shadow px-6 py-2 hover:shadow-lg transition" 
                            onclick="filterMinerals('{{ strtolower($categoria) }}')">
                            {{ ucfirst($categoria) }}
                        </button>
                    @endforeach
                </div>
            </section>

            <!-- Llista de Minerals -->
            <section>
                <h2 class="font-semibold text-lg text-gray-800 mb-6">{{ __('Tots els minerals') }}</h2>
                <div class="grid grid-cols-1 sm:grid-cols-2 md:grid-cols-4 gap-8" id="mineral-container">
                    @foreach ($minerals as $mineral)
                        <div class="bg-white rounded-lg shadow p-4 hover:shadow-lg transition mineral-card" data-category="{{ strtolower($mineral->categoria->nom) }}">
                            <img src="https://via.placeholder.com/200x200" alt="{{ $mineral->nom }}" class="w-full h-48 object-cover rounded-md mb-4">
                            <h3 class="font-medium text-gray-700 text-center mb-2">{{ $mineral->nom }}</h3>
                            <p class="text-gray-500 text-sm text-center">Categoria: {{ $mineral->categoria->nom }}</p>
                            <p class="text-indigo-600 font-bold text-center">{{ $mineral->preu }} €</p>
                        </div>
                    @endforeach
                </div>
            </section>
        </div>
    </div>

    <!-- Footer separat -->
    <div class="mt-16">
        <x-footer />
    </div>

    <!-- Script per gestionar el filtre -->
    <script>
        function filterMinerals(category) {
            const allMinerals = document.querySelectorAll('.mineral-card');

            // Mostra o amaga els minerals segons la categoria seleccionada
            allMinerals.forEach(mineral => {
                if (category === 'all' || mineral.dataset.category === category) {
                    mineral.style.display = 'block';
                } else {
                    mineral.style.display = 'none';
                }
            });

            // Actualitza l'estil dels botons de categories
            document.querySelectorAll('.category-btn').forEach(button => {
                button.classList.remove('bg-indigo-600', 'text-white');
            });

            event.target.classList.add('bg-indigo-600', 'text-white');
        }

        // Carrega inicial: mostra tots els minerals
        document.addEventListener('DOMContentLoaded', () => filterMinerals('all'));
    </script>
</x-guest-layout>
