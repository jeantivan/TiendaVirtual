<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Order extends Model
{
    // Permitir crear muchos registros en los campos...
	protected $fillable = ['user_id', 'status','shipping_address', 'total'];

    // Relaciones entre Modelos

    // Relación 1 a Muchos con OrderDetail
    // Una orden puede tener muchas Orderdetails
    public function orderDetails()
    {
        return $this->hasMany('App\OrderDetail');
    }

    // Relación Muchos a 1 con el modelo User
    // Muchas Ordenes pueden pertenercer a un solo usuario
    public function user()
    {
        return $this->belongsTo('App\User');
    }

    // Relación 1 a 1 con el modelo Payment
    // Una orden debe tener solo un pago
    public function payment()
    {
        return $this->hasOne('App\Payment');
    }
}
