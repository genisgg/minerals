<x-guest-layout>
    <div class="py-5 bg-gray-100">
        <div class="container max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
            <h2 class="font-semibold text-lg text-gray-800 mb-6">El teu Carrito</h2>

            <!-- Mostra el número total de productes -->
            <div class="bg-white rounded-lg shadow p-4 mb-6">
                <p class="text-gray-700 text-lg">
                    Tens <span id="product-count" class="font-bold">{{ count($carrito) }}</span> productes al carrito.
                </p>
            </div>

            <!-- Llista de productes -->
            <div class="bg-white rounded-lg shadow p-4">
                @if(count($carrito) > 0)
                    <ul id="carrito-list" class="space-y-4">
                        @foreach($carrito as $index => $producte)
                            <li class="border-b border-gray-200 pb-4 flex items-center justify-between">
                                <!-- Imatge i Informació -->
                                <div class="flex items-center space-x-4 w-1/3">
                                    <!-- Mini Foto -->
                                    <div class="w-20 h-20 flex-shrink-0">
                                        <img src="{{ asset($producte['foto']) }}" 
                                             alt="Foto del mineral" 
                                             class="object-cover w-full h-full rounded-md">
                                    </div>
                                    <!-- Nom i Preu per Unitat -->
                                    <div>
                                        <span class="block font-medium text-gray-800">{{ $producte['nom'] }}</span>
                                        <span class="text-gray-500 text-sm">Preu unitari: {{ number_format($producte['preu'], 2) }} €</span>
                                    </div>
                                </div>

                                <!-- Quantitat -->
                                <div class="w-1/3 text-center flex items-center justify-center">
                                    <span class="text-gray-600 mr-2">Quantitat:</span>
                                    <form action="{{ route('carrito.actualitzar') }}" method="POST" class="inline">
                                        @csrf
                                        <input type="hidden" name="index" value="{{ $index }}">
                                        <input type="number" name="quantitat" value="{{ $producte['quantitat'] ?? 1 }}" 
                                               min="1" class="w-16 border rounded px-2 text-center" 
                                               onchange="this.form.submit()">
                                    </form>
                                </div>

                                <!-- Preu Total per Producte -->
                                <div class="w-1/3 text-right flex items-center justify-end space-x-2">
                                    <span class="text-gray-600">Preu:</span>
                                    <span class="text-indigo-600 font-bold">
                                        {{ number_format($producte['preu'] * ($producte['quantitat'] ?? 1), 2) }} €
                                    </span>

                                    <!-- Paperera -->
                                    <form action="{{ route('carrito.borrar') }}" method="POST" class="inline ml-4">
                                        @csrf
                                        <input type="hidden" name="index" value="{{ $index }}">
                                        <button type="submit" class="text-red-500 hover:text-red-700">
                                            <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">
                                                <path stroke-linecap="round" stroke-linejoin="round" d="M6 18L18 6M6 6l12 12" />
                                            </svg>
                                        </button>
                                    </form>
                                </div>
                            </li>
                        @endforeach
                    </ul>

                    <!-- Total -->
                    <div class="mt-6 text-right">
                        <h3 class="text-xl font-semibold text-gray-800">
                            Total: <span class="text-indigo-600">{{ number_format($total, 2) }} €</span>
                        </h3>
                    </div>
                @else
                    <p class="text-gray-700">El carrito està buit.</p>
                @endif
            </div>
        </div>
    </div>
</x-guest-layout>