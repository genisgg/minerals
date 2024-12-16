<x-guest-layout>
    <div class="py-5 bg-gray-100">
        <div class="container max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
            <!-- Mineral Seleccionat -->
            <section class="bg-white rounded-lg shadow p-6">
                <h2 class="font-semibold text-lg text-gray-800 mb-6 text-left">Mineral Seleccionat: </h2>

                <!-- Missatge per defecte si no hi ha cap mineral -->
                <div id="no-mineral" class="text-center text-gray-700">
                    <p class="text-lg">Seleccioneu un mineral per veure més informació</p>
                </div>

                <!-- Contingut del mineral -->
                <div id="mineral-container" class="flex flex-wrap gap-6 hidden">
                    <!-- Imatge del Mineral -->
                    <div class="flex-1 max-w-sm">
                        <img id="mineral-foto" src="" alt="Foto del mineral" class="w-full rounded-md shadow">
                    </div>
                    <!-- Informació del Mineral -->
                    <div class="flex-1 flex flex-col justify-between">
                        <div>
                            <h3 id="mineral-nom" class="text-2xl font-bold mb-4 text-gray-800"></h3>
                            <p id="mineral-preu" class="text-lg text-gray-700 mb-4"></p>
                            <p id="mineral-descripcio" class="text-gray-600 leading-relaxed"></p>
                        </div>
                        <!-- Botó Afegir al Carro -->
                        <div class="mt-6 text-right">
                            <button class="bg-indigo-600 text-white rounded-lg px-6 py-2 hover:bg-indigo-700">
                                Afegir al carro
                            </button>
                        </div>
                    </div>
                </div>
            </section>
        </div>
    </div>

    <script>
        document.addEventListener("DOMContentLoaded", function () {
            const params = new URLSearchParams(window.location.search);
            const foto = params.get('foto');
            const nom = params.get('nom');
            const preu = params.get('preu');
            const descripcio = params.get('descripcio');

            if (foto && nom && preu && descripcio) {
                // Mostra la informació del mineral
                document.getElementById("no-mineral").classList.add('hidden');
                document.getElementById("mineral-container").classList.remove('hidden');

                document.getElementById("mineral-foto").src = foto;
                document.getElementById("mineral-nom").innerText = nom;
                document.getElementById("mineral-preu").innerText = `Preu: ${preu} €`;
                document.getElementById("mineral-descripcio").innerText = descripcio;
            }
        });
    </script>
</x-guest-layout>
