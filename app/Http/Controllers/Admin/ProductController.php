<?php

namespace App\Http\Controllers\Admin;
use App\Http\Controllers\Controller;

use App\Product;
use App\Category;
use App\Image;
use Illuminate\Http\Request;
use App\Http\Requests\ProductRequest;
use Illuminate\Support\Facades\Storage;

class ProductController extends Controller
{
    public function __construct()
    {
        // Acceso solo a Administradores;
        $this->middleware('admin');
    }

    /**
     * Lista todos los productos disponibles
     * Tambien recibe un Request para filtrar los resultados por 
     * un buscardor simple.
     * 
     */
    public function index(Request $request)
    {
        if (!$request) {
            $products = Product::orderBy('updated_at', 'desc')->paginate(10);
            return view('admin.products')->with('products', $products);
        }

        $products = Product::where('name', 'like', '%'. $request->s .'%')->orderBy('updated_at', 'desc')->paginate(10);

        $products->load('images');
        return view('admin.products')->with('products', $products);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        // Formulario para crear productos junto con las categorias disponibles
        $categories = Category::all();
        return view('admin.createProduct', ['categories' => $categories]);
    }

    /**
     * Almacena un producto nuevo en la BBDD
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(ProductRequest $request)
    {

        // Si las imagenes se suben correctamente
        if ($request->hasFile('images')) {

            // Guardamos los datos del Producto en la BBDD
            $product = new Product();

            $product->name = $request->name; // Nombre
            $product->price = $request->price; // Precio
            $product->quantity_available=$request->stock; //Cnt Disponible
            $product->description = $request->description; // Descripción

            $product->save(); // Guardamos

            // Guardamos las Imagenes en Local y en la BBDD
            foreach ($request->file('images') as $image) {

                // Ruta de la imagen en local
                $path = $image->store('public/images/products/' . $product->id);
                $name = $image->getClientOriginalName();

                // Se guarda la Ruta en la BBDD
                $product->images()->create([
                    'path' => $path,
                    'name' => $name,
                ]);
            }

            // Asignamos las categorias al Producto
            foreach ($request->categories as $category) {
                
                // Se encuentra el la categoria en la BBDD
                $registro = Category::where('name', $category)->first();

                // Le asignamos la categoria al producto
                $product->categories()->attach($registro->id);
            }
        }

        // Redirijimos a la lista de Productos
        return redirect()->route('admin.products.index')->with('message', 'Producto agregado con éxito.');
    }

    /**
     * 
     * Retorna una vista con la informacion del Producto
     *
     */
    public function show(Product $product)
    {
        $product->load('images', 'categories');

        return view('admin.showProduct', ['product' => $product]); 
    }

    /**
     * 
     * Se actualiza un Producto
     *
     */
    public function update(Request $request, Product $product)
    {
        // Actualizamos los datos
        $product->name = $request->name;
        $product->price = $request->price;
        $product->description = $request->description;

        if ($request->stock) {

            // Si el stock es verdadero se almacena su valor
            // en la cantidad disponible
            $product->quantity_available = $request->stock;
            $product->in_stock = true;
            $product->save();

        } else {

            // En caso contrario se cambia el valor in_stock
            // y se almacena la cantidad disponible 
            $product->in_stock = false;
            $product->quantity_available = $request->stock;
            $product->save();
        }

        return redirect()->route('admin.products.show', ['product' => $product->id])->with('message', 'Producto actualizado con éxito.');
    }

    /**
     *
     * Eliminar un producto completamente
     * 
     */
    public function destroy($product)
    {

        $product = Product::onlyTrashed()->where('id', $product)->first();
        
        // Se borran las categorias asignadas al producto.
        $product->categories()->detach();

        // Se elimina las imagenes de la BBDD
        foreach($product->images as $image){
            Image::destroy($image->id);
        }

        // Se borra la carpeta que contiene las ímagenes del producto
        Storage::deleteDirectory('public/images/products/'. $product->id);
        

        // Se elimina el producto
        $product->forceDelete();

        return  redirect()->action('Admin\ProductController@trash')->with('message', 'Producto eliminado con éxito.');


    }

    /**
     * 
     * Enviar un producto a papelera. (Soft Delete)
     * 
     */
    public function toTrash(Product $product)
    {
        $product->delete();

        return redirect()->action('Admin\ProductController@index')->with('message', 'Producto en la palera.');
    }

    /**
     * 
     * Muestra los productos en la papelera.
     *
     */
    public function trash()
    {
        $products = Product::onlyTrashed()->get();
        return view('admin.trash', ['products' => $products]);
    }

    /**
     * 
     * Restaura un producto de la papelera
     *
     */
    public function restore($id)
    {
        $product = Product::withTrashed()->where('id', $id)->restore();

        return redirect()->action('Admin\ProductController@index')->with('message', 'Producto restaurado.');
    }


}
