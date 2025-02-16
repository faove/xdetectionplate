<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Propietarios extends Model
{

    protected $table = 'propietarios';

    protected $fillable = [
        'num_ndoc',
        'num_cuit',
        'name',
        'email',
        'domicilio',
        'phone',
        'obj_id',
        'num'
    ];
}
