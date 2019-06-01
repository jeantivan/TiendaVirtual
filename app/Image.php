<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Image extends Model
{
    protected $fillable = [
        'product_id', 'path', 'name'
    ];

    // Relaciones entre modelos
    
    // Relacion 1 a Muchos (Inversa) con Productos
    public function product()
    {
        return $this->belongsTo('App\Product');
    } 
    
}
