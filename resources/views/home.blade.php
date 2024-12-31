<x-guest-layout>
    <div class="py-5 bg-gray-100">
        <div class="container max-w-7xl mx-auto sm:px-6 lg:px-8">
            <!-- Categories -->
            <section class="mb-12">
                <h2 class="font-semibold text-lg text-gray-800 mb-6 flex items-center justify-between">
                    {{ __("Categories") }}
                    @can('administrar')
                        <a href="{{ route('categories.create') }}">
                            <button class="bg-indigo-600 text-white rounded-lg px-4 py-2 text-center">
                                {{ __("Afegir Categoria") }}
                            </button>
                        </a>
                    @endcan
                </h2>
                <div class="grid grid-cols-2 md:grid-cols-3 lg:grid-cols-4 gap-4">
                    <div class="category-container bg-indigo-600 text-white p-4 rounded-lg shadow text-center cursor-pointer"
                         onclick="filterMinerals('all', this)">
                        <span class="font-medium">{{ __("Tots els minerals") }}</span>
                    </div>
                    @foreach ($categories as $categoria)
                        <div class="category-container bg-white text-gray-700 p-4 rounded-lg shadow text-center cursor-pointer"
                             onclick="filterMinerals('{{ $categoria->id }}', this)">
                            <span class="font-medium">{{ $categoria->nom_categoria }}</span>
                            @can('administrar')
                                <div class="flex justify-between mt-2">
                                    <!-- Botó Editar Categoria -->
                                    <a href="{{ route('categories.edit', $categoria->id) }}">
                                        <button class="bg-blue-600 text-white rounded-lg px-3 py-1 hover:bg-blue-700 text-sm">
                                            {{ __("Editar") }}
                                        </button>
                                    </a>
                                    <!-- Botó Eliminar Categoria -->
                                    <form action="{{ route('categories.destroy', $categoria->id) }}" method="POST">
                                        @csrf
                                        @method('DELETE')
                                        <button type="submit" class="bg-red-600 text-white rounded-lg px-3 py-1 hover:bg-red-700 text-sm">
                                            {{ __("Eliminar") }}
                                        </button>
                                    </form>
                                </div>
                            @endcan
                        </div>
                    @endforeach
                </div>
            </section>

            <!-- Llista de Minerals -->
            <section>
                <h2 class="font-semibold text-lg text-gray-800 mb-6 flex items-center justify-between">
                    {{ __("Tots els minerals") }}
                    @can('administrar')
                        <a href="{{ route('minerals.create') }}">
                            <button class="bg-indigo-600 text-white rounded-lg px-4 py-2 text-center">
                                {{ __("Afegir Mineral") }}
                            </button>
                        </a>
                    @endcan
                </h2>
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
                                <span class="text-gray-700 font-normal">{{ __("Nom: ") }}</span>
                                <span class="text-indigo-600 font-bold">{{ $mineral->nom }}</span>
                            </h3>
                            <p class="text-center">
                                <span class="text-gray-700 font-normal">{{ __("Preu: ") }}</span>
                                <span class="text-indigo-600 font-bold">{{ $mineral->preu }} €</span>
                            </p>

                            <!-- Botó + Info -->
                            <p class="text-blue-500 cursor-pointer text-center">
                                <a href="{{ route('productes', ['id' => $mineral->id]) }}">
                                    {{ __("+ Info") }}
                                </a>
                            </p>

                            <!-- (només admin) -->
                            @can('administrar')
                                <div class="flex justify-between mt-4">
                                    
                                    <!-- Botó Editar -->
                                    <a href="{{ route('minerals.edit', $mineral->id) }}" class="bg-indigo-600 text-white rounded-md px-3 py-1 text-sm font-semibold hover:bg-indigo-600">
                                        {{ __("Editar") }}
                                    </a>

                                    <!-- Botó Eliminar -->
                                    <form action="{{ route('minerals.destroy', $mineral->id) }}" method="POST">
                                        @csrf
                                        @method('DELETE')
                                        <button type="submit" class="bg-red-600 text-white rounded-md px-3 py-1 text-sm font-semibold hover:bg-red-700">
                                            {{ __("Eliminar") }}
                                        </button>
                                    </form>
                                </div>
                            @endcan
                        </div>
                    @endforeach
                </div>
            </section>
        </div>
    </div>

    <!-- Footer Spacer -->
    <div style="height: 100px;"></div>
    
    <script>
        function filterMinerals(categoryId, container) {
            const minerals = document.querySelectorAll('.mineral-card');
            const containers = document.querySelectorAll('.category-container');

            // Filtra els minerals segons la categoria seleccionada
            minerals.forEach(mineral => {
                mineral.style.display = (categoryId === 'all' || mineral.dataset.categoryId === categoryId) ? 'block' : 'none';
            });

            // Elimina la classe activa de totes les categories
            containers.forEach(cont => cont.classList.remove('bg-indigo-600', 'text-white'));
            containers.forEach(cont => cont.classList.add('bg-white', 'text-gray-700'));

            // Afegeix la classe activa a la categoria seleccionada
            container.classList.add('bg-indigo-600', 'text-white');
            container.classList.remove('bg-white', 'text-gray-700');
        }
    </script>
</x-guest-layout>
