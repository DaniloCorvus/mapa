<?php

namespace App\Observers;

use App\Categoria;
use App\Minicategoria;

class CategoriaObserver
{
    /**
     * Handle the categoria "created" event.
     *
     * @param  \App\Categoria  $categoria
     * @return void
     */
    public function created(Categoria $categoria)
    {
        $minicategoria =  new Minicategoria();
            $minicategoria->nombre = 'Caracterizacion del Proceso y listados maestros';
            $minicategoria->descripcion = 'Caracterizacion del SubProceso y listados maestros';
            $minicategoria->categoria_id = $categoria->id;
            $minicategoria->saveOrFail();
            $minicategoria =  new Minicategoria();
            $minicategoria->nombre = 'Procedimientos';
            $minicategoria->descripcion = 'Procedimientos';
            $minicategoria->categoria_id = $categoria->id;
            $minicategoria->saveOrFail();
            $minicategoria =  new Minicategoria();
            $minicategoria->nombre = 'Formatos';
            $minicategoria->descripcion = 'Formatos';
            $minicategoria->categoria_id = $categoria->id;
            $minicategoria->saveOrFail();
            $minicategoria =  new Minicategoria();
            $minicategoria->nombre = 'Otros documentos del proceso (Manuales, instructivos, guias, politicas, planes, Ficha tecnica, reglamento, protocolo, codigos)';
            $minicategoria->descripcion = 'Otros documentos del proceso (Manuales, instructivos, guias, politicas, planes, Ficha tecnica, reglamento, protocolo, codigos)';
            $minicategoria->categoria_id = $categoria->id;
            $minicategoria->saveOrFail();
            $minicategoria =  new Minicategoria();
            $minicategoria->nombre = 'Indicadores';
            $minicategoria->descripcion = 'Indicadores';
            $minicategoria->categoria_id = $categoria->id;
            $minicategoria->saveOrFail();
            $minicategoria =  new Minicategoria();
            $minicategoria->nombre = 'Evidencias del Proceso';
            $minicategoria->descripcion = 'Evidencias del Proceso';
            $minicategoria->categoria_id = $categoria->id;
            $minicategoria->saveOrFail();
            $minicategoria =  new Minicategoria();
            $minicategoria->nombre = 'Auditorias  del sistema  gestión';
            $minicategoria->descripcion = 'Auditorias  del sistema  gestión';
            $minicategoria->categoria_id = $categoria->id;
            $minicategoria->saveOrFail();
            $minicategoria =  new Minicategoria();
            $minicategoria->nombre = 'Planes de mejoramiento';
            $minicategoria->descripcion = 'Planes de mejoramiento';
            $minicategoria->categoria_id = $categoria->id;
            $minicategoria->saveOrFail();
    }

    /**
     * Handle the categoria "updated" event.
     *
     * @param  \App\Categoria  $categoria
     * @return void
     */
    public function updated(Categoria $categoria)
    {
        //
    }

    /**
     * Handle the categoria "deleted" event.
     *
     * @param  \App\Categoria  $categoria
     * @return void
     */
    public function deleted(Categoria $categoria)
    {
        //
    }

    /**
     * Handle the categoria "restored" event.
     *
     * @param  \App\Categoria  $categoria
     * @return void
     */
    public function restored(Categoria $categoria)
    {
        //
    }

    /**
     * Handle the categoria "force deleted" event.
     *
     * @param  \App\Categoria  $categoria
     * @return void
     */
    public function forceDeleted(Categoria $categoria)
    {
        //
    }
}
