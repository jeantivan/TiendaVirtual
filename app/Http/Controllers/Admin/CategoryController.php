<?php

namespace App\Http\Controllers\Admin;

use App\Category;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class CategoryController extends Controller
{
    public function __construct()
    {
        // Acceso solo a Administradores;
        $this->middleware('admin');
    }


    /**
     * Lista todos las Categorias disponibles
     */
    public function index(Request $request)
    {
        if (!$request) {
            $categories = Category::orderBy('id', 'desc')->paginate(10);
            return view('admin.categories')->with('categories', $categories);
        }

        $categories = Category::where('name', 'like', '%'. $request->s .'%')->orderBy('id', 'desc')->paginate(10);

        return view('admin.categories', ['categories' => $categories]);
    }

    /**
     * Se guarda una nueva categoría
     *
     */
    public function store(Request $request)
    {
        // Validamos la data 
        $request->validate([
            'category' => 'required|string|max:50|min:3',
        ]);

        // Si la categoría existe no la guardamos
        if (Category::where('name', $request->category)->exists()) {
            return response()->json([
                'status' => 400,
                'message' => 'La categoría ya existe.'
            ]);
        }

        // Luego se guarda la nueva Categoría en la BBDD
        $category = new Category;

        $category->name = $request->category;

        $category->save();

        $category->load('products');

        // Retornamos el nuevo Registro
        return response()->json([
            'message' => 'Categoría creada con éxito',
            'category' => $category
        ]);

    }

}
