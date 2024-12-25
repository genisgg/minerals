<x-guest-layout>
    <div class="py-40 bg-gray-100">
        <div class="container max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
            <!-- Mineral Seleccionat -->
            <section class="bg-white rounded-lg shadow p-6">
                <h2 class="font-semibold text-lg text-gray-800 mb-6 text-left">{{ __("Mineral Seleccionat: ") }}</h2>
                
                @if ($mineral)
                    <!-- Contingut del mineral -->
                    <div id="mineral-container" class="flex flex-wrap gap-6">
                        <!-- Imatge del Mineral -->
                        <div class="flex-1 max-w-sm">
                            <img id="mineral-foto" src="{{ asset($mineral->foto ?? 'img/placeholder.jpg') }}" alt="Foto del mineral" class="w-full rounded-md shadow">
                        </div>
                        <!-- Informació del Mineral -->
                        <div class="flex-1 flex flex-col justify-between">
                            <div>
                                <h3 id="mineral-nom" class="text-2xl font-bold mb-4 text-gray-800">{{ $mineral->nom }}</h3>
                                <p id="mineral-preu" class="text-lg text-gray-700 mb-4">Preu: {{ $mineral->preu }} €</p>
                                <p id="mineral-descripcio" class="text-gray-600 leading-relaxed">{{ $mineral->descripcio }}</p>
                            </div>
                            <!-- Botó Afegir al Carro -->
                            <div class="mt-6 text-right">
                                <form action="{{ route('carrito.afegir-id') }}" method="POST">
                                    @csrf
                                    <input type="hidden" name="id" value="{{ $mineral->id }}">
                                    <button type="submit" class="bg-green-600 text-white rounded-lg px-6 py-2 hover:bg-green-700">
                                        {{ __("Afegir al carrito") }}
                                    </button>
                                </form>
                            </div>
                        </div>
                    </div>
                @else
                    <!-- Missatge per defecte si no hi ha cap mineral -->
                    <div id="no-mineral" class="py-40 text-center text-gray-700">
                        <p class="text-lg">{{ __("Selecciona algun mineral per veure mes informació.") }}</p>
                    </div>
                @endif
            </section>
        </div>
    </div>
</x-guest-layout>
