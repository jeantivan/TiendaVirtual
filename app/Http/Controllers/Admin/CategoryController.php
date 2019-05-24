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
    public function index()
    {
        $categories = Category::all();

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

        // Luego se guarda la nueva Categoría en la BBDD
        $category = new Category;

        $category->name = $request->category;

        $category->save();

        $category->load('products');

        // Retornamos el nuevo Registro
        return $category;

    }
    
    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        //
    }

    /**
     * Eliminamos una categoría
     *
     */
    public function destroy($id)
    {
        //
    }
}
