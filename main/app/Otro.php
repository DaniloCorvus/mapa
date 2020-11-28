<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Otro extends Model
{
    public static function boot()
    {
        parent::boot();

        static::saving(function ($model) {
            $model->slug = trim(preg_replace('/[^A-Za-z0-9-]+/', '-', $model->nombre), '-');
        });
    }

    protected $fillable = [
        'nombre', 'file_path' 
    ];


    public function scopeSlug($query, $slug)
    {
        return $query->where('slug', $slug);
    }
}
