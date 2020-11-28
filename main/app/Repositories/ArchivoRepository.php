<?php

namespace App\Repositories;

use App\Archivo;
use App\Services\DeleteService;
use App\Services\UploadService;

class ArchivoRepository
{

    protected $archivo;
    protected $uploadService;
    protected $deleteService;

    public function __construct(Archivo $archivo, UploadService $uploadService, DeleteService $deleteService)
    {
        $this->archivo = $archivo;
        $this->uploadService = $uploadService;
        $this->deleteService = $deleteService;
    }

    public function allWithCatSubCatMiniCat($categoria, $subcategoria, $slug)
    {
        return $this->archivo->where('categoria', $categoria)
            ->where('subcategoria', $subcategoria)
            ->where('minicategoria', $slug)->get();
    }

    public function create($attributes)
    {
        $archivo = new Archivo();
        $archivo->pdf_path = $this->uploadService->handleUploadedPdf($attributes->file('pdf'));
        $archivo->nombre = $attributes->title;
        $archivo->descripcion = $attributes->description;
        $archivo->categoria_id = $attributes->categoria_id;
        $archivo->proceso_id = $attributes->proceso_id;
        $archivo->proceso_id = $attributes->proceso_id;
        $archivo->subproceso_id = $attributes->subproceso_id;
        $archivo->subproceso_id = $attributes->subproceso_id;
        $archivo->macroproceso_id = $attributes->macroproceso_id;
        $archivo->minicategoria_id = $attributes->minicategoria_id;
        $archivo->saveOrFail();
    }

    public function update()
    {
        $archivo = Archivo::findOrfail(request()->id);
        $archivo->nombre = request()->title;
        $archivo->descripcion = request()->description;
        if (request()->hasFile('pdf')) {
            $this->deleteService->handleDeleteedPdf($archivo->pdf_path);
            $archivo->pdf_path = $this->uploadService->handleUploadedPdf(request()->file('pdf'));
        }
        $archivo->update();
        return 'Todo right';
    }
}
