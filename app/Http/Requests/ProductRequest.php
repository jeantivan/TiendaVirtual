<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

/*
  * Esta es una clase FormRequest que se encarga de validar
  * los datos del formulario para crear y almacenar Productos nuevos
  * así como sus imagenes correspondientes.
  * 
    
*/

class ProductRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize()
    {
        return $this->user()->isAdmin;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules()
    {
        return [
            'name' => 'required|max:80',
            'price' =>'required|numeric',
            'stock' => 'required|numeric',
            'description' => 'required|max:191',
            'images' => 'required|array|min:1',
            'images.*' => 'image|max:5000',
        ];
    }

    /*
      * Mensajes de error para cada validación
    */
    public function messages()
    {
        return [
            'name.required' => 'El campo Nombre es obligatorio',
            'name.max:80' => 'El Nombre debe tener menos de 80 caracteres',
            'price.required|numeric' => 'El campo Precio es obligatorio y numerico',
            'stock.required|numeric' => 'El campo Stock es obligatorio y numerico',
            'description.required|max:191' => 'La Descripción es obligatoria y no debe tener más de 191 caracteres',
            'images.min:1' => 'Debe subir una imagen al menos',
            'images.*.image' => 'Solo se permiten archivos jpeg, png, bmp, gif, or svg',
            'images.*.max' => 'Las imagenes no pueden ser mayor de 5MB',
        ];
    }
}
