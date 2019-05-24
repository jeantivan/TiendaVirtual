<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class OrderDetail extends Model
{
	protected $fillable = ['order_id', 'product_id', 'quantity'];
	
    //Relaciones entre Modelos
    
    // Relacion 1 a Muchos (Inversa) con el modelo Product
    public function product(){
    	return $this->belongsTo('App\Product');
    }
}
