<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Rodado extends Model
{
    protected $connection = 'pgsql_second'; // Conexión a la segunda BD
    protected $table = 'rodado';
}
