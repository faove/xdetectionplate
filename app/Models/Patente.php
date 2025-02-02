<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Validation\Rule;

class Patente extends Model
{
    use HasFactory;

    protected $table = 'patentes';

    protected $fillable = [
        'dominio',
        'fchregistro',
        'marca',
        'modelo',
        'marca_name',
        'modelo_name',
        'nromotor',
        'nrochasis',
        'anio',
        'color',
        'obj_id',
        'imagen',
        'video',
    ];

    public static function rules($id = null)
    {
        return [
            'dominio'      => ['required', 'string', 'max:9', Rule::unique('patentes', 'dominio')->ignore($id)],
            'fchregistro'  => ['required', 'date'],
            'marca'        => ['nullable', 'integer'],
            'modelo'       => ['nullable', 'integer'],
            'marca_name'   => ['nullable', 'string', 'max:255'],
            'modelo_name'  => ['nullable', 'string', 'max:255'],
            'nromotor'     => ['nullable', 'string', 'max:255'],
            'nrochasis'    => ['nullable', 'string', 'max:255'],
            'anio'         => ['nullable', 'integer', 'digits:4', 'min:1900', 'max:' . date('Y')],
            'color'        => ['nullable', 'string', 'max:15'],
            'obj_id'       => ['nullable', 'string', 'max:8'],
            'imagen'       => ['nullable', 'string', 'max:255'],
            'video'        => ['nullable', 'string', 'max:255'],
        ];
    }
}
