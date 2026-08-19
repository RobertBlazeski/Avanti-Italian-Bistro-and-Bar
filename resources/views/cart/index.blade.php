@extends('layouts.master')
<link rel="stylesheet" href="{{ asset('css/spec_styles.css') }}">
@section('content')
<div class="container mx-auto px-4 py-8">
    <div class="rec_heading_cont">
        <div class="heading_rec">
            <h1 id="rec_title">My Cart</h1>
        </div> 
    </div>

    @if($cartItems->isEmpty())
        <div class="text-center py-8">
            <p class="empty-cart-message">Your cart is empty</p>
            <a href="{{ route('main-dishes') }}" class="continue-shopping-btn">Continue Shopping</a>
        </div>
    @else
        <div class="cart_container">
            @foreach($cartItems as $item)
                <div class="cart-item" data-item-id="{{ $item->id }}">
                    <div class="cart-item-image">
                        <img src="{{ asset('Images/' . $item->dish->image) }}" alt="{{ $item->dish->name }}">
                    </div>
                    <div class="cart-item-details">
                        <h3>{{ $item->dish->name }}</h3>
                        <p class="item-price">${{ number_format($item->dish->price, 2) }}</p>
                    </div>
                    <div class="cart-item-quantity">
                        <button class="quantity-btn minus" onclick="updateQuantity({{ $item->id }}, -1)">-</button>
                        <span class="quantity">{{ $item->quantity }}</span>
                        <button class="quantity-btn plus" onclick="updateQuantity({{ $item->id }}, 1)">+</button>
                    </div>
                    <div class="cart-item-total">
                        ${{ number_format($item->dish->price * $item->quantity, 2) }}
                    </div>
                    <form action="{{ route('cart.destroy', $item) }}" method="POST" class="remove-form">
                        @csrf
                        @method('DELETE')
                        <button type="submit" class="remove-btn">Remove</button>
                    </form>
                </div>
            @endforeach

            <div class="cart-summary">
                <div class="summary-row">
                    <span>Subtotal:</span>
                    <span>${{ number_format($total, 2) }}</span>
                </div>
                <div class="summary-row">
                    <span>Delivery Fee:</span>
                    <span>$5.00</span>
                </div>
                <div class="summary-row total">
                    <span>Total:</span>
                    <span>${{ number_format($total + 5, 2) }}</span>
                </div>

                <button onclick="proceedToCheckout()" class="checkout-btn">
                    Proceed to Checkout
                </button>
            </div>
        </div>
    @endif
</div>

<script>
function updateQuantity(itemId, change) {
    const itemElement = document.querySelector(`[data-item-id="${itemId}"]`);
    const quantitySpan = itemElement.querySelector('.quantity');
    let newQuantity = parseInt(quantitySpan.textContent) + change;
    
    if (newQuantity < 1) return;

    fetch(`/cart/${itemId}`, {
        method: 'PUT',
        headers: {
            'Content-Type': 'application/json',
            'X-CSRF-TOKEN': '{{ csrf_token() }}'
        },
        body: JSON.stringify({ quantity: newQuantity })
    })
    .then(response => response.json())
    .then(data => {
        if (data.success) {
            quantitySpan.textContent = newQuantity;
            itemElement.querySelector('.cart-item-total').textContent = 
                '$' + data.total.toFixed(2);
            
            // Update cart count in navbar
            document.getElementById('cartCount').textContent = data.cartCount;
            
            // Update summary
            updateCartSummary();
        }
    });
}

function updateCartSummary() {
    const totals = Array.from(document.querySelectorAll('.cart-item-total'))
        .map(el => parseFloat(el.textContent.replace('$', '')));
    const subtotal = totals.reduce((a, b) => a + b, 0);
    const total = subtotal + 5; // Adding delivery fee

    document.querySelector('.summary-row:first-child span:last-child')
        .textContent = '$' + subtotal.toFixed(2);
    document.querySelector('.summary-row.total span:last-child')
        .textContent = '$' + total.toFixed(2);
}

function proceedToCheckout() {
    window.location.href = '{{ route("checkout") }}';
}
</script>

<style>
.container {
    max-width: 1200px;
    margin: 0 auto;
}
</style>
@endsection