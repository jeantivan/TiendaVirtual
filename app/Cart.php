<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Cart extends Model
{
    

    // Relaciones entre modelos
    
    //Relacion uno a muchos (Inversa) con el modelo User
    public function users(){
    	return $this->belongsTo('App\User');
    }

    //Relacion uno a muchos con en el modelo Product
    public function product(){
    	return $this->belongsTo('App\Product');
    }
}
