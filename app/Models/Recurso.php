<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Recurso extends Model
{
    use HasFactory;
    public $timestamps = false;
    protected $fillable = [
        'titulo',
        'contenido',
        'visible',
        'curso_id'
    ];
    public function curso()
    {
        return $this->belongsTo(Curso::class);
    }

}
