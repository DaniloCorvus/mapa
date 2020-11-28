<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Archivo extends Model
{
    public static function boot()
    {
        parent::boot();

        static::saving(function ($model) {
            $model->slug = trim(preg_replace('/[^A-Za-z0-9-]+/', '-', $model->nombre), '-');
        });
    }

    protected $fillable = [
        'nombre',
        'descripcion',
        'pdf_path',
        'categoria_id',
        'proceso_id',
        'subproceso_id',
        'macroproceso_id',
        'minicategoria_id'
    ];


    public function scopeSlug($query, $slug)
    {
        return $query->where('slug', $slug);
    }

    public function minicategoria()
    {
        return $this->belongsTo(Minicategoria::class);
    }
}
