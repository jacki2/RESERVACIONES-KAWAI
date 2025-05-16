<x-app-layout> 
    <x-slot name="header"> 
        <h2 class="font-semibold text-xl text-gray-800 dark:text-gray-200 leading-tight"> 
            {{__('Dashboard') }} 
        </h2> 
    </x-slot> 
    <!-- Pricing -->
    <div class="max-w-[85rem] px-4 py-10 sm:px-6 lg:px-8 lg:py-14 mx-auto">
        <!-- Title -->
        <div class="max-w-2xl mx-auto text-center mb-10 lg:mb-14">
            <h2 class="text-2xl font-bold md:text-4xl md:leading-tight dark:text-white">Platos del Día</h2>
            <p class="mt-1 text-gray-600 dark:text-gray-400">Selecciona tu menú preferido.</p>
        </div>
        <!-- End Title -->

        <!-- Grid -->
        <div class="mt-12 grid sm:grid-cols-1 lg:grid-cols-3 gap-6 lg:items-center">
            <!-- Card - Desayuno -->
            <div class="flex flex-col border border-gray-200 text-center rounded-xl p-8 dark:border-gray-700">
                <h4 class="font-medium text-lg text-gray-800 dark:text-gray-200">Desayuno</h4>
                <span class="mt-5 font-bold text-5xl text-gray-800 dark:text-gray-200">
                    <span class="font-bold text-2xl -me-2">S/</span>
                    9.00
                </span>
                <p class="mt-2 text-sm text-gray-500">Comienza tu día con energía</p>

                <a href="{{ route('checkout', ['plan' => 'premium_monthly']) }}" class="mt-5 py-3 px-4 inline-flex justify-center items-center gap-x-2 text-sm font-semibold rounded-lg border border-transparent bg-indigo-100 text-indigo-800 hover:bg-indigo-200 disabled:opacity-50 disabled:pointer-events-none dark:hover:bg-indigo-900 dark:text-indigo-400 dark:focus:outline-none dark:focus:ring-1 dark:focus:ring-gray-600">
                    Ordenar
                </a>
            </div>
            <!-- End Card -->

            <!-- Card - Almuerzo -->
            <div class="flex flex-col border-2 border-indigo-600 text-center shadow-xl rounded-xl p-8 dark:border-indigo-700">
                <p class="mb-3"><span class="inline-flex items-center gap-1.5 py-1.5 px-3 rounded-lg text-xs uppercase font-semibold bg-indigo-100 text-indigo-800 dark:bg-indigo-600 dark:text-white">Más popular</span></p>
                <h4 class="font-medium text-lg text-gray-800 dark:text-gray-200">Almuerzo</h4>
                <span class="mt-5 font-bold text-5xl text-gray-800 dark:text-gray-200">
                    <span class="font-bold text-2xl -me-2">S/</span>
                    14.50
                </span>
                <p class="mt-2 text-sm text-gray-500">El mejor almuerzo de la región</p>

                <a href="{{ route('checkout', ['plan' => 'premium_yearly']) }}" class="mt-5 py-3 px-4 inline-flex justify-center items-center gap-x-2 text-sm font-semibold rounded-lg border border-transparent bg-indigo-600 text-white hover:bg-indigo-700 disabled:opacity-50 disabled:pointer-events-none dark:focus:outline-none dark:focus:ring-1 dark:focus:ring-gray-600">
                    Ordenar
                </a>
            </div>
            <!-- End Card -->

            <!-- Card - Cena -->
            <div class="flex flex-col border border-gray-200 text-center rounded-xl p-8 dark:border-gray-700">
                <h4 class="font-medium text-lg text-gray-800 dark:text-gray-200">Cena</h4>
                <span class="mt-5 font-bold text-5xl text-gray-800 dark:text-gray-200">
                    <span class="font-bold text-2xl -me-2">S/</span>
                    16.50
                </span>
                <p class="mt-2 text-sm text-gray-500">Cena gourmet para cerrar tu día</p>

                <a href="{{ route('checkout', ['plan' => 'premium_lifetime']) }}" class="mt-5 py-3 px-4 inline-flex justify-center items-center gap-x-2 text-sm font-semibold rounded-lg border border-transparent bg-indigo-100 text-indigo-800 hover:bg-indigo-200 disabled:opacity-50 disabled:pointer-events-none dark:hover:bg-indigo-900 dark:text-indigo-400 dark:focus:outline-none dark:focus:ring-1 dark:focus:ring-gray-600">
                    Ordenar
                </a>
            </div>
            <!-- End Card -->
        </div>
        <!-- End Grid -->
    </div>
    <!-- End Pricing -->
</x-app-layout>