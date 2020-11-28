<?php

namespace App\Observers;

use App\Minicategoria;
use App\Proceso;

class ProcesoObserver
{
    /**
     * Handle the proceso "created" event.
     *
     * @param  \App\Proceso  $proceso
     * @return void
     */
    public function created(Proceso $proceso)
    {
        $minicategoria =  new Minicategoria();
            $minicategoria->nombre = 'Caracterizacion del proceso y listados maestros';
            $minicategoria->descripcion = 'Caracterizacion del proceso y listados maestros';
            $minicategoria->proceso_id = $proceso->id;
            $minicategoria->saveOrFail();
            $minicategoria =  new Minicategoria();
            $minicategoria->nombre = 'Procedimientos';
            $minicategoria->descripcion = 'Procedimientos';
            $minicategoria->proceso_id = $proceso->id;
            $minicategoria->saveOrFail();
            $minicategoria =  new Minicategoria();
            $minicategoria->nombre = 'Formatos';
            $minicategoria->descripcion = 'Formatos';
            $minicategoria->proceso_id = $proceso->id;
            $minicategoria->saveOrFail();
            $minicategoria =  new Minicategoria();
            $minicategoria->nombre = 'Otros documentos del proceso (Manuales, instructivos, guias, politicas, planes, Ficha tecnica, reglamento, protocolo, codigos)';
            $minicategoria->descripcion = 'Otros documentos del proceso (Manuales, instructivos, guias, politicas, planes, Ficha tecnica, reglamento, protocolo, codigos)';
            $minicategoria->proceso_id = $proceso->id;
            $minicategoria->saveOrFail();
            $minicategoria =  new Minicategoria();
            $minicategoria->nombre = 'Indicadores';
            $minicategoria->descripcion = 'Indicadores';
            $minicategoria->proceso_id = $proceso->id;
            $minicategoria->saveOrFail();
            $minicategoria =  new Minicategoria();
            $minicategoria->nombre = 'Evidencias del proceso';
            $minicategoria->descripcion = 'Evidencias del proceso';
            $minicategoria->proceso_id = $proceso->id;
            $minicategoria->saveOrFail();
            $minicategoria =  new Minicategoria();
            $minicategoria->nombre = 'Auditorias  del sistema  gestión';
            $minicategoria->descripcion = 'Auditorias  del sistema  gestión';
            $minicategoria->proceso_id = $proceso->id;
            $minicategoria->saveOrFail();
            $minicategoria =  new Minicategoria();
            $minicategoria->nombre = 'Planes de mejoramiento';
            $minicategoria->descripcion = 'Planes de mejoramiento';
            $minicategoria->proceso_id = $proceso->id;
            $minicategoria->saveOrFail();
    }

    /**
     * Handle the proceso "updated" event.
     *
     * @param  \App\Proceso  $proceso
     * @return void
     */
    public function updated(Proceso $proceso)
    {
        //
    }

    /**
     * Handle the proceso "deleted" event.
     *
     * @param  \App\Proceso  $proceso
     * @return void
     */
    public function deleted(Proceso $proceso)
    {
        //
    }

    /**
     * Handle the proceso "restored" event.
     *
     * @param  \App\Proceso  $proceso
     * @return void
     */
    public function restored(Proceso $proceso)
    {
        //
    }

    /**
     * Handle the proceso "force deleted" event.
     *
     * @param  \App\Proceso  $proceso
     * @return void
     */
    public function forceDeleted(Proceso $proceso)
    {
        //
    }
}
