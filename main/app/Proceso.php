<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Proceso extends Model
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
        'nombre', 'descripcion', 'categoria_id'
    ];

    public function categoria()
    {
        return $this->belongsTo(Categoria::class);
    }

    public function macroprocesos()
    {
        return $this->hasMany(Macroproceso::class);
    }

    public function minicategorias()
    {
        return $this->hasMany(Minicategoria::class);
    }

    /**
     * Get the route key for the model.
     *
     * @return string
     */

    public function scopeSlug($query, $slug)
    {
        return $query->where('slug', $slug);
    }

    public function subprocesos()
    {
        return $this->hasMany(Subproceso::class);
    }
}
