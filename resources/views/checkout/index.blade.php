@extends('layouts.master')

@section('content')
<div class="checkout-container">
    @if(session('error'))
        <div class="alert alert-danger">
            {{ session('error') }}
        </div>
    @endif
    <div class="checkout-wrapper">
        <div class="checkout-header">
            <h1>Checkout</h1>
        </div>

        <div class="checkout-content">
            <div class="checkout-form-section">
                <form action="{{ route('checkout.process') }}" method="POST" class="checkout-form">
                    @csrf
                    <div class="form-group">
                        <label for="name">Full Name</label>
                        <input 
                            type="text" 
                            id="name" 
                            name="name" 
                            value="{{ old('name', auth()->user()->name) }}" 
                            required
                        >
                    </div>

                    <div class="form-group">
                        <label for="email">Email Address</label>
                        <input 
                            type="email" 
                            id="email" 
                            name="email" 
                            value="{{ old('email', auth()->user()->email) }}" 
                            required
                        >
                    </div>

                    <div class="form-group">
                        <label for="address">Delivery Address</label>
                        <textarea 
                            id="address" 
                            name="address" 
                            required
                        >{{ old('address') }}</textarea>
                    </div>

                    <button type="submit" class="checkout-submit-btn">
                        Place Order
                    </button>
                </form>
            </div>

            <div class="order-summary-section">
                <div class="order-summary-header">
                    <h2>Order Summary</h2>
                </div>

                <div class="order-items">
                    @foreach($cartItems as $item)
                        <div class="order-item">
                            <div class="item-details">
                                <span class="item-name">{{ $item->dish->name }}</span>
                                <span class="item-quantity">x {{ $item->quantity }}</span>
                            </div>
                            <span class="item-price">
                                ${{ number_format($item->dish->price * $item->quantity, 2) }}
                            </span>
                        </div>
                    @endforeach
                </div>

                <div class="order-totals">
                    <div class="total-row">
                        <span>Subtotal</span>
                        <span>${{ number_format($total, 2) }}</span>
                    </div>
                    <div class="total-row">
                        <span>Delivery Fee</span>
                        <span>$5.00</span>
                    </div>
                    <div class="total-row total">
                        <span>Total</span>
                        <span>${{ number_format($total + 5, 2) }}</span>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<style>
body {
    background-color: #2f2f2f;
    color: #ffffff;
    font-family: 'Arial', sans-serif;
}
</style>
@endsection