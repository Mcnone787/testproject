<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Curso extends Model
{
    public $timestamps = false;
    use HasFactory;
    protected $fillable = [
        'nombre',
        'etapa',
        'descripcion',
        'visible'
    ];

    public function recursos()
    {
        return $this->hasMany(Recurso::class);
    }
    
}
