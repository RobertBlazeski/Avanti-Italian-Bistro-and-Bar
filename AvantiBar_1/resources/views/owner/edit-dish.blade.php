@extends('layouts.master')

@section('content')
<div class="edit-dish-container">
    <div class="edit-dish-form-wrapper">
        <h1 class="edit-dish-title">Edit Dish: {{ $dish->name }}</h1>

        <form action="{{ route('dishes.update', $dish->id) }}" method="POST" enctype="multipart/form-data" class="edit-dish-form">
            @csrf
            @method('PUT')
            
            <input type="hidden" name="dish_id" value="{{ $dish->id }}">

            <div class="form-group">
                <label for="name">Dish Name</label>
                <input type="text" id="name" name="name" required
                       value="{{ old('name', $dish->name) }}"
                       class="form-control">
            </div>

            <div class="form-group">
                <label for="category_id">Category</label>
                <select id="category_id" name="category_id" required class="form-control">
                    <option value="1" {{ $dish->category_id == 1 ? 'selected' : '' }}>Main Dishes</option>
                    <option value="2" {{ $dish->category_id == 2 ? 'selected' : '' }}>Salads</option>
                    <option value="3" {{ $dish->category_id == 3 ? 'selected' : '' }}>Drinks</option>
                    <option value="4" {{ $dish->category_id == 4 ? 'selected' : '' }}>Desserts</option>
                </select>
            </div>

            <div class="form-group">
                <label for="description">Description</label>
                <textarea id="description" name="description" class="form-control">{{ old('description', $dish->description) }}</textarea>
            </div>

            <div class="form-group">
                <label for="price">Price ($)</label>
                <input type="number" id="price" name="price" required
                       step="0.01" min="0"
                       value="{{ old('price', $dish->price) }}"
                       class="form-control">
            </div>

            <div class="form-group">
                <label for="current-image">Current Image</label>
                <img src="{{ asset('Images/' . $dish->image) }}" alt="{{ $dish->name }}" class="current-image">
            </div>

            <div class="form-group">
                <label for="image">Update Image</label>
                <input type="file" id="image" name="image"
                       accept="image/*"
                       class="form-control-file">
                <small>Leave blank to keep current image</small>
            </div>

            <div class="form-group">
                <button type="submit" class="submit-btn">Update Dish</button>
            </div>
        </form>
    </div>
</div>
@endsection

@push('styles')
<style>
.edit-dish-container {
    display: flex;
    justify-content: center;
    align-items: center;
    min-height: 100vh;
    background-color: #1a1a1a;
}

.edit-dish-form-wrapper {
    background-color: #2c2c2c;
    border-radius: 12px;
    padding: 40px;
    width: 100%;
    max-width: 600px;
    box-shadow: 0 10px 25px rgba(218, 165, 32, 0.2);
}

.edit-dish-title {
    text-align: center;
    color: #DAA520;
    margin-bottom: 30px;
}

.current-image {
    max-width: 200px;
    max-height: 200px;
    object-fit: cover;
    margin-bottom: 15px;
}

</style>
@endpush