<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Support\Facades\Auth;
use Illuminate\Validation\Rule;

class StoreMovimiento extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize()
    {
        return Auth::check();//chekea is el usuario esta autentificado o no
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules()
    {
        return [
            'tipo' => [
                'required',
                Rule::in(['Egreso','Ingreso'])
            ],
            'movimiento_dato' => 'required|date',
            'categoria_id' => 'required',
            'descripcion' => 'required|min:3|max:1000',
            'money_decimal' => 'required|numeric|min:0.01',
            'image' => 'required|image'
        ];      
    }
  
    public function messages()
    {
        return [
            'tipo.required' => 'El campo Tipo es requerido',
            'tipo.in' => 'El valor del campo tipo no es válido',
            'movimiento_dato.required' => 'El campo Fecha es requerido',
            'movimiento_dato.date' => 'La Fecha no es válida',
            'categoria_id.required' => 'La categoría es obligatoria',
            'descripcion.required' => 'La descripción es obligatoria',
            'descripcion.min' => 'La descripción debe tener tres caracteres o más',
            'descripcion.max' => 'La descripción no puede tener más de 1000 caracteres',
            'money_decimal.required' => 'El monto es obligatorio',
            'money_decimal.numeric' => 'El monto debe ser un número',
            'money_decimal.min' => 'El monto debe ser mayor a cero',
            'image.required' => 'La imagen es requerida',
            'image.image' => 'El archivo adjunto no es una imagen válida'
        ];
    }
}
