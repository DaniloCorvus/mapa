<?php

namespace App\Http\Controllers;

use App\Otro;
use App\Services\UploadService;
use App\Http\Requests\OtroRequest;
use App\Repositories\OtroRepository;

class OtroController extends Controller
{
    protected $otroRepository;
    public function __construct(UploadService $upload, OtroRepository $otroRepository)
    {
        $this->otroRepository = $otroRepository;
        $this->middleware('permiss', ['except' => ['index']], 'auth', ['except' => ['index']]);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(OtroRequest $request)
    {
        try {
            $this->otroRepository->create($request);
            // return response('El archivo se ha subido correctamente', 200);
            return back();
        } catch (\Throwable $th) {
            return $th->getMessage();
        }
    }

    public function destroy($otro)
    {
        try {
            $delete = Otro::findOrFail($otro);
            $delete->delete();
            return back();
        } catch (\Throwable $th) {
            return $th->getMessage();
        }
    }
}
