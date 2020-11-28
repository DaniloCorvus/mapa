<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Categoria extends Model
{
    public function getRouteKeyName()
    {
        return 'slug';
    }

    public static function boot()
    {
        parent::boot();

        static::saving(function ($model) {
            $model->slug = trim(preg_replace('/[^A-Za-z0-9-]+/', '-', $model->nombre), '-');
        });
    }

    protected $fillable = [
        'nombre', 'descripcion'
    ];

    public function procesos()
    {
        return $this->hasMany(Proceso::class);
    }

    public function minicategorias()
    {
        return $this->hasMany(Minicategoria::class);
    }

    public function scopeSlug($query, $slug)
    {
        return $query->where('slug', $slug);
    }

    public function subprocesos()
    {
        return $this->hasMany(Subproceso::class);
    }
}
