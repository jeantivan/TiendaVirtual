<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Payment extends Model
{
    // Relaciones 1 a 1 (Inversa) con el modelo Order
    // Un pago pertenece a una orden
    public function order(){
    	return $this->belongsTo('App\Order');
    }
}
