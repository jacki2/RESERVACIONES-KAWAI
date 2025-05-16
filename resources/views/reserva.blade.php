<form id="rform" method="post" action="{{ route('reservar.store') }}">
    @csrf

    <!-- Paso 4: Pago -->
    <div id="step4" class="form-step">
        <h2>Pago Seguro con Stripe</h2>
        <div class="stripe-container">
            <div id="card-element" class="StripeElement"></div>
            <div id="card-errors" class="error-message" role="alert"></div>
        </div>
        
        <input type="hidden" id="payment_method_id" name="payment_method_id">
        
        <div class="botones-navegacion">
            <button type="button" class="btn-volver" onclick="prevStep(3)">← Volver</button>
            <button type="button" class="btn-pagar" id="submit-payment">
                <span class="monto-total">Pagar S/ {{ number_format($total ?? 0, 2) }}</span>
                <span class="icono-candado">🔒</span>
            </button>
        </div>
    </div>
</form>

@push('scripts')
<script src="https://js.stripe.com/v3/"></script>
<script>
    const stripe = Stripe("{{ config('cashier.key') }}");
    const elements = stripe.elements();
    
    const cardElement = elements.create('card', {
        style: {
            base: {
                fontSize: '16px',
                color: '#32325d',
                '::placeholder': { color: '#aab7c4' }
            }
        }
    });

    cardElement.mount('#card-element');

    document.getElementById('submit-payment').addEventListener('click', async (e) => {
        e.preventDefault();
        
        const { paymentMethod, error } = await stripe.createPaymentMethod({
            type: 'card',
            card: cardElement,
        });

        if (error) {
            document.getElementById('card-errors').textContent = error.message;
        } else {
            document.getElementById('payment_method_id').value = paymentMethod.id;
            document.getElementById('rform').submit();
        }
    });
</script>
@endpush