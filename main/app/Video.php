<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Video extends Model
{
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
}
