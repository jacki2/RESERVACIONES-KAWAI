@extends('layouts.app')

@section('title', 'Reservaciones - Kawaii')

@section('content')
    <!-- Precarga (igual que tu HTML original) -->
    <div id="preloader">
        <div id="loader" class="dots-fade">
            <div></div>
            <div></div>
            <div></div>
        </div>
    </div>

    <!-- Ajuste de página -->
    <div id="page" class="s-pagewrap">
        <!-- Encabezado (usando include de Blade) -->
        @include('partials.header')

        <!-- Contenido principal -->
        <article class="s-content">
            <!-- Mensajes de éxito/error -->
            @if(session('error'))
                <div class="alert error">{{ session('error') }}</div>
            @endif
            
            @if(session('success'))
                <div class="alert success">{{ session('success') }}</div>
            @endif

            <!-- Formulario de reserva -->
            <form id="rform" method="POST" action="{{ route('reservar.store') }}" autocomplete="off">
                @csrf <!-- Token de seguridad obligatorio -->

                <!-- Indicador de pasos -->
                <div class="progress-steps">
                    @for($i = 1; $i <= 4; $i++)
                        <div class="step {{ $i == 1 ? 'active' : '' }}" data-step="{{ $i }}">{{ $i }}</div>
                    @endfor
                </div>

                <!-- Paso 1: Menú -->
                <div id="step1" class="form-step active">
                    <h1>Selecciona tu Menú</h1>
                    
                    <div class="controles-menu">
                        <button type="button" class="boton-menu" onclick="mostrarSeccion('desayuno')">Desayuno</button>
                        <button type="button" class="boton-menu" onclick="mostrarSeccion('almuerzo')">Almuerzo</button>
                        <button type="button" class="boton-menu" onclick="mostrarSeccion('cena')">Cena</button>
                    </div>

                    <!-- Desayuno -->
                    <div id="seccion-desayuno" class="seccion-menu">
                        <h2>Desayuno</h2>
                        <label for="desayuno">Bebida:</label>
                        <select name="desayuno" id="desayuno">
                            <option value="">No incluir</option>
                            <option value="Café con leche" {{ old('desayuno') == 'Café con leche' ? 'selected' : '' }}>Café con leche</option>
                            <!-- Más opciones... -->
                        </select>
                    </div>

                    <!-- Almuerzo -->
                    <div id="seccion-almuerzo" class="seccion-menu">
                        <h2>Almuerzo</h2>
                        <label for="almuerzo_entrada">Entrada:</label>
                        <select name="almuerzo_entrada" id="almuerzo_entrada">
                            <option value="">No incluir</option>
                            <option value="Papa a la Huancaína" {{ old('almuerzo_entrada') == 'Papa a la Huancaína' ? 'selected' : '' }}>Papa a la Huancaína</option>
                            <!-- Más opciones... -->
                        </select>
                    </div>

                    <!-- Cena -->
                    <div id="seccion-cena" class="seccion-menu">
                        <h2>Cena</h2>
                        <label for="cena">Plato Principal:</label>
                        <select name="cena" id="cena">
                            <option value="">No incluir</option>
                            <option value="Hamburguesa con papas fritas" {{ old('cena') == 'Hamburguesa con papas fritas' ? 'selected' : '' }}>Hamburguesa con papas fritas</option>
                            <!-- Más opciones... -->
                        </select>
                    </div>
                    
                    <button type="button" class="btn-siguiente" onclick="nextStep(2)">Continuar</button>
                </div>

                <!-- Paso 2: Datos -->
                <div id="step2" class="form-step">
                    <div class="form-group">
                        <label for="rname">Nombre:</label>
                        <input type="text" name="rname" id="rname" value="{{ old('rname') }}" required>
                    </div>
                    
                    <div class="form-group">
                        <label for="rphone">Teléfono:</label>
                        <input type="tel" name="rphone" id="rphone" pattern="9[0-9]{8}" value="{{ old('rphone') }}" required>
                    </div>
                    
                    <button type="button" class="btn-anterior" onclick="prevStep(1)">Volver</button>
                    <button type="button" class="btn-siguiente" onclick="nextStep(3)">Siguiente</button>
                </div>

                <!-- Paso 3: Resumen -->
                <div id="step3" class="form-step">
                    <h2>Resumen de Reserva</h2>
                    <div id="resumenContenido">
                        <!-- Aquí se inyectará el resumen mediante JavaScript -->
                    </div>
                    <button type="button" class="btn-anterior" onclick="prevStep(2)">Volver</button>
                    <button type="button" class="btn-siguiente" onclick="nextStep(4)">Pagar</button>
                </div>

                <!-- Paso 4: Pago -->
                <div id="step4" class="form-step">
                    <h2>Pago Seguro</h2>
                    <div id="card-element" class="StripeElement"></div>
                    <div id="card-errors" role="alert"></div>
                    <input type="hidden" name="payment_method_id" id="payment_method_id">
                    
                    <div class="botones-navegacion">
                        <button type="button" class="btn-anterior" onclick="prevStep(3)">Volver</button>
                        <button type="submit" class="btn-pagar" id="submit-payment">
                            Pagar S/ {{ number_format($total ?? 0, 2) }}
                        </button>
                    </div>
                </div>
            </form>
        </article>

        <!-- Galería -->
        <section id="gallery" class="s-gallery">
            <!-- ... tu contenido original de galería ... -->
        </section>

        <!-- Footer -->
        @include('partials.footer')
    </div>
@endsection

@push('scripts')
    <!-- Scripts específicos de esta vista -->
    <script src="https://js.stripe.com/v3/"></script>
    <script>
        const stripe = Stripe("{{ config('cashier.key') }}");
        const elements = stripe.elements();
        const cardElement = elements.create('card');
        
        cardElement.mount('#card-element');
        
        // Tu lógica de pasos y validación aquí
        function nextStep(step) {
            // Implementación de tu JavaScript original
        }
        
        // Inicialización
        document.addEventListener('DOMContentLoaded', function() {
            // Inicializar pasos
        });
    </script>
@endpush