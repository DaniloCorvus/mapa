<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Minicategoria extends Model
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
        'nombre', 'descripcion', 'categoria_id','proceso_id','subproceso_id', 'macroproceso_id'


    ];

    
    public function categoria()
    {
       return $this->belongsTo(Categoria::class);
    }

    public function proceso()
    {
        return $this->belongsTo(Proceso::class);
    }

    public function macroproceso()
    {
       return $this->belongsTo(Macroproceso::class);
    }

    public function subproceso()
    {
       return $this->belongsTo(Subproceso::class);
    }


    public function scopeSlug($query, $slug)
    {
        return $query->where('slug', $slug);
    }

    public function archivos()
    {
        return $this->hasMany(Archivo::class);
    }
}
