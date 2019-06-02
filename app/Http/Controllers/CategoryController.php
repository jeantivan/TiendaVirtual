<?php

namespace App\Http\Controllers;

use App\Category;
use Illuminate\Http\Request;

class CategoryController extends Controller
{
	/**
	 * Muestra todas las categorias creadas
	 * 
	 */
    public function index()
    {
    	$categories = Category::all();
    	$categories->load('products');

    	return view('categories', ['categories' => $categories]);
    }

    public function show($category)
    {
    	$category = Category::where('name', $category)->first();
    	$category->load('products');
    	return view('showCategory', ['category' => $category]);
    }

}
