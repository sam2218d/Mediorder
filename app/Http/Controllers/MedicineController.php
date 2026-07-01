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
   public function index()
    {
        // 1. Fetch all categories from the database
        $categories = Category::all();
        $query = Medicine::query();
        if(request()->has('category')) {
            $query->where('category_id', request()->input('category'));
        }
     
        // (Assuming you are also fetching medicines for this page)
        $medicines = $query->paginate(12);

        // 2. Pass them to your blade file
        return view('medicines.products', compact('categories', 'medicines'));
    }

     public function search(Request $request)
    {
        // 1. Grab what the user typed into the search bar
        $searchTerm = $request->input('query');

        
        $medicines = Medicine::where('name', 'LIKE', "%{$searchTerm}%")
                             ->orWhere('description', 'LIKE', "%{$searchTerm}%")
                             
                             ->paginate(12);

        // 3. Return a view with the results
        return view('medicines.results', compact('medicines', 'searchTerm'));
    }
    

    
}
