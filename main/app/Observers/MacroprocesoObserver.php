<?php

namespace App\Observers;

use App\Macroproceso;
use App\Minicategoria;

class MacroprocesoObserver
{
    /**
     * Handle the macroproceso "created" event.
     *
     * @param  \App\Macroproceso  $macroproceso
     * @return void
     */
    public function created(Macroproceso $macroproceso)
    {
        $minicategoria =  new Minicategoria();
            $minicategoria->nombre = 'Caracterizacion del macro proceso y listados maestros';
            $minicategoria->descripcion = 'Caracterizacion del macro proceso y listados maestros';
            $minicategoria->macroproceso_id = $macroproceso->id;
            $minicategoria->saveOrFail();
            $minicategoria =  new Minicategoria();
            $minicategoria->nombre = 'Procedimientos';
            $minicategoria->descripcion = 'Procedimientos';
            $minicategoria->macroproceso_id = $macroproceso->id;
            $minicategoria->saveOrFail();
            $minicategoria =  new Minicategoria();
            $minicategoria->nombre = 'Formatos';
            $minicategoria->descripcion = 'Formatos';
            $minicategoria->macroproceso_id = $macroproceso->id;
            $minicategoria->saveOrFail();
            $minicategoria =  new Minicategoria();
            $minicategoria->nombre = 'Otros documentos del macro proceso (Manuales, instructivos, guias, politicas, planes, Ficha tecnica, reglamento, protocolo, codigos)';
            $minicategoria->descripcion = 'Otros documentos del macro proceso (Manuales, instructivos, guias, politicas, planes, Ficha tecnica, reglamento, protocolo, codigos)';
            $minicategoria->macroproceso_id = $macroproceso->id;
            $minicategoria->saveOrFail();
            $minicategoria =  new Minicategoria();
            $minicategoria->nombre = 'Indicadores';
            $minicategoria->descripcion = 'Indicadores';
            $minicategoria->macroproceso_id = $macroproceso->id;
            $minicategoria->saveOrFail();
            $minicategoria =  new Minicategoria();
            $minicategoria->nombre = 'Evidencias del macro proceso';
            $minicategoria->descripcion = 'Evidencias del macro proceso';
            $minicategoria->macroproceso_id = $macroproceso->id;
            $minicategoria->saveOrFail();
            $minicategoria =  new Minicategoria();
            $minicategoria->nombre = 'Auditorias  del sistema  gestión';
            $minicategoria->descripcion = 'Auditorias  del sistema  gestión';
            $minicategoria->macroproceso_id = $macroproceso->id;
            $minicategoria->saveOrFail();
            $minicategoria =  new Minicategoria();
            $minicategoria->nombre = 'Planes de mejoramiento';
            $minicategoria->descripcion = 'Planes de mejoramiento';
            $minicategoria->macroproceso_id = $macroproceso->id;
            $minicategoria->saveOrFail();
    }

    /**
     * Handle the macroproceso "updated" event.
     *
     * @param  \App\Macroproceso  $macroproceso
     * @return void
     */
    public function updated(Macroproceso $macroproceso)
    {
        //
    }

    /**
     * Handle the macroproceso "deleted" event.
     *
     * @param  \App\Macroproceso  $macroproceso
     * @return void
     */
    public function deleted(Macroproceso $macroproceso)
    {
        //
    }

    /**
     * Handle the macroproceso "restored" event.
     *
     * @param  \App\Macroproceso  $macroproceso
     * @return void
     */
    public function restored(Macroproceso $macroproceso)
    {
        //
    }

    /**
     * Handle the macroproceso "force deleted" event.
     *
     * @param  \App\Macroproceso  $macroproceso
     * @return void
     */
    public function forceDeleted(Macroproceso $macroproceso)
    {
        //
    }
}
