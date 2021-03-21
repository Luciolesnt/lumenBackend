<?php

namespace App\Http\Controllers;
use App\Models\Category;
use Illuminate\Support\Facades\Log;
use Illuminate\Http\Request;
use Illuminate\Http\Response;


class CategoryController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        //
    }

    public function showAllCategories()
    {
        $categoryList = Category::all();
        return response()->json($categoryList);
    }

    public function showOneCategory(int $id)
    {
        Log::debug('Category id', [$id]);

        $oneCategory = Category::findOrFail($id);
        return response()->json($oneCategory);
    }
}

