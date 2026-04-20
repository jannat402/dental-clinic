@extends('layouts.app')

@section('title', 'Pago - Clínica Dental')

@section('content')
<div class="row justify-content-center">
    <div class="col-md-6">
        <div class="card shadow">
            <div class="card-header bg-primary text-white">
                <h4 class="mb-0">Pago de Consulta</h4>
            </div>
            <div class="card-body">
                <div class="text-center mb-4">
                    <h5 class="text-muted">Total a pagar</h5>
                    <h2 class="fw-bold text-primary">{{ number_format($monto / 100, 2) }} €</h2>
                </div>

                <form id="payment-form">
                    @csrf
                    <input type="hidden" name="cita_id" id="cita_id" value="{{ $citaId }}">
                    <input type="hidden" name="amount" id="amount" value="{{ $monto }}">
                    <div class="mb-3">
                        <label class="form-label">Nome completo</label>
                        <input type="text" class="form-control" id="nombre" placeholder="Juan García" required>
                    </div>
                    <div class="mb-3">
                        <label class="form-label">Email</label>
                        <input type="email" class="form-control" id="email" placeholder="juan@ejemplo.com" required>
                    </div>

                    <div class="mb-3">
                        <label class="form-label">Número da tarxeta</label>
                        <div id="card-number" class="form-control"></div>
                    </div>
                    <div class="row">
                        <div class="col-6 mb-3">
                            <label class="form-label">Data de expiración</label>
                            <div id="card-expiry" class="form-control"></div>
                        </div>
                        <div class="col-6 mb-3">
                            <label class="form-label">CVC</label>
                            <div id="card-cvc" class="form-control"></div>
                        </div>
                    </div>

                    <div id="card-errors" class="alert alert-danger d-none"></div>

                    <button type="submit" class="btn btn-primary w-100 py-2" id="submit-btn">
                        <span id="btn-text">Pagar {{ number_format($monto / 100, 2) }} €</span>
                        <span id="spinner" class="spinner-border spinner-border-sm d-none"></span>
                    </button>
                </form>
            </div>
        </div>

        <div class="text-center mt-3">
            <a href="/" class="text-muted">Volver ao inicio</a>
        </div>
    </div>
</div>
@endsection

@section('scripts')
<script src="https://js.stripe.com/v3/"></script>
<script>
const stripe = Stripe("{{ config('services.stripe.key') }}");

const elements = stripe.elements();
const cardNumber = elements.create('cardNumber');
const cardExpiry = elements.create('cardExpiry');
const cardCvc = elements.create('cardCvc');

cardNumber.mount('#card-number');
cardExpiry.mount('#card-expiry');
cardCvc.mount('#card-cvc');

const form = document.getElementById('payment-form');
const submitBtn = document.getElementById('submit-btn');
const btnText = document.getElementById('btn-text');
const spinner = document.getElementById('spinner');
const cardErrors = document.getElementById('card-errors');

form.addEventListener('submit', async (e) => {
    e.preventDefault();
    const amount = parseInt(document.getElementById('amount').value) / 100;
    submitBtn.disabled = true;
    btnText.textContent = 'Procesando...';
    spinner.classList.remove('d-none');
    cardErrors.classList.add('d-none');

    try {
        const res = await fetch('/payment/create', {
            method: 'POST',
            headers: {
                'Content-Type': 'application/json',
                'X-CSRF-TOKEN': '{{ csrf_token() }}'
            },
            body: JSON.stringify({ 
                amount: parseInt(document.getElementById('amount').value),
                cita_id: document.getElementById('cita_id').value
            })
        });

        const data = await res.json();

        if (data.error) {
            throw new Error(data.error);
        }

        const { error, paymentIntent } = await stripe.confirmCardPayment(data.clientSecret, {
            payment_method: {
                card: cardNumber,
                billing_details: {
                    name: document.getElementById('nombre').value,
                    email: document.getElementById('email').value
                }
            }
        });

        const amount = parseInt(document.getElementById('amount').value) / 100;

        if (error) {
            cardErrors.textContent = error.message;
            cardErrors.classList.remove('d-none');
            submitBtn.disabled = false;
            btnText.textContent = 'Pagar ' + amount.toFixed(2) + ' €';
            spinner.classList.add('d-none');
        } else if (paymentIntent.status === 'succeeded') {
            const citaId = data.cita_id || new URLSearchParams(window.location.search).get('cita');
            window.location.href = '/payment/success?status=succeeded&cita_id=' + encodeURIComponent(citaId);
        }
    } catch (err) {
        const amount = parseInt(document.getElementById('amount').value) / 100;
        cardErrors.textContent = 'Erro ao procesar o pagamento. Tente de novo.';
        cardErrors.classList.remove('d-none');
        submitBtn.disabled = false;
        btnText.textContent = 'Pagar ' + amount.toFixed(2) + ' €';
        spinner.classList.add('d-none');
    }
});
</script>
@endsection