<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Medicine;
use App\Models\Category;
class MedicineController extends Controller
{
   public function index()
    {
        $medicines = Medicine::all();
        return view('admin.medicines.index', compact('medicines'));
    }

    public function create()
    {
        $categories = Category::all();
        return view('admin.medicines.create', compact('categories'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'category_id' => 'required|exists:categories,id',
            'name' => 'required|string|max:255',
            'slug' => 'required|string|max:255|unique:medicines',
            'description' => 'nullable|string',
            'image' => 'nullable|image|mimes:jpeg,png,jpg,gif,svg|max:2048',
            'price' => 'required|numeric|min:0',
            'stock' => 'required|integer|min:0',
            'requires_prescription' => 'required|boolean',
            'manufacturer' => 'nullable|string|max:255',
            'expiry_date' => 'nullable|date',
            'status' => 'required|in:active,inactive',
        ]);

        $medicine = new Medicine();
        $medicine->category_id = $request->category_id;
        $medicine->name = $request->name;
        $medicine->slug = $request->slug;
        $medicine->description = $request->description;
        $medicine->price = $request->price;
        $medicine->stock = $request->stock;
        $medicine->requires_prescription = $request->requires_prescription;
        $medicine->manufacturer = $request->manufacturer;
        $medicine->expiry_date = $request->expiry_date;
        $medicine->status = $request->status;

        if ($request->hasFile('image')) {
            $imagePath = $request->file('image')->store('medicines', 'public');
            $medicine->image = $imagePath;
        }

        $medicine->save();

        return redirect()->route('admin.medicines.index')->with('success', 'Medicine created successfully.');  
    }
      public function destroy(Medicine $medicine) { 
        $medicine->delete();
        return redirect()->route('admin.medicines.index')->with('success', 'Medicine deleted successfully.');
    }
    }