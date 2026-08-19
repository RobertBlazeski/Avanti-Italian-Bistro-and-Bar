@extends('layouts.master')

@section('content')
<div class="add-dish-container">
    <div class="add-dish-form-wrapper">
        <h1 class="add-dish-title">Add New Dish</h1>

        @if ($errors->any())
            <div class="error-message">
                <ul>
                    @foreach ($errors->all() as $error)
                        <li>{{ $error }}</li>
                    @endforeach
                </ul>
            </div>
        @endif

        <form action="{{ route('dishes.store') }}" method="POST" enctype="multipart/form-data" class="add-dish-form">
            @csrf
            
            <div class="form-group">
                <label for="name">Dish Name</label>
                <input type="text" id="name" name="name" required
                       value="{{ old('name') }}"
                       class="form-control"
                       placeholder="Enter dish name">
            </div>

            <div class="form-group">
                <label for="category_id">Category</label>
                 <select id="category_id" name="category_id" required class="form-control">
                    <option value="">Select Category</option>
                    <option value="1" {{ old('category_id') == 1 ? 'selected' : '' }}>Main Dishes</option>
                    <option value="2" {{ old('category_id') == 2 ? 'selected' : '' }}>Salads</option>
                    <option value="3" {{ old('category_id') == 3 ? 'selected' : '' }}>Drinks</option>
                    <option value="4" {{ old('category_id') == 4 ? 'selected' : '' }}>Desserts</option>
                </select>
            </div>

            <div class="form-group">
                <label for="description">Description</label>
                <textarea id="description" name="description"
                          class="form-control"
                          placeholder="Describe the dish"
                          rows="4">{{ old('description') }}</textarea>
            </div>

            <div class="form-group">
                <label for="price">Price ($)</label>
                <input type="number" id="price" name="price" required
                       step="0.01" min="0"
                       value="{{ old('price') }}"
                       class="form-control"
                       placeholder="0.00">
            </div>

            <div class="form-group">
                <label for="image">Dish Image</label>
                <input type="file" id="image" name="image"
                       accept="image/*" required
                       class="form-control-file">
                <small class="text-muted">Max file size: 2MB</small>
            </div>

            <div class="form-group">
                <button type="submit" class="submit-btn">Add Dish</button>
            </div>
        </form>
    </div>
</div>
@endsection

@push('styles')
<style>
:root {
    --bg-dark: #121212;
    --container-bg: #1e1e1e;
    --gold-border: #DAA520;
    --text-light: #f0f0f0;
    --input-bg: #2a2a2a;
}

body {
    
    background-color: var(--bg-dark);
    font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;
    display: flex;
    justify-content: center;
    align-items: center;
    min-height: 100vh;
    margin: 0;
    padding: 0;
}

</style>
@endpush