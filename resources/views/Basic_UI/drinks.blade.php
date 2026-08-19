@extends('layouts.master')

@section('content')
    <!--Header part-->
    <header>
        <img src="{{ asset('Images/Headers/header bg drinks.png') }}" alt="Header Image">
    </header>

    <!--Image links section-->
    <div class="img_menu_cont">
        <section class="image-links">

            <a href="{{ route('salads') }}" class="image-link">
                <img src="{{ asset('Images/Logos/salad_logo.png') }}" alt="Salads">
            </a>
            
            <a href="{{ route('main-dishes') }}" class="image-link">
                <img src="{{ asset('Images/Logos/food_logo.png') }}" alt="Main Dishes">
            </a>
            
            <a href="{{ route('desserts') }}" class="image-link">
                <img src="{{ asset('Images/Logos/dessert_logo.png') }}" alt="Desserts">
            </a>
            <a href="{{ route('specialties') }}" class="image-link">
                <img src="{{ asset('Images/Logos/recommended_logo.png') }}" alt="Specialities">
            </a>
        </section>
    </div>

    <!--Drinks heading-->
    <div class="rec_heading_cont">
        <img src="{{ asset('Images/Logos/title box.png') }}" alt="decorative underline" id="heading_underl">
        <div class="heading_rec">
            <h1 id="rec_title">Avanti<br>Drinks</h1>
        </div> 
    </div>

    <main>
    <div class="recommendations">
            @foreach($dishes as $dish)
                <section class="menu-item">
                    <h3>{{ $dish->name }}</h3>
                    <p>{{ $dish->description }}</p>
                    <img src="{{ asset('/Images/' . $dish->image) }}" class="item-picture" alt="{{ $dish->name }}">
                    <p class="price">{{ number_format($dish->price, 2) }} $</p>
                    @if($dish->category_id != 3 && (!Auth::check() || (Auth::check() && Auth::user()->role !== 'owner')))
                    <button class="add-to-cart-btn"
                        onclick="handleAddToCart({{ $dish->id }})">
                        Add to Cart
                    </button>
                    @endif
                    @auth
                        @if(auth()->user()->role === 'owner')
                            <div class="owner-actions">
                            <button class="edit-btn" onclick="window.location.href='{{ route('dishes.edit', $dish->id) }}'">
                                Edit
                            </button>
                            <button class="delete-btn" onclick="confirmDelete({{ $dish->id }})">
                                Delete
                            </button>
                            </div>
                        @endif
                    @endauth
                </section>
            @endforeach
        </div>
    </main>
@endsection