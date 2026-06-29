<?php

namespace App\Http\Controllers;

use App\Models\Medicine;
use App\Models\Category;
use Illuminate\Http\Request;

class MedicineController extends Controller
{
    /**
     * Display a listing of active medicines.
     */
    public function index(Request $request)
    {  $medicines = Medicine::all();
        $categories = Category::all();
       
        return view('medicines.products', compact('medicines', 'categories'));
    }

    /**
     * Display a single medicine detail page.
     */
    public function show(Medicine $medicine)
    {
    }
    
}
