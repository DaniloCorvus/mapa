<?php

namespace App\Repositories;

use App\Otro;
use App\Services\UploadService;

class OtroRepository
{
    protected $uploadService;


    public function __construct(UploadService $uploadService)
    {
        $this->uploadService = $uploadService;
    }


    public function find(int $otro)
    {
        return Otro::findOrFail($otro);
    }

    public function delete(Otro $otro): void
    {
        $otro->delete();
    }

    public function create($attributos)
    {
        Otro::create([
            'file_path' => $this->uploadService->handleUploadedFile($attributos->file('file')),
            'nombre' => $attributos->title
        ]);
    }
}
