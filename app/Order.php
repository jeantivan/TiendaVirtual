<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Order extends Model
{
    
	protected $fillable = ['user_id', 'status', 'total'];

    // Relaciones entre Modelos
     
   	// Relacion 1 a Muchos con OrderDetail
   	public function orderDetails(){
   		return $this->hasMany('App\OrderDetail');
   	}
}
