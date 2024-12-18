<x-guest-layout>
    <div class="py-5 bg-gray-100">
        <div class="container max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
            <h2 class="font-semibold text-lg text-gray-800 mb-6">El teu Carrito</h2>

            <!-- Mostra el número total de productes -->
            <div class="bg-white rounded-lg shadow p-4 mb-6">
                <p class="text-gray-700 text-lg">
                    Tens <span id="product-count" class="font-bold">{{ count($carrito) }}</span> producte(s) al carrito.
                </p>
            </div>

            <!-- Llista de productes -->
            <div class="bg-white rounded-lg shadow p-4">
                @if(count($carrito) > 0)
                    <ul>
                        @foreach($carrito as $producte)
                            <li class="border-b border-gray-200 py-2 flex justify-between">
                                <span class="font-medium text-gray-800">{{ $producte['nom'] }}</span>
                                <span class="text-indigo-600">{{ $producte['preu'] }} €</span>
                            </li>
                        @endforeach
                    </ul>
                @else
                    <p class="text-gray-700">El carrito està buit.</p>
                @endif
            </div>
        </div>
    </div>
</x-guest-layout>
