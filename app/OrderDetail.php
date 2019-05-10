<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class OrderDetail extends Model
{
    //Relaciones entre Modelos
    
    // Relacion 1 a Muchos con Productos
    public function products(){
    	return $this->hasMany('App\Product');
    }
}
