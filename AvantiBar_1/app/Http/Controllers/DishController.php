<?php

namespace App\Http\Controllers;

use App\Models\Dish;
use App\Models\Category;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth; 
use Illuminate\Support\Str;

class DishController extends Controller
{
    public function mainDishes()
    {
        $dishes = Dish::where('category_id', '1')->get();
        return view('Basic_UI.main-dishes', compact('dishes'));
    }
  

    public function salads()
    {
        $dishes = Dish::where('category_id', 2)->get();
        return view('Basic_UI.salads', compact('dishes'));
    }

    public function drinks()
    {
        $dishes = Dish::where('category_id', 3)->get();
        return view('Basic_UI.drinks', compact('dishes'));
    }

    public function desserts()
    {
        $dishes = Dish::where('category_id', 4)->get();
        return view('Basic_UI.desserts', compact('dishes'));
    }
    public function specialties()
    {
        $dishes = Dish::latest()->take(6)->get();
        return view('Basic_UI.specialties', compact('dishes'));
    }




    // Owner 


    public function storeDish(Request $request)
{
    // Ensure only owners can add dishes
    if (Auth::user()->role !== 'owner') {
        abort(403, 'Unauthorized');
    }

    $validatedData = $request->validate([
        'name' => 'required|string|max:255|unique:dishes,name',
        'category_id' => 'required|in:1,2,3,4',
        'description' => 'nullable|string',
        'price' => 'required|numeric|min:0',
        'image' => 'required|image|max:2048' // max 2MB
    ]);

    if ($request->hasFile('image')) {
        // Create filename format: "Dish Name.png"
        $fileName = Str::slug($validatedData['name']) . '.png';
        
        // Move file to public/Images/Food/
        $request->file('image')->move(
            public_path('Images/Food/'), 
            $fileName
        );
        
        // Save path as Food/dishname.png
        $validatedData['image'] = 'Food/' . $fileName;
    }

    $dish = Dish::create($validatedData);

    return redirect()->route('specialties')
        ->with('success', 'Dish added successfully!');
}

public function createDishView()
{
    if (Auth::user()->role !== 'owner') {
        abort(403, 'Unauthorized');
    }


    $categories = [
        1 => 'Main Dishes',
        2 => 'Salads',
        3 => 'Drinks',
        4 => 'Desserts'
    ];

    return view('owner.add-dish', compact('categories'));
}



public function editDish($id)
{
    // Ensure only owners can access this view
    if (Auth::user()->role !== 'owner') {
        abort(403, 'Unauthorized');
    }

    $dish = Dish::findOrFail($id);
    return view('owner.edit-dish', compact('dish'));
}

public function updateDish(Request $request, $id)
{
    // Ensure only owners can update dishes
    if (Auth::user()->role !== 'owner') {
        abort(403, 'Unauthorized');
    }

    $dish = Dish::findOrFail($id);

    $validatedData = $request->validate([
        'name' => 'required|string|max:255',
        'category_id' => 'required|in:1,2,3,4',
        'description' => 'nullable|string',
        'price' => 'required|numeric|min:0',
        'image' => 'sometimes|image|max:2048'
    ]);

   
    $dish->name = $validatedData['name'];
    $dish->category_id = $validatedData['category_id'];
    $dish->description = $validatedData['description'];
    $dish->price = $validatedData['price'];


    if ($request->hasFile('image')) {
        $fileName = Str::slug($validatedData['name']) . '.png';
        
        $request->file('image')->move(
            public_path('Images/Food/'), 
            $fileName
        );
        
        $dish->image = 'Food/' . $fileName;
    }

    $dish->save();

    return redirect()->route('specialties')
        ->with('success', 'Dish updated successfully!');
}
public function deleteDish($id)
{
    
    if (!Auth::check() || Auth::user()->role !== 'owner') {
        return response()->json([
            'success' => false,
            'message' => 'Unauthorized access'
        ], 403);
    }

    try {
        $dish = Dish::findOrFail($id);

        
        if ($dish->image) {
            $imagePath = public_path('Images/' . $dish->image);
            if (file_exists($imagePath)) {
                unlink($imagePath);
            }
        }

    
        $dish->delete();

        return response()->json([
            'success' => true,
            'message' => 'Dish deleted successfully'
        ]);
    } catch (\Exception $e) {
        return response()->json([
            'success' => false,
            'message' => 'Error deleting dish: ' . $e->getMessage()
        ], 500);
    }
}
}