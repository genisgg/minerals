<footer class="w-full bg-gray-900 text-white py-6">
  <div class="container mx-auto text-center">
    <!-- Frase destacada -->
    <p class="text-lg font-semibold mb-4">
      {{ __("La millor pàgina web per fer créixer la teva col·lecció de minerals!") }}
    </p>

    <!-- Informació de contacte -->
    <div class="mb-4 flex justify-center space-x-6">
      <p>{{ __("Telèfon:") }} 
        <span class="font-medium">+34 123 456 789</span>
      </p>
      <p>{{ __("Email:") }} 
        <span class="font-medium">contact@mineralsstore.com</span>
      </p>
    </div>
  </div>
</footer>

<style>
  footer {
    width: 100%;
    background-color: #1a202c; /* Fons gris fosc */
    color: white;
    padding: 20px 0;
    text-align: center;
    position: relative;
  }

  footer p {
    margin: 0;
  }

  footer .container {
    max-width: 100%;
    padding: 0 15px;
  }

</style>
