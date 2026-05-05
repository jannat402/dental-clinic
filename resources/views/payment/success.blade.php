@extends('layouts.app')

@section('title', 'Resultado do Pago')

@section('content')
<div class="row justify-content-center">
    <div class="col-md-6">
        <div class="card shadow text-center">
            @if($status === 'succeeded')
                <div class="card-header bg-success text-white">
                    <h3 class="mb-0">Pago Exitoso</h3>
                </div>
                <div class="card-body">
                    <div class="mb-4">
                        <svg xmlns="http://www.w3.org/2000/svg" width="80" height="80" fill="currentColor" class="bi bi-check-circle-fill text-success" viewBox="0 0 16 16">
                            <path d="M16 8A8 8 0 1 1 0 8a8 8 0 0 1 16 0zm-3.97-3.03a.75.75 0 0 0-1.08.022L7.477 9.417 5.384 7.323a.75.75 0 0 0-1.06 1.06L6.97 11.03a.75.75 0 0 0 1.079-.02l3.992-4.99a.75.75 0 0 0-.01-1.05z"/>
                        </svg>
                    </div>
                    <h4>O seu pagamento foi procesado con éxito</h4>
                    <p class="text-muted">Recibirá un correo de confirmación en poucos minutos.</p>
                    <p class="fw-bold">ID do pagamento: {{ $paymentIntent }}</p>
                    <div class="mt-4">
                        <a href="/" class="btn btn-primary">Volver ao inicio</a>
                        <a href="/payment" class="btn btn-outline-secondary">Facer outro pago</a>
                    </div>
                </div>
            @else
                <div class="card-header bg-danger text-white">
                    <h3 class="mb-0">Pago Fallido</h3>
                </div>
                <div class="card-body">
                    <div class="mb-4">
                        <svg xmlns="http://www.w3.org/2000/svg" width="80" height="80" fill="currentColor" class="bi bi-x-circle-fill text-danger" viewBox="0 0 16 16">
                            <path d="M16 8A8 8 0 1 1 0 8a8 8 0 0 1 16 0zM5.354 4.646a.5.5 0 1 0-.708.708L7.293 8l-2.647 2.646a.5.5 0 0 0 .708.708L8 8.707l2.646 2.647a.5.5 0 0 0 .708-.708L8.707 8l2.647-2.646a.5.5 0 0 0-.708-.708L8 7.293 5.354 4.646z"/>
                        </svg>
                    </div>
                    <h4>Houbbo un erro ao procesar o pagamento</h4>
                    <p class="text-muted">{{ $message ?: 'Tente de novo ou contacte co seu banco.' }}</p>
                    <div class="mt-4">
                        <a href="/payment" class="btn btn-primary">Tentar de novo</a>
                        <a href="/" class="btn btn-outline-secondary">Volver ao inicio</a>
                    </div>
                </div>
            @endif
        </div>
    </div>
</div>
@endsection