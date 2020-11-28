<?php

namespace App\Observers;

use App\Minicategoria;
use App\Subproceso;

class SubprocesoObserver
{
    /**
     * Handle the subroceso "created" event.
     *
     * @param  \App\Subproceso  $subproceso
     * @return void
     */
    public function created(Subproceso $subproceso)
    {
        $minicategoria =  new Minicategoria();
            $minicategoria->nombre = 'Caracterizacion del sub proceso y listados maestros';
            $minicategoria->descripcion = 'Caracterizacion del sub proceso y listados maestros';
            $minicategoria->subproceso_id = $subproceso->id;
            $minicategoria->saveOrFail();
            $minicategoria =  new Minicategoria();
            $minicategoria->nombre = 'Procedimientos';
            $minicategoria->descripcion = 'Procedimientos';
            $minicategoria->subproceso_id = $subproceso->id;
            $minicategoria->saveOrFail();
            $minicategoria =  new Minicategoria();
            $minicategoria->nombre = 'Formatos';
            $minicategoria->descripcion = 'Formatos';
            $minicategoria->subproceso_id = $subproceso->id;
            $minicategoria->saveOrFail();
            $minicategoria =  new Minicategoria();
            $minicategoria->nombre = 'Otros documentos del sub proceso (Manuales, instructivos, guias, politicas, planes, Ficha tecnica, reglamento, protocolo, codigos)';
            $minicategoria->descripcion = 'Otros documentos del sub proceso (Manuales, instructivos, guias, politicas, planes, Ficha tecnica, reglamento, protocolo, codigos)';
            $minicategoria->subproceso_id = $subproceso->id;
            $minicategoria->saveOrFail();
            $minicategoria =  new Minicategoria();
            $minicategoria->nombre = 'Indicadores';
            $minicategoria->descripcion = 'Indicadores';
            $minicategoria->subproceso_id = $subproceso->id;
            $minicategoria->saveOrFail();
            $minicategoria =  new Minicategoria();
            $minicategoria->nombre = 'Evidencias del sub proceso';
            $minicategoria->descripcion = 'Evidencias del sub proceso';
            $minicategoria->subproceso_id = $subproceso->id;
            $minicategoria->saveOrFail();
            $minicategoria =  new Minicategoria();
            $minicategoria->nombre = 'Auditorias  del sistema  gestión';
            $minicategoria->descripcion = 'Auditorias  del sistema  gestión';
            $minicategoria->subproceso_id = $subproceso->id;
            $minicategoria->saveOrFail();
            $minicategoria =  new Minicategoria();
            $minicategoria->nombre = 'Planes de mejoramiento';
            $minicategoria->descripcion = 'Planes de mejoramiento';
            $minicategoria->subproceso_id = $subproceso->id;
            $minicategoria->saveOrFail();
    }

    /**
     * Handle the subroceso "updated" event.
     *
     * @param  \App\Subproceso  $subproceso
     * @return void
     */
    public function updated(Subproceso $subproceso)
    {
        //
    }

    /**
     * Handle the subroceso "deleted" event.
     *
     * @param  \App\Subproceso  $subproceso
     * @return void
     */
    public function deleted(Subproceso $subproceso)
    {
        //
    }

    /**
     * Handle the subroceso "restored" event.
     *
     * @param  \App\Subproceso  $subproceso
     * @return void
     */
    public function restored(Subproceso $subproceso)
    {
        //
    }

    /**
     * Handle the subroceso "force deleted" event.
     *
     * @param  \App\Subproceso  $subproceso
     * @return void
     */
    public function forceDeleted(Subproceso $subproceso)
    {
        //
    }
}
