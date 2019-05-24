<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Product extends Model
{
    // Columnas permitidas para llenado en masa
    protected $fillable = [
        'name', 'price', 'description', 'quantity_available'
    ];
    //Relaciones entre Modelos

    // Relacion 1 a Muchos con Image
    public function images(){
    	return $this->hasMany('App\Image');
    }

    // Relacion Muchos a Muchos con Category
    public function categories(){
    	return $this->belongsToMany('App\Category');
    }

    // Relacion 1 a Muchos (Inversa) con el modelo Cart
    public function carts(){
        return $this->hasMany('App\Cart');
    }
}
