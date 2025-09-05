<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Consoles extends Model
{
    protected $fillable = [
        'nome',
        'marca',
        'preco',
        'ano',
];

}
