<x-guest-layout>
    <div class="py-5 bg-gray-100">
        <div class="container max-w-7xl mx-auto sm:px-6 lg:px-8">

            <!-- Categories -->
            <section class="mb-12">
                <h2 class="font-semibold text-lg text-gray-800 mb-6">Categories</h2>
                <div class="flex flex-wrap gap-4">
                    <button 
                        class="category-btn bg-indigo-600 text-white rounded-lg shadow px-6 py-2 hover:shadow-lg transition active" 
                        onclick="filterMinerals('all', this)">
                        Tots els minerals
                    </button>

                    @foreach ($categories as $categoria)
                        <button 
                            class="category-btn bg-white text-gray-700 rounded-lg shadow px-6 py-2 hover:shadow-lg transition" 
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
                        <div 
                            class="bg-white rounded-lg shadow p-4 hover:shadow-lg transition mineral-card" 
                            data-category-id="{{ $mineral->categoria_id }}">
                        
                            <img src="{{ $mineral->foto ?? 'https://via.placeholder.com/200x200' }}" 
                                 alt="{{ $mineral->nom }}" 
                                 class="w-full h-48 object-cover rounded-md mb-4">
                            <h3 class="font-medium text-gray-700 text-center mb-2">{{ $mineral->nom }}</h3>
                            <p class="text-gray-500 text-sm text-center">Preu:</p>
                            <p class="text-indigo-600 font-bold text-center">{{ $mineral->preu }} €</p>
                        </div>
                    @endforeach
                </div>
            </section>
        </div>
    </div>

    <div class="mt-16">
        <x-footer />
    </div>

    <script>
        function filterMinerals(categoryId, button) {
            const minerals = document.querySelectorAll('.mineral-card');
            const buttons = document.querySelectorAll('.category-btn');

            minerals.forEach(mineral => {
                mineral.style.display = (categoryId === 'all' || mineral.dataset.categoryId === categoryId) ? 'block' : 'none';
            });

            buttons.forEach(btn => {
                btn.classList.remove('bg-indigo-600', 'text-white');
                btn.classList.add('bg-white', 'text-gray-700');
            });

            button.classList.add('bg-indigo-600', 'text-white');
            button.classList.remove('bg-white', 'text-gray-700');
        }

        document.addEventListener('DOMContentLoaded', () => {
            const defaultButton = document.querySelector('.category-btn');
            filterMinerals('all', defaultButton);
        });
    </script>
</x-guest-layout>
