@extends('layouts.master')

@section('content')
<div class="checkout-container-success">
    <h1 class="checkout-header-success">Order Confirmed!</h1>
    <div class="alert-class" role="alert">
        <p class="font-bold">Thank you for your order</p>
        <p>Order #{{ $order->id }} has been successfully placed.</p>
    </div>

    <div class="checkout-content-success">
        <h2 class="checkout-header-success">Order Details</h2>
        <div class="order-details-section">
            <div class="order-element">
                <strong>Total:</strong> ${{ number_format($order->total, 2) }}
            </div>
            <div class="order-element">
                <strong>Delivery Address:</strong> {{ $order->address }}
            </div>
            <div class="order-element">
                <strong>Payment Method:</strong> {{ ucfirst(str_replace('_', ' ', $order->payment_method)) }}
            </div>
        </div>
    </div>

    <a href="{{ route('main-dishes') }}" class="continue-shopping">
        Continue Shopping
    </a>
</div>

<style>
body {
    background-color: #2f2f2f;
    color: #ffffff;
    font-family: 'Arial', sans-serif;
}
</style>
@endsection